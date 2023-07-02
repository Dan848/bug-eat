<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Bug Makers')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="sb-nav-fixed text-bg-dark">
    <div id="app">

        {{-- NAVBAR --}}
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary justify-content-between">
            <!-- Left Side Navbar-->
            <div>
                <!-- Navbar Brand-->
                <a class="navbar-brand ps-3 fw-medium hover-scale" href="{{ url('/') }}">Bug-Eat
                    <span><img src="/img/logo-inverted.png" alt="logo" width="25px" height="25px"></span>
                </a>
                <!-- Sidebar Toggle-->
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 hover-scale fs-5" id="sidebarToggle"
                    href="#!"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <!-- Right Side Navbar-->
            <div>
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}<i
                                    class="fas fa-user fa-fw"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end bg-primary" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ url('admin') }}">{{ __('Dashboard') }}</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
            <!-- Navbar DropDown-->

        </nav>
        {{-- SIDEBAR --}}
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light bg-primary" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Board</div>
                            <a class="nav-link text-white hover-scale" href="{{ route('admin.dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line"></i></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">File</div>
                            <a class="nav-link collapsed" href="{{ route('admin.restaurants.index') }}"
                                data-bs-toggle="collapse" data-bs-target="#collapserestaurants" aria-expanded="false"
                                aria-controls="collapserestaurants">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                                Ristoranti
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapserestaurants" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('admin.restaurants.index') }}">Elenco
                                        Ristoranti</a>
                                    <a class="nav-link" href="{{ route('admin.restaurants.create') }}">Crea Ristorante</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseType" aria-expanded="false" aria-controls="collapseType">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-drumstick-bite"></i></div>
                                Prodotti
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseType" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('admin.products.index') }}">Elenco Prodotti</a>
                                    <a class="nav-link" href="{{ route('admin.products.create') }}">Crea Prodotti</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseItem" aria-expanded="false" aria-controls="collapseItem">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                                Tipi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseItem" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('admin.types.index') }}">Elenco Tipi</a>
                                    <a class="nav-link" href="{{ route('admin.types.create') }}">Crea Tipi</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer bg-secondary">
                        <div class="small">Logged in as:</div>
                        <span class="fw-medium">{{ Auth::user()->name }}</span>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="">
                    @yield('content')
                </main>
                @include('partials.footer-admin')
            </div>
        </div>
    </div>
</body>

</html>
