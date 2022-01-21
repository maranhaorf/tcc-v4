<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\OrcamentoPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;

class orcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pagina\solicitar_orçamento');
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

        Orcamento::create([
            'nome_cliente' => $request->nome_cliente,
            'cpf_cliente' => $request->cpf_cliente,
            'telefone_cliente' => $request->telefone_cliente,
            'email_cliente' => $request->email_cliente


        ]);

        return response()->json(['cpf' => $request->cpf_cliente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function orcamento_pedido(Request $request, $id)
    {
        $datas = DB::select("SELECT max(id) as id, nome_cliente,cpf_cliente,email_cliente,telefone_cliente FROM solicitacao_orcamento WHERE status='criado' and cpf_cliente =  $id");
        $produtoes =  DB::select("SELECT id, nome FROM produto");
        if ($request->ajax()) {
            $data = DB::select("SELECT op.*, p.nome as produto FROM orcamento_pedido op INNER JOIN produto p on (p.id = op.id_produto) where op.id_orcamento = $id");

            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="excluir(' . $row->id . ')" class="edit btn btn-danger btn-sm">Excluir</button><button onclick="editar(' . $row->id . ')" class="edit btn btn-warning btn-sm">Editar</button>';

                return $btn;
            })->rawColumns(['action'])->make(true);
        }


        return view('pagina\add_produtos', ['datas' => $datas, 'produtoes' => $produtoes]);
    }
}
