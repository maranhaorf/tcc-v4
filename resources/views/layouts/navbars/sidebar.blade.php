<div class="sidebar" data-color="green" data-background-color="white"
  data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/home" class="simple-text logo-normal">
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
            <li class="nav-item{{ $activePage == 'editar_perfil' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> EP </span>
                <span class="sidebar-normal">{{ __('Editar Perfil') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'perfil' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('perfil') }}">
                <span class="sidebar-mini"> GU </span>
                <span class="sidebar-normal"> {{ __('Gerenciar Usuarios') }} </span>
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
            <li class="nav-item{{ $activePage == 'gerenciar_produto' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('produto') }}">
                <span class="sidebar-mini"> GP </span>
                <span class="sidebar-normal">{{ __('Gerenciar Produtos') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>

    <ul class="nav">
      <li class="nav-item {{ ($activePage == 'estoques' || $activePage == 'estoques') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#estoques" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/estoque.svg"></i>
          <p>{{ __('Estoque') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="estoques">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'gerenciar_estoque' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('estoque') }}">
                <span class="sidebar-mini"> GP </span>
                <span class="sidebar-normal">{{ __('Gerenciar Estoque') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>


    <ul class="nav">
      <li class="nav-item {{ ($activePage == 'pedidos' || $activePage == 'pedidos') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#pedidos" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/pedido.svg"></i>
          <p>{{ __('Pedidos') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="pedidos">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'gerenciar_pedidos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('pedido') }}">
                <span class="sidebar-mini"> GP </span>
                <span class="sidebar-normal">{{ __('Gerenciar Pedido') }} </span>
              </a>
              
            </li>
            <li class="nav-item{{ $activePage == 'separacao_pedidos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('finalizado') }}">
                <span class="sidebar-mini"> SP </span>
                <span class="sidebar-normal">{{ __('Separaçaõ de Pedidos') }} </span>
              </a>
              
            </li>
            <li class="nav-item{{ $activePage == 'pedidos_finalizados' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('concluido') }}">
                <span class="sidebar-mini"> PF </span>
                <span class="sidebar-normal">{{ __('Pedidos Finalizados') }} </span>
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
            
            <li class="nav-item{{ $activePage == 'gerenciar_fonecedores' ? ' active' : '' }}">
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