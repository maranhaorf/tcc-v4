@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'disponibilidade', 'title' => __('J.A
ALUMINIO')])

@section('content')
<div class="container" style="height: auto;">

    <div class="col-md-9 ml-auto mr-auto mb-3 text-center">

    </div>
  





      <div class="card">
        <div class="card-body">


          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Listagem dos Produtos</h4>

          </div>


          <div class="mt-4 mb-4">
           
          </div>
          <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
            <thead>
              <tr class="text-center">
               
                <th>Produto</th>
                <th>Cor</th>
                <th>Quantidade</th>
                <th>Valor</th>

              </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
          </table>
        </div>
      </div>
  

</div>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>
  let id = $("#cod_item_pedido").val();
  $(document).ready(function () {
  
	$('#tabela').DataTable({
		language: {
			"url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json",
		},
		processing: true,
		serverSide: true,
		ajax: `/disponibilidade`,
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
			data: 'cor',

			name: 'cor',
		}, {
			data: 'quantidade',
			name: 'quantidade',
		},{
			data: 'valor',
			name: 'valor',
		},
   ]
	});
});

  function cadastro_item_pedido(value) {
    $.ajax({
      type: "POST",
      data: $('#cadastro_item_pedido').serialize(),
      url: "/item/",
      success:function(response){
        //console.log(response);
        if(response) {
          $('#tabela').DataTable().ajax.reload();
          swal("Sucesso!","Item AItem Pedido Cadastrado" , "success");
          $("#exampleModalCenter").modal("hide");
        }else{
          swal("ERROR!","Produto insuficiente  em adiciona item" , "error");
        }
      },
      error: function(error) {
        swal("ERROR!","Error em adiciona item" , "error");
      }
    });
  }

  function editar(id){
    $.ajax({
      type: "GET",
      // data: $('#cadastro_item_pedido').serialize(),
      url: `/item/${id}`,
      success:function(response){
        $("#id_produto_altera").val(response.id_produto);
        function_quantidade_2(response.id)
        $("#id_altera").val(response.id);
        $("#quantidade_old_altera").val(response.quantidade);
        $("#modal-item_pedido-altera").modal("show");

      },
      error: function(error) {
        console.log(error);
      }
    });
  }



  function alterar_item_pedido(){
    let id = $("#id_altera").val();
 
    $.ajax({
      type: "POST",
      data: $('#altera_item_pedido').serialize(),
      url: `/item/${id}`,
      success:function(response){
          $('#tabela').DataTable().ajax.reload();
          $("#modal-item_pedido-altera").modal("hide");
          swal("Sucesso!","Item Pedido Alterado" , "success");
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
      //data: $('#cadastro_item_pedido').serialize(),
      url: `/item/${id}`,
      success:function(response){
        $('#tabela').DataTable().ajax.reload();
        swal("Sucesso!","Item Pedido Apagado" , "success");
      },
      error: function(error) {
        console.log(error);
      }
    });
  }
  function function_quantidade(id){
    $.ajax({
      type: "GET",
      // data: $('#cadastro_item_pedido').serialize(),
      url: `/produto_quantidade/${id}`,
      success:function(response){
       
        $("#input_quantidade").html(response);
       

      },
      error: function(error) {
        console.log(error);
      }
    });
  }
  function function_quantidade_2(id){
    $.ajax({
      type: "GET",
      // data: $('#cadastro_item_pedido').serialize(),
      url: `/produto_quantidade_2/${id}`,
      success:function(response){
       
        $("#input_quantidade_2").html(response);
       

      },
      error: function(error) {
        console.log(error);
      }
    });
  }
  function finalizar_pedido(id){
    $.ajax({
      type: "GET",
      // data: $('#cadastro_item_pedido').serialize(),
      url: `/finalizar_pedido/${id}`,
      success:function(response){
       
        swal("Sucesso!","Pedido Finalizado" , "success");
        setTimeout(() => {  window.location.href = "/pedido" }, 2000);
        

      },
      error: function(error) {
        console.log(error);
      }
    });
  }
  function calcular(){
    var valor1 = parseInt(document.getElementById('quantidade').value);
    var valor2 = document.getElementById('unico').value;
    document.getElementById('valor').value = valor1 * valor2;
}
function calcular_altera(){
    var valor1 = parseInt(document.getElementById('quantidade_altera').value);
    var valor2 = document.getElementById('unico').value;
    document.getElementById('valor_altera').value = valor1 * valor2;
}

</script>

@endsection