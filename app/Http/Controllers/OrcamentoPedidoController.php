<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\OrcamentoPedido;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class OrcamentoPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        OrcamentoPedido::create([
            'id_produto' => $request->id_produto,
            'quantidade' => $request->quantidade,
            'preco' => $request->valor,
            'id_orcamento' => $request->cod_item_pedido

        ]);



        return response()->json(['success' => 'Ajax request submitted successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = OrcamentoPedido::find($id);

        return Response::json($item);
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

        OrcamentoPedido::where('id', $id)->update([
            'quantidade' => $request->quantidade_altera,
            'preco' => $request->valor_altera,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = OrcamentoPedido::find($id);
        $delete->delete();
    }
    public function produto_quantidade3($id)
    {

        $produto = DB::select("SELECT (p.valor) as valor, ip.*, (ip.quantidade + e.quantidade) as max_q, e.id as estoque_altera FROM orcamento_pedido ip 
        INNER join estoque e  on e.id_produto = ip.id_produto
        inner join produto p on (p.id = e.id_produto)
        WHERE ip.id =?", [$id]);

        $input =  " <div class='form-group'>  <label for='numero'>Quantidade</label> <input class='form-control' type='number' min='1' max ='" . $produto[0]->max_q . "' value ='" . $produto[0]->quantidade . "' id='quantidade_altera' name='quantidade_altera' onchange='calcular_altera()'></div><div class='form-group'> <label for='valor'>Valor Unitario </label> <input class='form-control' type='number' value ='" . $produto[0]->valor . "'  id='unico' name='unico' readonly></div>";
        $input .= "<div class='form-group'> <label for='valor'>Valor Total </label> <input class='form-control' type='number'   id='valor_altera' value ='" . $produto[0]->preco . "' name='valor_altera' disabled></div>";
        $input .= " <input type='hidden' name='estoque_altera' id='estoque_altera' value ='" . $produto[0]->estoque_altera . "'>";
        echo $input;
    }
    public function produto_quantidade4($id)
    {
        $produto = DB::select('select e.*,p.valor as valor  from estoque e  inner join produto p on (p.id = e.id_produto) where e.id_produto = ?', [$id]);

        $input =  " <div class='form-group'>  <label for='numero'>Quantidade</label> <input class='form-control' type='number' min='1' max ='" . ($produto[0]->quantidade - 1) . "' value='1' id='quantidade' name='quantidade' onchange='calcular()'></div><div class='form-group'> <label for='valor'>Valor Unitario </label> <input class='form-control' type='number' value ='" . $produto[0]->valor . "'  id='unico' name='unico' readonly></div>";
        $input .= "<div class='form-group'> <label for='valor'>Valor Total </label> <input class='form-control' type='number' value ='" . $produto[0]->valor . "'   id='valor' name='valor' readonly></div>";
        echo $input;
    }
    public function finalizar_pedido2($id)
    {

        Orcamento::where('id', $id)->update([
            'status' => 'Finalizado'
        ]);
        $datas = DB::select("SELECT max(id) as id, nome_cliente,cpf_cliente,email_cliente,telefone_cliente FROM solicitacao_orcamento WHERE  id =  $id");
        $resultado = '*Dados Do Cliente*  ';
        foreach ($datas  as $linha) {
            $resultado .= "\n *Cod:* " . $linha->id . "\n";
            $resultado .= " *Nome:* " . $linha->nome_cliente . "\n";
            $resultado .= " *Telefone:* " . $linha->telefone_cliente . "\n";
            $resultado .= " *Email:* " . $linha->email_cliente . " \n ";
        }
        $resultado .=  " \n \n \r";
        $resultado .= '*Dados Do Orçamento* ';
        $data = DB::select("SELECT op.*, p.nome as produto FROM orcamento_pedido op INNER JOIN produto p on (p.id = op.id_produto) where op.id_orcamento = $id");
        foreach ($data  as $linhas) {
            $resultado .= "\n *Produto:* " . $linhas->produto . "\n";
            $resultado .= " *Quantidade:* " . $linhas->quantidade . "\n";
            $resultado .= " *Valor:* " . $linhas->preco . "\n";
            $resultado .= " *Data e Hora:* " .
                date('d-m-Y H:i', strtotime($linhas->created_at))
                . "\n";
        }

        return response()->json(['resultado' =>  $resultado]);
    }
}
