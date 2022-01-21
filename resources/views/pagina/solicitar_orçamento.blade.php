@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'orcamento', 'title' => __('J.A
ALUMINIO')])

@section('content')
<div class="container" style="height: auto;">

    <div class="col-md-9 ml-auto mr-auto mb-3 text-center">

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title mt-0"> Listagem dos Item Pedido</h4>
            </div>
            <div class="card-body">
                <form id="cadastro_pedido">
                    @csrf

                    <div class="form-group">
                        <label for="Nome">Nome do Solicitante</label>
                        <input type="text" class="form-control" id="nome_cliente" name='nome_cliente'
                            aria-describedby="nome_cliente" placeholder="Digite o  seu Nome ">
                    </div>
                    <div class="form-group">
                        <label for="Nome">Dado Cliente Solicitante - CPF/CNPJ</label>
                        <input type="text" class="form-control" id="cpf_cliente" name='cpf_cliente'
                            aria-describedby="cpf_cliente" placeholder="Digite o CPF ou Cnpj do Cliente">
                    </div>
                    <div class="form-group">
                        <label for="CNPJ">Telefone Solicitante</label>
                        <input class="form-control" type="tel" id="telefone_cliente" name="telefone_cliente"
                            aria-describedby="telefone_cliente" placeholder="Digite o telefone para contato">
                    </div>
                    <div class="form-group">
                        <label for="CNPJ">E-mail Solicitante</label>
                        <input class="form-control" type="email" id="email_cliente" name="email_cliente"
                            aria-describedby="telefone_cliente" placeholder="Digite o Email Para contato">
                    </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-primary" onclick="cadastro_pedido()">Enviar</button>
            </div>
            </form>

        </div>
    </div>
</div>

</div>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>
  function cadastro_pedido(value) {
    $.ajax({
      type: "POST",
      data: $('#cadastro_pedido').serialize(),
      url: "orcamento/",
      success:function(response){
        //console.log(response);
        if(response) {
            window.location.href = "/orcamento_pedido/"+response.cpf;

        }
      },
      error: function(error) {
        console.log(error);
      }
    });
  }

</script>

@endsection