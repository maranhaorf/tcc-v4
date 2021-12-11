<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
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
            INNER JOIN users u on u.id = p.id_usuario WHERE p.status not in ('Excluido')");
         
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="excluir(' . $row->id . ')" class="edit btn btn-danger btn-sm">Excluir</button><button onclick="editar(' . $row->id . ')" class="edit btn btn-warning btn-sm">Editar</button><button onclick="add_produtos(' . $row->id . ')" class="edit btn btn-info btn-sm">Produtos</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }

  
        return view('pedido\pedido_listar');
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
        Pedido::where('id', $id)->update([
            'status' => 'Excluido'
        ]);
    }

      public function add_produtos(Request $request, $id)
    {  
        $datas = DB::select("SELECT p.* , u.name as vendedor FROM pedido p 
        INNER JOIN users u on u.id = p.id_usuario WHERE p.status not in ('Excluido') AND
        p.id = $id");
        $produtoes =  DB::select("SELECT id, nome FROM produto");
        if ($request->ajax()) {
            $data = DB::select("SELECT ip.*, p.nome as produto FROM item_pedido ip INNER JOIN produto p on (p.id = ip.id_produto)");
         
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="excluir(' . $row->id . ')" class="edit btn btn-danger btn-sm">Excluir</button><button onclick="editar(' . $row->id . ')" class="edit btn btn-warning btn-sm">Editar</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }

  
        return view('pedido\add_produtos', ['datas' => $datas,'produtoes' => $produtoes]);
    }
}
