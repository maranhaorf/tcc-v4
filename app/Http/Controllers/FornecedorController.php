<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;

class FornecedorController extends Controller
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
            $data = Fornecedor::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="show(' . $row->id . ')" class="edit btn btn-primary btn-sm">Exibir</button>                            <button onclick="excluir(' . $row->id . ')" class="edit btn btn-danger btn-sm">Excluir</button>                            <button onclick="edit(' . $row->id . ')" class="edit btn btn-warning btn-sm">Editar</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }
        return view('fornecedor\fornecedor_listar');
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

        Fornecedor::create([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco
        ]);

        return response()->json(['success' => 'Ajax request submitted successfully']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
    }
}
