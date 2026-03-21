@extends('layouts.app')

@section('title', __('app.title'))

@section('content')
    <!-- Hero Section -->
    <div class="p-5 mb-4 bg-dark text-white rounded-3">
        <div class="container-fluid py-3">
            <h1 class="display-5 fw-bold">{{ __('app.hero.title') }}</h1>
            <p class="col-md-8 fs-4">{{ __('app.hero.subtitle') }}</p>
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-bag me-2"></i>{{ __('app.hero.shop_now') }}
            </a>
            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg ms-2">
                    <i class="bi bi-person-plus me-2"></i>{{ __('app.hero.register') }}
                </a>
            @endguest
        </div>
    </div>

    <!-- Features Section -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 text-center p-3">
                <div class="card-body">
                    <i class="bi bi-award fs-1 text-primary"></i>
                    <h3 class="card-title mt-3">{{ __('app.features.quality.title') }}</h3>
                    <p class="card-text">{{ __('app.features.quality.description') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center p-3">
                <div class="card-body">
                    <i class="bi bi-truck fs-1 text-primary"></i>
                    <h3 class="card-title mt-3">{{ __('app.features.shipping.title') }}</h3>
                    <p class="card-text">{{ __('app.features.shipping.description') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center p-3">
                <div class="card-body">
                    <i class="bi bi-headset fs-1 text-primary"></i>
                    <h3 class="card-title mt-3">{{ __('app.features.support.title') }}</h3>
                    <p class="card-text">{{ __('app.features.support.description') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Preview Section -->
    <div class="card mb-4">
        <div class="card-body text-center py-5">
            <h2>{{ __('app.products_preview.title') }}</h2>
            <p class="text-muted">{{ __('app.products_preview.subtitle') }}</p>
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-bag me-2"></i>{{ __('app.products_preview.view_all') }}
            </a>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="p-5 bg-primary text-white rounded-3 text-center">
        <h2>{{ __('app.cta.title') }}</h2>
        <p class="fs-5">{{ __('app.cta.subtitle') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-light btn-lg me-2">
            <i class="bi bi-shop me-2"></i>{{ __('app.cta.shop_now') }}
        </a>
        @auth
            <a href="{{ route('user.orders') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-box-seam me-2"></i>{{ __('app.cta.my_orders') }}
            </a>
        @else
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-person-plus me-2"></i>{{ __('app.cta.register') }}
            </a>
        @endauth
    </div>
@endsection