<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>@yield('title', __('admin.title'))</title>
    @stack('styles')
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.home.index') }}">
                <i class="bi bi-shield-lock"></i> {{ __('admin.title') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.home.index') }}">
                            <i class="bi bi-house-door"></i> {{ __('admin.dashboard.title') }}
                        </a>
                    </li>
                    <!-- Products -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bag"></i> {{ __('app.products_nav') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.product.index') }}">
                                    <i class="bi bi-list"></i> {{ __('admin.products.list.title') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.product.create') }}">
                                    <i class="bi bi-plus-circle"></i> {{ __('admin.products.create.title') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Categories -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-tags"></i> {{ __('admin.dashboard.categories.title') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.category.index') }}">
                                    <i class="bi bi-list"></i> {{ __('admin.dashboard.categories.view') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.category.create') }}">
                                    <i class="bi bi-plus-circle"></i> {{ __('admin.dashboard.categories.create') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->getName() }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form id="logout" action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                @csrf
                                <a role="button" class="nav-link text-danger"
                                    onclick="document.getElementById('logout').submit();">
                                    <i class="bi bi-box-arrow-right"></i> {{ __('app.logout') }}
                                </a>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    @stack('scripts')
</body>

</html>