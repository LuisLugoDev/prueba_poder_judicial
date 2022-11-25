<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    @include('layouts.header')


    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @auth
                @if (auth()->user()->role == 'admin')
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                        @endif
                        @endauth
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    @auth
                    <!-- boton menu -->
                    <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                        <i class="fa-solid fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
                    </button>
                    @endauth
                    <!-- boton session -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.index') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register.index') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('login.destroy') }}">
                                        {{ __('Logout') }}
                                    </a>


                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
            </div>
        </nav>
        @auth

        <div class="offcanvas offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
            <div class="offcanvas-header">
                <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Menu</h6>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body px-0">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-5 bi-bootstrap"></i><span class="ms-1 d-none d-sm-inline">Cruds</span>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdown">
                            <li><a class="dropdown-item" href="{{ Route('productos.index') }}">Productos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col min-vh-100 py-3">
                    <!-- toggler -->
                    @endauth
                    <main class="py-4">
                        @yield('content')
                    </main>
                    @auth
                </div>
            </div>
        </div>
        @endauth
    </div>
    @include('layouts.footer')
</body>

</html>