@extends('layouts.app', ['activePage' => 'gerenciar_pedidos', 'titlePage' => __('Lista Pedidos')])

@section('content')
<style>
  select:has(option[value=""]) {
  color: red;
}

</style>

<div class="content">
  <div class="container-fluid">

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="cadastro_pedido">
              @csrf
           
          
                  <div class="form-group">
                    <label for="Nome">Nome Cliente</label>
                    <input type="text" class="form-control" id="nome_cliente" name='nome_cliente' aria-describedby="nome_cliente"
                      placeholder="Digite o Nome do Cliente">
                  </div>
         
            
          
              
                  <div class="form-group">
                    <label for="Nome">Dado Cliente - CPF/CNPJ</label>
                    <input type="text" class="form-control" id="cpf_cliente" name='cpf_cliente' aria-describedby="cpf_cliente"
                      placeholder="Digite o CPF ou Cnpj do Cliente">
                  </div>
                
             
              
          
                  <div class="form-group">
                    <label for="CNPJ">Telefone Cliente</label>
                    <input class="form-control" type="tel" id="telefone_cliente" name="telefone_cliente" aria-describedby="telefone_cliente"
                      placeholder="Digite o numero Do Cliente">
                  </div>
               
            
                


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="cadastro_pedido()">Cadastrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!--Modal altera-->
    <div class="modal fade" id="modal-pedido-altera" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Alterar Pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="altera_pedido">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
            
              <div class="form-group">
                <label for="Nome">Nome Cliente</label>
                <input type="text" class="form-control" id="nome_cliente_altera" name='nome_cliente_altera' aria-describedby="nome_cliente_altera"
                  placeholder="Digite o Nome do Cliente">
              </div>
     
        
      
          
              <div class="form-group">
                <label for="Nome">Dado Cliente - CPF/CNPJ</label>
                <input type="text" class="form-control" id="cpf_cliente_altera" name='cpf_cliente_altera' aria-describedby="cpf_cliente_altera"
                  placeholder="Digite o CPF ou Cnpj do Cliente">
              </div>
            
         
          
      
              <div class="form-group">
                <label for="CNPJ">Telefone Cliente</label>
                <input class="form-control" type="tel" id="telefone_cliente_altera" name="telefone_cliente_altera" aria-describedby="telefone_cliente_altera"
                  placeholder="Digite o numero Do Cliente">
              </div>
           

          </div>
          <input type="hidden" name="id_altera" id="id_altera">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="alterar_pedido()">Alterar</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body">


        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0"> Listagem de Pedido</h4>

        </div>
        <div class="mt-4 mb-4">
          <button type="button" class="btn btn-info float-left" data-toggle="modal" data-target="#exampleModalCenter">
            Cadastro de Pedido
          </button>
        </div>
        <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
          <thead>
            <tr class="text-center">
              <th>Nome do Cliente</th>
              <th>CPF/CNPJ</th>
              <th>Telefone</th>
              <th>Vendedor</th>
          
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
		ajax: '/pedido',
		dom: 'Bfrtip',
		buttons: [{
			text: 'My button',
			action: function (e, dt, node, config) {
				alert('Button activated');
			}
		}],





		columns: [{
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
      data: 'action',
      name: 'action',
      orderable: false,
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
      window.location = `add_produtos/${id}`
      
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