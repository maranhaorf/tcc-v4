@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Produtos Vendidos</p>
              <h3 class="card-title">{{$quantidade[0]->quantidade  }}
              
              </h3>
            </div>
            <div class="card-footer">
    
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Venda Hoje</p>

              <h3 class="card-title">R$: {{$valor[0]->valor  }}</h3>
            </div>
            <div class="card-footer">
          
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Separaçao Produtos</p>
              <h3 class="card-title"> {{$separacao[0]->quantidade  }}</h3>
            </div>
            <div class="card-footer">
            
            </div>
          </div>
        </div>
    
      </div>
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Numero de Venda</h4>
             
            </div>
            <div class="card-body table-responsive">
              <table id="tabela" class="table table-striped yajra-datatable" style="width:100%">
                <thead class="text-warning">
                  <tr class="text-center">
                  <th>Nome</th>
                  <th>Valor</th>
                  <th>Numero de Venda</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  
                 
                </tbody>
              </table>
            </div>
          </div>
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
		ajax: `/home`,

		columns: [{
			data: 'nome',
			name: 'nome',
		}, {
			data: 'valor',
			name: 'valor',
		},{
			data: 'venda',
			name: 'venda',
		},
   ]
	});
});



</script>
@endsection

@push('js')

@endpush