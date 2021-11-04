@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
{{--          <h1 class="text-white text-center">{{ __('Welcome Blade') }}</h1>--}}
            <img class=" mb-5" src="/public/material/img/aaa.svg" alt="Logo da Empresa" />
            <h1 class=" text-uppercase mb-0">ALUMI</h1>
            <h1 class=" text-uppercase mb-0">CONSTRUINDO PRA VOCÊ</h1>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <p class="masthead-subheading font-weight-light mb-0">Esquadrias - Alumínios - Materiais - Pintura</p>

      </div>
  </div>
</div>
{{--<header class="masthead bg-primary text-white text-center">--}}
{{--    <div class="container d-flex align-items-center flex-column">--}}
{{--        <!-- Masthead Avatar Image-->--}}
{{--        <img class="masthead-avatar mb-5" src="assets/img/aaa.svg" alt="..." />--}}
{{--        <!-- Masthead Heading-->--}}
{{--        <h1 class="masthead-heading text-uppercase mb-0">ALUMI</h1>--}}
{{--        <h1 class="masthead-heading text-uppercase mb-0">CONSTRUINDO PRA VOCÊ</h1>--}}
{{--        <!-- Icon Divider-->--}}
{{--        <div class="divider-custom divider-light">--}}
{{--            <div class="divider-custom-line"></div>--}}
{{--            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>--}}
{{--            <div class="divider-custom-line"></div>--}}
{{--        </div>--}}
{{--        <!-- Masthead Subheading-->--}}
{{--        <p class="masthead-subheading font-weight-light mb-0">Esquadrias - Alumínios - Materiais - Pintura</p>--}}
{{--    </div>--}}
{{--</header>--}}
@endsection
