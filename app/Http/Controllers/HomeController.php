<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Yajra\DataTables\Datatables;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::select("SELECT u.name as  nome,sum(ip.preco) as valor,COUNT(p.id_usuario) as venda FROM users u 
            inner join pedido p on p.id_usuario = u.id
            inner JOIN item_pedido ip on ip.id_pedido  = p.id 
            where p.status in('Concluido') GROUP BY u.id");

            return Datatables::of($data)->make(true);
        }
        $data = Carbon::today();
        $valor = DB::select(
            "SELECT sum(ip.preco) as valor FROM  pedido p
        inner JOIN item_pedido ip on ip.id_pedido  = p.id 
        where p.status in('Concluido')
        and 
        date(p.updated_at) = ?",
            [Carbon::now()->format('Y-m-d')]
        );

        $quantidade =  DB::select(
            "SELECT sum(ip.quantidade) as quantidade FROM  pedido p
            inner JOIN item_pedido ip on ip.id_pedido  = p.id 
            where p.status in('Concluido')
            and 
        date(p.updated_at) = ?",
            [Carbon::now()->format('Y-m-d')]
        );
        $separacao =  DB::select(
            "SELECT sum(ip.quantidade) as quantidade FROM  pedido p
            inner JOIN item_pedido ip on ip.id_pedido  = p.id 
            where p.status in('Finalizado')
            and 
        date(p.updated_at) = ?",
            [Carbon::now()->format('Y-m-d')]
        );
        return view('dashboard', ['valor' => $valor, 'quantidade' => $quantidade, 'separacao' => $separacao]);
    }
}
