@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Lista Item Pedidos')])

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
            <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Item Pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="cadastro_item_pedido" method="POST">
              @csrf
           
          
                  <div class="form-group">
                    <label for="Nome">Nome Produto</label>
                    <select class="browser-default custom-select" id="id_produto" name="id_produto"onChange="function_quantidade(this.options[this.selectedIndex].value)" >
                      <option selected>Selecione Um Produtos</option>
                    
                       
                    
                      @foreach($produtoes as $produto)
                  
                      <option value="{{$produto->id}}">{{$produto->nome}}</option>
                        
                
                      @endforeach
                
                    </select>
                  </div>
         
            
          
              
                  <div id="input_quantidade" name='input_quantidade' >
                  
                  </div>
                

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="cadastro_item_pedido()">Cadastrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!--Modal altera-->
    <div class="modal fade" id="modal-item_pedido-altera" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Alterar Item Pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="altera_item_pedido">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
            
              <select class="browser-default custom-select" id="id_produto_altera" name="id_produto_altera" disabled>
                <option selected>Selecione Um Produtos</option>
              
                 
              
                @foreach($produtoes as $produto)
            
                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                  
          
                @endforeach
          
              </select>
        
      
              <div id="input_quantidade_2" name='input_quantidade_2' >
                  
              </div>
           

          </div>
          <input type="hidden" name="id_altera" id="id_altera">
          <input type="hidden" name="quantidade_old_altera" id="quantidade_old_altera">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="alterar_item_pedido()">Alterar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">


        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0"> Listagem dos Item Pedido</h4>

        </div>
        <div class="row"><br></div>
        <div class="row">
          <div class="col-md-1">
              <div class="form-group">
                  <label for="exampleInputEmail1">COD</label>
        
                  <input type="text" class="form-control" name='cod_item_pedido' id='cod_item_pedido'value ="{{$datas[0]->id}}"  disabled>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputPassword1">Nome Cliente</label>
                  <input type="text" class="form-control" value ="{{$datas[0]->nome_cliente}}" 
                    disabled>
              </div>
          </div>
     
          <div class="col-md-3">
              <div class="form-group">
                  <label for="exampleInputPassword1">Dados Cliente</label>
                  <input type="text" class="form-control"  value ="{{$datas[0]->cpf_cliente}}"
                     disabled>
              </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputPassword1">Telefone Cliente</label>
                <input type="text" class="form-control"  value ="{{$datas[0]->telefone_cliente}}" 
                   disabled>
            </div>
        </div>
      </div>
        <div class="mt-4 mb-4">
          <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModalCenter">
            Cadastro de Item Pedido
          </button>
        </div>
        <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
          <thead>
            <tr class="text-center">
              <th>Cod Produto</th>
              <th>Produto</th>
              <th>Quantidade</th>
              <th>Valor</th>
          
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
  let id = $("#cod_item_pedido").val();
  $(document).ready(function () {
  
	$('#tabela').DataTable({
		language: {
			"url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json",
		},
		processing: true,
		serverSide: true,
		ajax: `/add_produtos/${id}`,
		dom: 'Bfrtip',
		buttons: [{
			text: 'My button',
			action: function (e, dt, node, config) {
				alert('Button activated');
			}
		}],





		columns: [{
			data: 'id',
			name: 'id'
		}, {
			data: 'produto',

			name: 'produto',
		}, {
			data: 'quantidade',
			name: 'quantidade',
		},{
			data: 'preco',
			name: 'preco',
		},
    {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
  },]
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