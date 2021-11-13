@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Lista Produtos')])

@section('content')

<div class="content">
  <div class="container-fluid">
    <!--
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
-->

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

    <!--Modal altera-->
    <div class="modal fade" id="modal-fornecedor-altera" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Alterar Fornecedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="altera_fornecedor">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <div class="form-group">
                <label for="Nome">Nome</label>
                <input type="text" class="form-control" id="nome_altera" name='nome_altera' aria-describedby="nome"
                  placeholder="Digite o Nome do Fornecedor">
              </div>
              <div class="form-group">
                <label for="CNPJ">CNPJ</label>
                <input class="form-control" id="cnpj_altera" name="cnpj_altera" onkeypress='mascaraMutuario(this,cpfCnpj)'
                  aria-describedby="cnpj" placeholder="Digite o Cnpj do Fornecedor">
              </div>
              <div class="form-group">
                <label for="Endereco">Endereco</label>
                <input type="text" class="form-control" id="endereco_altera" name="endereco_altera"
                  placeholder="Digite o Endereco do Fornecedor">
              </div>
          </div>
          <input type="hidden" name="id_altera" id="id_altera">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="alterar_fornecedor()">Alterar</button>
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
        <div class="mt-4 mb-4">
        <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModalCenter">
                Cadastro de Fornecedor
        </button>
        </div>
        <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
          <thead>
            <tr class="text-center">
              <th style="width:35%">Nome</th>
              <th>Cnpj</th>
              <th style="width:35%">Endereco</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody class="text-center">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>

$(document).ready(function () {
	$('#tabela').DataTable({
		language: {
			"url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json",
		},
		processing: true,
		serverSide: true,
		ajax: '/fornecedor',
		dom: 'Bfrtip',
		buttons: [{
			text: 'My button',
			action: function (e, dt, node, config) {
				alert('Button activated');
			}
		}],
		columns: [{
			data: 'nome',
			name: 'nome'
		}, {
			data: 'cnpj',
			name: 'cnpj'
		}, {
			data: 'endereco',
			name: 'endereco',
		},
    {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
  },]
	});
});

  function cadastro_fornecedor(value) {
    $.ajax({
      type: "POST",
      data: $('#cadastro_fornecedor').serialize(),
      url: "fornecedor/",
      success:function(response){
        //console.log(response);
        if(response) {
          $('#tabela').DataTable().ajax.reload();
          swal("Sucesso!","Fornecedor Cadastrado" , "success");
          $("#exampleModalCenter").modal("hide");
        }
      },
      error: function(error) {
        console.log(error);
      }
    });
  }

  function editar(id){
    $.ajax({
      type: "GET",
      //data: $('#cadastro_fornecedor').serialize(),
      url: `fornecedor/${id}`,
      success:function(response){
        $("#nome_altera").val(response.nome);
        $("#cnpj_altera").val(response.cnpj);
        $("#endereco_altera").val(response.endereco);
        $("#id_altera").val(response.id);
        $("#modal-fornecedor-altera").modal("show");

      },
      error: function(error) {
        console.log(error);
      }
    });
  }

  function alterar_fornecedor(){
    let id = $("#id_altera").val();
    $.ajax({
      type: "POST",
      data: $('#altera_fornecedor').serialize(),
      url: `fornecedor/${id}`,
      success:function(response){
          $('#tabela').DataTable().ajax.reload();
          $("#modal-fornecedor-altera").modal("hide");
          swal("Sucesso!","Fornecedor Alterado" , "success");
      },
      error: function(error) {
        console.log(error);
      }
    });
  }
  

  function excluir(id){
    $.ajax({
      type: "DELETE",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      //data: $('#cadastro_fornecedor').serialize(),
      url: `fornecedor/${id}`,
      success:function(response){
        $('#tabela').DataTable().ajax.reload();
        swal("Sucesso!","Fornecedor Apagado" , "success");
      },
      error: function(error) {
        console.log(error);
      }
    });
  }

</script>

@endsection