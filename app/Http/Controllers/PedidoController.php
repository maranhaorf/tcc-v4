<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Fornecedor;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use Yajra\DataTables\Datatables;
use Response;

class PedidoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::select("SELECT p.* , u.name as vendedor FROM pedido p 
            INNER JOIN users u on u.id = p.id_usuario WHERE p.status  in ('Criado')");

            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="excluir(' . $row->id . ')" class="edit btn btn-danger btn-sm">Excluir</button><button onclick="editar(' . $row->id . ')" class="edit btn btn-warning btn-sm">Editar</button><button onclick="add_produtos(' . $row->id . ')" class="edit btn btn-info btn-sm">Produtos</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }


        return view('pedido\pedido_listar');
    }
    public function finalizado(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::select("SELECT p.* , u.name as vendedor, DATE_FORMAT(p.created_at, '%d/%l/%Y %H:%i:%s') AS 'created_at' FROM pedido p 
            INNER JOIN users u on u.id = p.id_usuario WHERE p.status  in ('Finalizado')");

            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="add_produtos(' . $row->id . ')" class="edit btn btn-info btn-sm">Detalha</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }


        return view('pedido\pedido_listar_finalizado');
    }

    public function concluido(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::select("SELECT p.* , u.name as vendedor, DATE_FORMAT(p.updated_at, '%d/%m/%Y %H:%i:%s') AS 'created_at' FROM pedido p 
            INNER JOIN users u on u.id = p.id_usuario WHERE p.status  in ('Concluido')");

            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="add_produtos(' . $row->id . ')" class="edit btn btn-info btn-sm">Detalha</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }


        return view('pedido\pedido_listar_concluido');
    }
    public function buscar_fornecedores()
    {
        $data = DB::select('select id,nome from fornecedor ');


        return  $data;
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

        Pedido::create([
            'nome_cliente' => $request->nome_cliente,
            'cpf_cliente' => $request->cpf_cliente,
            'telefone_cliente' => $request->telefone_cliente,
            'id_usuario' => Auth::user()->id

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
        $pedido = Pedido::find($id);

        return Response::json($pedido);
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

        Pedido::where('id', $id)->update([
            'nome_cliente' => $request->nome_cliente_altera,
            'cpf_cliente' => $request->cpf_cliente_altera,
            'telefone_cliente' => $request->telefone_cliente_altera,
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


        try {

            $delete = DB::select('select * from item_pedido where id_pedido = ?', [$id]);
            if ($delete) {
                DB::beginTransaction();

                $valor  = 0;
                $id_produto = 0;
                foreach ($delete as $linha) {
                    $valor = ($linha->quantidade);
                    $id_produto = $linha->id_produto;

                    Pedido::where('id', $id)->update([
                        'status' => 'Excluido'
                    ]);


                    $novo = DB::select("select (quantidade  + $valor) as quantidade from estoque where id_produto = ?", [$id_produto]);

                    Estoque::where('id_produto', $id_produto)->update([
                        'quantidade' => $novo[0]->quantidade
                    ]);
                }
                DB::delete('delete from item_pedido where id_pedido = ?', [$id]);

                DB::commit();
            } else {
                Pedido::where('id', $id)->update([
                    'status' => 'Excluido'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function add_produtos(Request $request, $id)
    {
        $datas = DB::select("SELECT p.* , u.name as vendedor FROM pedido p 
        INNER JOIN users u on u.id = p.id_usuario WHERE p.status not in ('Excluido') AND
        p.id = $id");
        $produtoes =  DB::select("SELECT id, nome FROM produto");
        if ($request->ajax()) {
            $data = DB::select("SELECT ip.*, p.nome as produto FROM item_pedido ip INNER JOIN produto p on (p.id = ip.id_produto) where ip.id_pedido = $id");

            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="excluir(' . $row->id . ')" class="edit btn btn-danger btn-sm">Excluir</button><button onclick="editar(' . $row->id . ')" class="edit btn btn-warning btn-sm">Editar</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }


        return view('pedido\add_produtos', ['datas' => $datas, 'produtoes' => $produtoes]);
    }
    public function detalhe_pedido(Request $request, $id)
    {
        $datas = DB::select("SELECT p.* , u.name as vendedor FROM pedido p 
        INNER JOIN users u on u.id = p.id_usuario WHERE p.status  in ('Finalizado') AND
        p.id = $id");
        $produtoes =  DB::select("SELECT id, nome FROM produto");
        if ($request->ajax()) {
            $data = DB::select("SELECT ip.*, p.nome as produto FROM item_pedido ip INNER JOIN produto p on (p.id = ip.id_produto) where ip.id_pedido = $id");

            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }


        return view('pedido\detalhe_pedido', ['datas' => $datas, 'produtoes' => $produtoes]);
    }
}
