<div class="sidebar" data-color="orange" data-background-color="white"
  data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('J.A ALUMINIO') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
    </ul>
    <ul class="nav">
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/setting.svg"></i>
          <p>{{ __('Administraçao') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> EP </span>
                <span class="sidebar-normal">{{ __('Editar Perfil') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="nav">
      <li class="nav-item {{ ($activePage == 'produtos' || $activePage == 'produtos') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#produtos" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/shopping.svg"></i>
          <p>{{ __('Produtos') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="produtos">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('produto') }}">
                <span class="sidebar-mini"> GP </span>
                <span class="sidebar-normal">{{ __('Gerenciar Produtos') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('C') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="nav">
      <li class="nav-item {{ ($activePage == 'fornecedores' || $activePage == 'fornecedor') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#fornecedor" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/fornecedor.svg"></i>
          <p>{{ __('fornecedor') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="fornecedor">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="">
                <span class="sidebar-mini"> GP </span>
                <span class="sidebar-normal">{{ __('Gerenciar Fornecedor') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('fornecedor') }}">
                <span class="sidebar-mini"> GF </span>
                <span class="sidebar-normal"> {{ __('Gerenciar Fornecedores') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>


  </div>
</div>