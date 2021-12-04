<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use Response;

class EstoqueController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::select('SELECT e.id as id,e.quantidade,p.nome as produto, u.name as usuario FROM estoque e 
            INNER JOIN users u on(u.id = e.id_usuario)
            INNER JOIN produto P on (p.id = e.id_produto)');
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="excluir(' . $row->id . ')" class="edit btn btn-danger btn-sm">Excluir</button><button onclick="editar(' . $row->id . ')" class="edit btn btn-warning btn-sm">Editar</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }
        $produtos = $this->buscar_produtos();
        return view('estoque\estoque_listar',compact('produtos'));
    }
    public function buscar_produtos()
    {
        $data = DB::select("select id,nome from produto WHERE status not in('Estoque') ");
   

        return  $data;
    }


    public function busca_especifico(Request $request)
    {

        $fornecedores = DB::select("SELECT * FROM fornecedor where nome LIKE'%%'");
        return view('fornecedor\fornecedor_listar', compact('fornecedores'));
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
        Produto::where('id',$request->id_produto)->update([
            'status' =>"Estoque",
        ]);
          Estoque::create([
            'id_produto' => $request->id_produto,
            'quantidade' => $request->quantidade,
            'estoque_minimo' => $request->estoque_minimo,
            'id_usuario' => Auth::user()->id,

        ]);
      
        return response()->json(['success' => 'Ajax request submitted successfully']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estoque = Estoque::find($id);
        
        return Response::json($estoque);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        $fornecedor = Fornecedor::find($id);
        
        return Response::json($fornecedor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Fornecedor::where('id', $id)->update([
            'nome' => $request->nome_altera,
            'cnpj' => $request->cnpj_altera,
            'endereco' => $request->endereco_altera,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fornecedor = Fornecedor::find($id);

        $fornecedor->delete();
    }
}
