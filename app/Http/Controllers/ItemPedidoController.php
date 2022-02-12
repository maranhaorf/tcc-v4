<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;


class ItemPedidoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function show($id)
    {
        $item = ItemPedido::find($id);

        return Response::json($item);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            $quantidade = DB::select("select (quantidade  -$request->quantidade ) as quantidade from estoque where id_produto = ?", [$request->id_produto]);
            if (0 >= $quantidade[0]->quantidade) {

                return;
            }
            ItemPedido::create([
                'id_produto' => $request->id_produto,
                'quantidade' => $request->quantidade,
                'preco' => $request->valor,
                'id_pedido' => $request->id_pedido

            ]);

            Estoque::where('id_produto', $request->id_produto)->update([
                'quantidade' => $quantidade[0]->quantidade
            ]);
            DB::commit();
            return response()->json(['success' => 'Ajax request submitted successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function produto_quantidade($id)
    {
        $produto = DB::select('select e.*,p.valor as valor  from estoque e  inner join produto p on (p.id = e.id_produto) where e.id_produto = ?', [$id]);

        $input =  " <div class='form-group'>  <label for='numero'>Quantidade</label> <input class='form-control' type='number' min='1' max ='" . ($produto[0]->quantidade - 1) . "' value='1' id='quantidade' name='quantidade' onchange='calcular()'></div><div class='form-group'> <label for='valor'>Valor Unitario </label> <input class='form-control' type='number' value ='" . $produto[0]->valor . "'  id='unico' name='unico' readonly></div>";
        $input .= "<div class='form-group'> <label for='valor'>Valor Total </label> <input class='form-control' type='number' value ='" . $produto[0]->valor . "'   id='valor' name='valor' ></div>";
        echo $input;
    }
    public function produto_quantidade_2($id)
    {
        $produto = DB::select("SELECT (p.valor) as valor, ip.*, (ip.quantidade + e.quantidade) as max_q, e.id as estoque_altera FROM item_pedido ip 
        INNER join estoque e  on e.id_produto = ip.id_produto
        inner join produto p on (p.id = e.id_produto)
        WHERE ip.id =?", [$id]);

        $input =  " <div class='form-group'>  <label for='numero'>Quantidade</label> <input class='form-control' type='number' min='1' max ='" . $produto[0]->max_q . "' value ='" . $produto[0]->quantidade . "' id='quantidade_altera' name='quantidade_altera' onchange='calcular_altera()'></div><div class='form-group'> <label for='valor'>Valor Unitario </label> <input class='form-control' type='number' value ='" . $produto[0]->valor . "'  id='unico' name='unico' readonly></div>";
        $input .= "<div class='form-group'> <label for='valor'>Valor Total </label> <input class='form-control' type='number'   id='valor_altera' value ='" . $produto[0]->preco . "' name='valor_altera' ></div>";
        $input .= " <input type='hidden' name='estoque_altera' id='estoque_altera' value ='" . $produto[0]->estoque_altera . "'>";
        echo $input;
    }
    public function estoque_minimo()
    {
        $produto = DB::select("SELECT e.*, p.nome from estoque e 
        INNER JOIN produto p on p.id = e.id_produto
        ");
        $input = '';
        foreach ($produto as  $value) {
            if ($value->estoque_minimo >= $value->quantidade) {

                $input .= "<a class='dropdown-item' href='#'>Produto " . $value->nome . ", Esta com uma quantidade de " . $value->quantidade . " em estoque</a>";
            }
            if ($input == "") {
                $input .= "  <a class='dropdown-item' href='#'>Estoque em Perfeito Estado</a>";
            }
        }

        echo $input;
    }
    public function finalizar_pedido($id)
    {
        Pedido::where('id', $id)->update([
            'status' => 'Finalizado'
        ]);
    }
    public function concluir_pedido($id)
    {
        Pedido::where('id', $id)->update([
            'status' => 'Concluido'

        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {

            DB::beginTransaction();
            $novo = DB::select("select (quantidade  + $request->quantidade_old_altera ) as quantidade from estoque where id = ?", [$request->estoque_altera]);

            Estoque::where('id', $request->estoque_altera)->update([
                'quantidade' => $novo[0]->quantidade
            ]);
            $quantidade = DB::select("select (quantidade  -$request->quantidade_altera ) as quantidade from estoque where id = ?", [$request->estoque_altera]);
            if (0 >= $quantidade[0]->quantidade) {

                return;
            }

            ItemPedido::where('id', $id)->update([
                'quantidade' => $request->quantidade_altera,
                'preco' => $request->valor_altera,
            ]);


            Estoque::where('id', $request->estoque_altera)->update([
                'quantidade' => $quantidade[0]->quantidade
            ]);
            DB::commit();
            return response()->json(['success' => 'Ajax request submitted successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $delete = ItemPedido::find($id);

            $novo = DB::select("select (quantidade  + $delete->quantidade ) as quantidade from estoque where id_produto = ?", [$delete->id_produto]);

            Estoque::where('id_produto', $delete->id_produto)->update([
                'quantidade' => $novo[0]->quantidade
            ]);
            $delete->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
