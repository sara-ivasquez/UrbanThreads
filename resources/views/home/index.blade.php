{{-- Made by: Sara Vasquez --}}
@extends('layouts.app')

@section('title', __('app.title'))

@section('content')
    <!-- Hero Section -->
    <div class="hero-section rounded-3 mb-5 p-5 text-white">
        <div class="row align-items-center">
            <div class="col-md-7 py-3">
                <h1 class="display-4 fw-bold mb-3">{{ __('app.hero.title') }}</h1>
                <p class="fs-5 mb-4 text-white-50">{{ __('app.hero.subtitle') }}</p>
                <a href="{{ route('product.index') }}" class="btn btn-warning btn-lg fw-bold rounded-pill me-2">
                    <i class="bi bi-bag me-2"></i>{{ __('app.hero.shop_now') }}
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg rounded-pill">
                        <i class="bi bi-person-plus me-2"></i>{{ __('app.hero.register') }}
                    </a>
                @endguest
            </div>
            <div class="col-md-5 text-center d-none d-md-block">
                <i class="bi bi-bag-heart" style="font-size: 10rem; color: rgba(255,107,0,0.4);"></i>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card h-100 text-center p-3 border-0 shadow-sm">
                <div class="card-body">
                    <div class="feature-icon-circle">
                        <i class="bi bi-award fs-2" style="color: var(--ut-orange);"></i>
                    </div>
                    <h4 class="card-title fw-bold">{{ __('app.features.quality.title') }}</h4>
                    <p class="card-text text-muted">{{ __('app.features.quality.description') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 text-center p-3 border-0 shadow-sm">
                <div class="card-body">
                    <div class="feature-icon-circle">
                        <i class="bi bi-truck fs-2" style="color: var(--ut-orange);"></i>
                    </div>
                    <h4 class="card-title fw-bold">{{ __('app.features.shipping.title') }}</h4>
                    <p class="card-text text-muted">{{ __('app.features.shipping.description') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section rounded-3 text-center text-white p-5 mb-4">
        <h2 class="fw-bold mb-2">{{ __('app.cta.title') }}</h2>
        <p class="fs-5 mb-4 text-white-50">{{ __('app.cta.subtitle') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-warning btn-lg rounded-pill fw-bold me-2">
            <i class="bi bi-shop me-2"></i>{{ __('app.cta.shop_now') }}
        </a>
        @auth
            <a href="{{ route('user.orders') }}" class="btn btn-outline-light btn-lg rounded-pill">
                <i class="bi bi-box-seam me-2"></i>{{ __('app.cta.my_orders') }}
            </a>
        @else
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg rounded-pill">
                <i class="bi bi-person-plus me-2"></i>{{ __('app.cta.register') }}
            </a>
        @endauth
    </div>
@endsection