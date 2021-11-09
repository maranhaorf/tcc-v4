@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Lista Produtos')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class='col-md-12'>
            <form id='pesquisar_produto'>
              @csrf
              <div class="mb-3">
                <h3 class="box-title">Procurar Produto</h3>
                <input type="text" class="form-control" id="cod"
                  placeholder="Digite o nome do produto">
              </div>
          </div>
        </div>
        <div class="row">
          <div class='col-md-12'>
            <div class="float-right">
              <button type="submit"onclick="Pesquisar('pesquisar_produto')"  class="btn btn-success">Pesquisar</button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Cadastro de Produtos
              </button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Listagem de Produtos</h4>
           
          </div>
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