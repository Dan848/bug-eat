<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Bug Makers')</title>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="bg-dark text-bg-dark">
    <div id="app">


        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary justify-content-between">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 fw-medium hover-scale" href="{{ url('/') }}">
                <span><img src="/img/general/logo-white.png" alt="logo" width="80px"></span>
            </a>
            <!-- RIGHT SIDE NAVBAR -->
            <div>
                <!-- Navbar DropDown-->
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
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
