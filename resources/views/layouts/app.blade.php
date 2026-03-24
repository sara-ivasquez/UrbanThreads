<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <title>@yield('title', __('app.title'))</title>
    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-urban">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="{{ asset('img/logo.png') }}" alt="{{ __('app.title') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}">
                            <i class="bi bi-house-door"></i> {{ __('app.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">
                            <i class="bi bi-bag"></i> {{ __('app.products_nav') }}
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.orders') }}">
                                <i class="bi bi-box-seam"></i> {{ __('app.my_orders') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart3"></i> {{ __('app.cart.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.show') }}">
                                <i class="bi bi-person"></i> {{ __('app.my_profile') }}
                            </a>
                        </li>
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item me-3">
                            <span class="budget-badge">
                                <i class="bi bi-wallet2 me-1"></i>${{ number_format(Auth::user()->getBudget(), 2) }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form id="logout" action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                @csrf
                                <a role="button" class="nav-link"
                                    onclick="document.getElementById('logout').submit();">
                                    <i class="bi bi-box-arrow-right"></i> {{ __('app.logout') }}
                                </a>
                            </form>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> {{ __('app.login') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn-urban btn">
                                <i class="bi bi-person-plus me-1"></i> {{ __('app.register') }}
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <img src="{{ asset('img/logo.png') }}" alt="{{ __('app.title') }}" style="height: 35px;" class="mb-2">
            <p class="mb-0 small">© {{ date('Y') }} Urban Threads. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    @stack('scripts')
</body>

</html>