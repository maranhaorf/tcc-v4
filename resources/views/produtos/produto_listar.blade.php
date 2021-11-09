@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Lista Produtos')])

@section('content')
<div class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-body">
            <table id="tabela" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Nome Fornecedor</th>
                    </tr>
                </thead>
                <tbody>  
                  
    @foreach($produtos as $produto)
  
</tr>   
    <td>{{$produto->nome}}</td>
    <td>{{$produto->descricao}}</td>
    <td>{{$produto->valor}}</td>
    <td>{{$produto->fornecedor}}</td>
</tr>   
@endforeach
</tbody>
</table>
        </div>
      </div>
    </div>
</div>
@endsection



