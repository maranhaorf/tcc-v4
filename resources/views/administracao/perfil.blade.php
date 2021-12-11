@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Lista Usuarios')])

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
            <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="cadastro_usuario">
              @csrf
            
                   <div class="form-group">
                       <label for="exampleInputEmail1">Nome</label>
                       <input type="text" class="form-control" id="name" name="name" placeholder="Digite o Nome">
                   </div>
            
            
                   <div class="form-group">
                       <label for="exampleInputPassword1">Usuario</label>
                       <input type="text" class="form-control" id="usuario" name='usuario'
                           placeholder="Digite o usuario">
                   </div>
            
           
                  
           
                   <div class="form-group">
                       <label for="exampleInputPassword1">Senha</label>
                       <input type="password" class="form-control" id="password" name='password'
                           placeholder="Digite a senha">
                   </div>
             
                   <div class="form-group">
                       <label for="exampleInputPassword1">Perfil</label>
                       <select class="browser-default custom-select" id="id_perfil" name="id_perfil">
                           <option selected>Selecione</option>
                           @foreach($perfis as $perfil)
                           
                           <option value="{{$perfil->id}}">{{$perfil->name}}</option>
                           @endforeach
                         </select>


                   </div>

        
             

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="cadastro_usuario()">Cadastrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!--Modal altera-->
    <div class="modal fade" id="modal-usuario-altera" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Alterar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="altera_usuario">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <div class="form-group">
               <label for="exampleInputEmail1">Nome</label>
               <input type="text" class="form-control" id="name_altera" name="name_altera" placeholder="Digite o Nome">
           </div>
    
    
           <div class="form-group">
               <label for="exampleInputPassword1">Usuario</label>
               <input type="text" class="form-control" id="usuario_altera" name='usuario_altera'
                   placeholder="Digite o usuario">
           </div>
    
   
          
   
           <div class="form-group">
               <label for="exampleInputPassword1">Senha</label>
               <input type="password" class="form-control" id="password_altera" name='password_altera'
                   placeholder="Digite a senha">
           </div>
     
           <div class="form-group">
               <label for="exampleInputPassword1">Perfil</label>
               <select class="browser-default custom-select" id="id_perfil_altera" name="id_perfil_altera">
                   <option selected>Selecione</option>
                   @foreach($perfis as $perfil)
                   
                   <option value="{{$perfil->id}}">{{$perfil->name}}</option>
                   @endforeach
                 </select>


           </div>

          </div>
          <input type="hidden" name="id_altera" id="id_altera">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="alterar_usuario()">Alterar</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body">


        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0"> Listagem de Usuario</h4>

        </div>
        <div class="mt-4 mb-4">
          <button type="button" class="btn btn-info float-left" data-toggle="modal" data-target="#exampleModalCenter">
            Cadastro de Usuario
          </button>
        </div>
        <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
          <thead>
            <tr class="text-center">
              <th>Nome</th>
              <th>Usuario</th>
              <th>Açãoes</th>
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
		ajax: '/perfil',
		dom: 'Bfrtip',
		buttons: [{
			text: 'My button',
			action: function (e, dt, node, config) {
				alert('Button activated');
			}
		}],
		columns: [{
			data: 'name',
			name: 'name'
		}, {
			data: 'usuario',
			name: 'usuario',
		},
    {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
  },]
	});
});

  function cadastro_usuario(value) {
    $.ajax({
      type: "POST",
      data: $('#cadastro_usuario').serialize(),
      url: "/perfil/",
      success:function(response){
        
        if(response) {
          $('#tabela').DataTable().ajax.reload();
          swal("Sucesso!","Usuario Cadastrado" , "success");
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
      // data: $('#cadastro_usuario').serialize(),
      url: `/perfil/${id}`,
      success:function(response){
        $("#name_altera").val(response.name);
        $("#usuario_altera").val(response.usuario);
       
        $("#password_altera").val(response.password);
        $("#id_perfil_altera").val(response.id_perfil);
        $("#id_altera").val(response.id);
        $("#modal-usuario-altera").modal("show");

      },
      error: function(error) {
        console.log(error);
      }
    });
  }

  function alterar_usuario(){
    let id = $("#id_altera").val();
 
    $.ajax({
      type: "POST",
      data: $('#altera_usuario').serialize(),
      url: `/perfil/${id}`,
      success:function(response){
         if(response){
            $('#tabela').DataTable().ajax.reload();
          $("#modal-usuario-altera").modal("hide");
          
          swal("Sucesso!","Usuario Alterado" , "success");
         }else{
            swal("ERROR!","Verifique os Dados" , "error");
         }
         
      },
      error: function(error) {
        console.log(error);
        swal("ERROR!","Verifique os Dados" , "error");
      }
    });
  }
  

  function excluir(id){
    $.ajax({
      type: "DELETE",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      //data: $('#cadastro_usuario').serialize(),
      url: `/perfil/${id}`,
      success:function(response){
        $('#tabela').DataTable().ajax.reload();
        swal("Sucesso!","Usuario Apagado" , "success");
      },
      error: function(error) {
        console.log(error);
      }
    });
  }


</script>

@endsection