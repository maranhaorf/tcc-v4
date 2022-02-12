<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('home') }}"> J.A ALUMINIO</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        

  
        <li class="nav-item ">
          <a href="{{ route('profile.edit') }}" class="nav-link">
            <i class="material-icons">face</i> {{ __('Portifólio') }}
          </a>
        </li>

        <li class="nav-item{{ $activePage == 'sobre_nos' ? ' active' : '' }}">
          <a href="{{ url('/sobre_nos') }}" class="nav-link">
            <i class="material-icons">group</i> {{ __('Sobre Nós') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'disponibilidade' ? ' active' : '' }}">
          <a href="{{ url('disponibilidade') }}" class="nav-link">
            <i class="material-icons">search</i> {{ __('Consulta Disponibilidade') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'orcamento' ? ' active' : '' }}">
          <a href="{{ url('orcamento') }}" class="nav-link">
            <i class="material-icons">request_page</i> {{ __('Solicitar Orçamento') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->