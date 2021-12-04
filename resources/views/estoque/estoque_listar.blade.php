@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Lista Estoques')])

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
            <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Estoque</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="cadastro_estoque">
              @csrf
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="CNPJ">Produto</label>
                    <select class="browser-default custom-select" id="id_produto" name="id_produto" required>
                      <option selected>Selecione Um Produto</option>



                      @foreach($produtos as $produto)

                      <option value="{{$produto->id}}">{{$produto->nome}}</option>


                      @endforeach

                    </select>

                  </div>
                </div>
              </div>
              <div class="row"><br></div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Quantidade</label>
                    <input class="form-control" type="number" min='1' id="quantidade" name="quantidade"
                      aria-describedby="Quantidade" placeholder="Digite a Quantidade em Estoque">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Minimo em Estoque</label>
                    <input class="form-control" type="number" min='1' name="estoque_minimo" id="estoque_minimo"
                      aria-describedby="estoque_minimo" placeholder="Digite o estoque minimo">
                  </div>
                </div>
              </div>




          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="cadastro_estoque()">Cadastrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!--Modal altera-->
    <div class="modal fade" id="modal-estoque-altera" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Alterar Estoque</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="altera_estoque">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="CNPJ">Produto</label>
                    <select class="browser-default custom-select" id="id_produto_alterar" name="id_produto_alterar" disabled>
                      <option selected>Selecione Um Produto</option>



                      @foreach($produtos as $produto)

                      <option value="{{$produto->id}}">{{$produto->nome}}</option>


                      @endforeach

                    </select>

                  </div>
                </div>
              </div>
              <div class="row"><br></div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Quantidade</label>
                    <input class="form-control" type="number" min='1' id="quantidade_alterar" name="quantidade_alterar"
                      aria-describedby="Quantidade" placeholder="Digite a Quantidade em Estoque">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Minimo em Estoque</label>
                    <input class="form-control" type="number" min='1' name="estoque_minimo_alterar" id="estoque_minimo_alterar"
                      aria-describedby="estoque_minimo" placeholder="Digite o estoque minimo">
                  </div>
                </div>
              </div>

          </div>
          <input type="hidden" name="id_altera" id="id_altera">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="alterar_estoque()">Alterar</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body">


        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0"> Listagem de Estoque</h4>

        </div>
        <div class="mt-4 mb-4">
          <button type="button" class="btn btn-info float-left" data-toggle="modal" data-target="#exampleModalCenter">
            Cadastro de Estoque
          </button>
        </div>
        <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
          <thead>
            <tr class="text-center">
              <th>Produto</th>
              <th>Quantidade</th>
              <th>Usuario</th>
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
		ajax: '/estoque',
		dom: 'Bfrtip',
		buttons: [{
			text: 'My button',
			action: function (e, dt, node, config) {
				alert('Button activated');
			}
		}],
		columns: [{
			data: 'produto',
			name: 'produto'
		}, {
			data: 'quantidade',
			name: 'quantidade',
		}, {
			data: 'usuario',
			name: 'usuario',
		},{
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
  },]
	});
});

  function cadastro_estoque(value) {
    $.ajax({
      type: "POST",
      data: $('#cadastro_estoque').serialize(),
      url: "estoque/",
      success:function(response){
        //console.log(response);
        if(response) {
          $('#tabela').DataTable().ajax.reload();
          swal("Sucesso!","Estoque Cadastrado" , "success");
          $("#exampleModalCenter").modal("hide");
        }else{
          swal("error!","Estoque ja Cadastrado" , "error");
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
      // data: $('#cadastro_estoque').serialize(),
      url: `estoque/${id}`,
      success:function(response){
        $("#id_produto_alterar").val(response.id_produto);
        $("#quantidade_alterar").val(response.quantidade);
        $("#estoque_minimo_alterar").val(response.estoque_minimo);
        $("#id_altera").val(response.id);
        $("#modal-estoque-altera").modal("show");

      },
      error: function(error) {
        console.log(error);
      }
    });
  }

  function alterar_estoque(){
    let id = $("#id_altera").val();
 
    $.ajax({
      type: "POST",
      data: $('#altera_estoque').serialize(),
      url: `estoque/${id}`,
      success:function(response){
          $('#tabela').DataTable().ajax.reload();
          $("#modal-estoque-altera").modal("hide");
          swal("Sucesso!","Estoque Alterado" , "success");
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
      //data: $('#cadastro_estoque').serialize(),
      url: `estoque/${id}`,
      success:function(response){
        $('#tabela').DataTable().ajax.reload();
        swal("Sucesso!","Estoque Apagado" , "success");
      },
      error: function(error) {
        console.log(error);
      }
    });
  }


</script>

@endsection