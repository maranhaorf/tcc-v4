@extends('layouts.app', ['activePage' => 'gerenciar_produto', 'titlePage' => __('Lista Produtos')])

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
            <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Produto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="cadastro_produto">
              @csrf
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="Nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name='nome' aria-describedby="nome"
                      placeholder="Digite o Nome do Produto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="Nome">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name='descricao' aria-describedby="descricao"
                      placeholder="Digite a Descrição do Produto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Valor</label>
                    <input class="form-control" type="number" step="0.01" id="valor" name="valor" aria-describedby="valor"
                      placeholder="Digite o valor do Produto">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Tamanho</label>
                    <input class="form-control" type="text" name="tamanho"  id="tamanho" aria-describedby="tamanho"
                      placeholder="Digite o tamanho do Produto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Cor</label>
                    <input class="form-control" type="text"  id="cor" name="cor" aria-describedby="cor"
                      placeholder="Digite o Cor do Produto">
                  </div>
                </div>
              </div>
                <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="CNPJ">Fornecedor</label>
                    <select class="browser-default custom-select" id="id_fornecedor" name="id_fornecedor" >
                      <option selected>Selecione Um Fornecedor</option>
                    
                       
                    
                      @foreach($fornecedores as $fornecedor)
                  
                      <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                        
                
                      @endforeach
                
                    </select>
         
                  </div>
                </div>
              </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="cadastro_produto()">Cadastrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!--Modal altera-->
    <div class="modal fade" id="modal-produto-altera" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Alterar Produto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="altera_produto">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="Nome">Nome</label>
                    <input type="text" class="form-control" id="nome_altera" name='nome_altera' aria-describedby="nome_altera"
                      placeholder="Digite o Nome do Produto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="Nome">Descrição</label>
                    <input type="text" class="form-control" id="descricao_altera" name='descricao_altera' aria-describedby="descricao_altera"
                      placeholder="Digite a Descrição do Produto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Valor</label>
                    <input class="form-control" type="number" step="0.01" id="valor_altera" name="valor_altera" aria-describedby="valor_altera"
                      placeholder="Digite o valor do Produto">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Tamanho</label>
                    <input class="form-control" type="text" name="tamanho_altera"  id="tamanho_altera" aria-describedby="tamanho_altera"
                      placeholder="Digite o tamanho do Produto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="CNPJ">Cor</label>
                    <input class="form-control" type="text"  id="cor_altera" name="cor_altera" aria-describedby="cor_altera"
                      placeholder="Digite o Cor do Produto">
                  </div>
                </div>
              </div>
                <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="CNPJ">Fornecedor</label>
                    <select class="browser-default custom-select" id="id_fornecedor_altera" name="id_fornecedor_altera" >
                      <option selected>Selecione Um Fornecedor</option>
                
                       
                    
                      @foreach($fornecedores as $fornecedor)
                  
                      <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                        
                
                      @endforeach
              
                    </select>
         
                  </div>
                </div>
              </div>

          </div>
          <input type="hidden" name="id_altera" id="id_altera">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="alterar_produto()">Alterar</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body">


        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0"> Listagem de Produto</h4>

        </div>
        <div class="mt-4 mb-4">
          <button type="button" class="btn btn-info float-left" data-toggle="modal" data-target="#exampleModalCenter">
            Cadastro de Produto
          </button>
        </div>
        <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
          <thead>
            <tr class="text-center">
              <th>Nome</th>
              <th>Tamanho</th>
              <th>Descrição</th>
              <th>Cor</th>
              <th>Valor</th>
              <th>Fornecedor</th>
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
		ajax: '/produto',
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
			data: 'tamanho',
			name: 'tamanho',
		}, {
			data: 'descricao',
			name: 'descricao',
		}, {
			data: 'cor',
			name: 'cor',
		}, {
			data: 'valor',
			name: 'valor',
    }, {
			data: 'fornecedor',
			name: 'fornecedor',
		},
    {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
  },]
	});
});

  function cadastro_produto(value) {
    $.ajax({
      type: "POST",
      data: $('#cadastro_produto').serialize(),
      url: "produto/",
      success:function(response){
        //console.log(response);
        if(response) {
          $('#tabela').DataTable().ajax.reload();
          swal("Sucesso!","Produto Cadastrado" , "success");
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
      // data: $('#cadastro_produto').serialize(),
      url: `produto/${id}`,
      success:function(response){
        $("#nome_altera").val(response.nome);
        $("#tamanho_altera").val(response.tamanho);
        $("#descricao_altera").val(response.descricao);
        $("#valor_altera").val(response.valor);
        $("#cor_altera").val(response.cor);
        $("#id_altera").val(response.id);
        $("#id_fornecedor_altera").val(response.id_fornecedor);
        $("#modal-produto-altera").modal("show");

      },
      error: function(error) {
        console.log(error);
      }
    });
  }

  function alterar_produto(){
    let id = $("#id_altera").val();
 
    $.ajax({
      type: "POST",
      data: $('#altera_produto').serialize(),
      url: `produto/${id}`,
      success:function(response){
          $('#tabela').DataTable().ajax.reload();
          $("#modal-produto-altera").modal("hide");
          swal("Sucesso!","Produto Alterado" , "success");
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
      //data: $('#cadastro_produto').serialize(),
      url: `produto/${id}`,
      success:function(response){
        $('#tabela').DataTable().ajax.reload();
        swal("Sucesso!","Produto Apagado" , "success");
      },
      error: function(error) {
        console.log(error);
      }
    });
  }


</script>

@endsection