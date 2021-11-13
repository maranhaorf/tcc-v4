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
                <h3 class="box-title">Procurar Fornecedor</h3>
                <input type="text" class="form-control" id="cod" placeholder="Digite o nome do fornecedor">
              </div>
          </div>
        </div>
        <div class="row">
          <div class='col-md-12'>
            <div class="float-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Cadastro de Fornecedor
              </button>
              <button type="submit" onclick="Pesquisar('pesquisar_produto')" class="btn btn-success">Pesquisar</button>

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
            <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Fornecedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="cadastro_fornecedor">
              @csrf
              <div class="form-group">
                <label for="Nome">Nome</label>
                <input type="text" class="form-control" id="nome" name='nome' aria-describedby="nome"
                  placeholder="Digite o Nome do Fornecedor">
              </div>
              <div class="form-group">
                <label for="CNPJ">CNPJ</label>
                <input class="form-control" id="cnpj" name="cnpj" onkeypress='mascaraMutuario(this,cpfCnpj)'
                  aria-describedby="cnpj" placeholder="Digite o Cnpj do Fornecedor">
              </div>
              <div class="form-group">
                <label for="Endereco">Endereco</label>
                <input type="text" class="form-control" id="endereco" name="endereco"
                  placeholder="Digite o Endereco do Fornecedor">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="cadastro_fornecedor()">Cadastrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0"> Listagem de Fornecedor</h4>

        </div>
        <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Cnpj</th>
              <th>Endereco</th>

            </tr>
          </thead>
          <tbody>

            {{-- @foreach($fornecedores as $fornecedor)

            </tr>
            <td>{{$fornecedor->nome}}</td>
            <td>{{$fornecedor->cnpj}}</td>
            <td>{{$fornecedor->endereco}}</td>

            </tr>
            @endforeach --}}
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
 pesquisar()
</script>
<script>
  pesquisar() 
  function cadastro_fornecedor(value) {
  
    $.ajax({
        type: "POST",
        data: $('#cadastro_fornecedor').serialize(),
        url: "{{ route('fornecedor_cadastro') }}",
        success:function(response){
          console.log(response);
          if(response) {
            swal("Sucesso!","Fornecedor Cadastrado" , "success");
            pesquisar()
          }
        },
        error: function(error) {
         console.log(error);
        }
       });
}

function pesquisar() {
   alert("ss");
  var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('listar') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'username', name: 'username'},
            {data: 'phone', name: 'phone'},
            {data: 'dob', name: 'dob'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
}
</script>

@endsection