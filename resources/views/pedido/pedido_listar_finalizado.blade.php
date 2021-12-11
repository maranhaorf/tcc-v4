@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Lista Pedidos')])

@section('content')
<style>
  select:has(option[value=""]) {
  color: red;
}

</style>

<div class="content">
  <div class="container-fluid">



  

    <div class="card">
      <div class="card-body">


        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0"> Listagem de Pedidos Para Separação</h4>

        </div>
        <div class="row"><br></div>
        <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
          <thead>
            <tr class="text-center">
              <th>Nome do Cliente</th>
              <th>CPF/CNPJ</th>
              <th>Telefone</th>
              <th>Vendedor</th>
              <th>Data Hora</th>
          
              <th>Detalha</th>
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
  
		ajax: '/finalizado/',
		dom: 'Bfrtip',
		buttons: [{
			text: 'My button',
			action: function (e, dt, node, config) {
				alert('Button activated');
			}
		}],





		columns: [
      {
			data: 'nome_cliente',
			name: 'nome_cliente'
		}, {
			data: 'cpf_cliente',
			name: 'cpf_cliente',
		}, {
			data: 'telefone_cliente',
			name: 'telefone_cliente',
		},{
			data: 'vendedor',
			name: 'vendedor',
		},
    {
			data: 'created_at',
			name: 'created_at',
		},
    {
      data: 'action',
      name: 'action',
      orderable: true,
      searchable: false
  },]
 
	});
});

  function cadastro_pedido(value) {
    $.ajax({
      type: "POST",
      data: $('#cadastro_pedido').serialize(),
      url: "pedido/",
      success:function(response){
        //console.log(response);
        if(response) {
          $('#tabela').DataTable().ajax.reload();
          swal("Sucesso!","Pedido Cadastrado" , "success");
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
      // data: $('#cadastro_pedido').serialize(),
      url: `pedido/${id}`,
      success:function(response){
        $("#nome_cliente_altera").val(response.nome_cliente);
        $("#cpf_cliente_altera").val(response.cpf_cliente);
        $("#telefone_cliente_altera").val(response.telefone_cliente);
        $("#id_altera").val(response.id);
        $("#modal-pedido-altera").modal("show");

      },
      error: function(error) {
        console.log(error);
      }
    });
  }
  function add_produtos(id){
      window.location = `detalhe_pedido/${id}`
      
  } 


  function alterar_pedido(){
    let id = $("#id_altera").val();
 
    $.ajax({
      type: "POST",
      data: $('#altera_pedido').serialize(),
      url: `pedido/${id}`,
      success:function(response){
          $('#tabela').DataTable().ajax.reload();
          $("#modal-pedido-altera").modal("hide");
          swal("Sucesso!","Pedido Alterado" , "success");
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
      //data: $('#cadastro_pedido').serialize(),
      url: `pedido/${id}`,
      success:function(response){
        $('#tabela').DataTable().ajax.reload();
        swal("Sucesso!","Pedido Apagado" , "success");
      },
      error: function(error) {
        console.log(error);
      }
    });
  }


</script>

@endsection