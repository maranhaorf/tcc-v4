@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Lista Produtos')])

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
              <h3 class="card-title">8
              
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
              <h3 class="card-title">R$: 342,24</h3>
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
              <h3 class="card-title">0</h3>
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
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Venda</th>
                  <th>Numero de Venda</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Davidson Rocha</td>
                    <td>R$: 342,24</td>
                    <td>8</td>
                  </tr>
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush