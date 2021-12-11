<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use Yajra\DataTables\Datatables;
use Response;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users')->get();
           
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<button onclick="excluir(' . $row->id . ')" class="edit btn btn-danger btn-sm">Excluir</button><button onclick="editar(' . $row->id . ')" class="edit btn btn-warning btn-sm">Editar</button>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }
      
        $perfil = $this->comboperfil();
       
        return view('administracao.perfil', ['perfis' => $perfil ]);

    }
    public function comboperfil()
    {
        $perfis = DB::table('perfil')->get();
        return $perfis;

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
        try {
          
        User::create([
            'name' => $request->name,
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'id_perfil' => $request->id_perfil,
    
        ]);

        return response()->json(['success' => 'Ajax request submitted successfully']);
    } catch (\Throwable $th) {
        return false;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estoque = User::find($id);
      
        return Response::json($estoque);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
    try {
 
        $usuario = User::findOrFail($id);
        if($request->password_altera !=null){
            $usuario->update([
                'name' => $request->name_altera,
                'usuario' => $request->usuario_altera,
                'password' => Hash::make($request->password_altera),
                'id_perfil' => $request->id_perfil_altera
               
            ]);
        }else{

      
        $usuario->update([
            'name' => $request->name_altera,
            'usuario' => $request->usuario_altera,
            'id_perfil' => $request->id_perfil_altera
           
        ]);
    }
        return response()->json(['success' => 'Ajax request submitted successfully']);
    } catch (\Throwable $th) {
        return false;
    }
       
    }





  
    public function destroy($id)
    {
        ;
        $delete = user::find($id);
        $delete->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
