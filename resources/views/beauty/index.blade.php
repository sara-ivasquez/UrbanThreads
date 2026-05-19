{{-- Made by: Jacobo Montes --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@push('breadcrumbs')
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home.index') }}">
                        <i class="bi bi-house-door"></i> {{ __('app.home') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('app.beauty.nav') }}
                </li>
            </ol>
        </nav>
    </div>
@endpush

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>{{ $viewData['title'] }}</h1>
                <h5 class="text-muted">{{ $viewData['subtitle'] }}</h5>
            </div>
            <span class="badge bg-secondary fs-6">
                <i class="bi bi-shop me-1"></i> VeneKa Beauty
            </span>
        </div>

        @if(count($viewData['products']) > 0)
            <div class="row">
                @foreach($viewData['products'] as $product)
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">

                                {{-- Type badge --}}
                                @if($product['type'] === 'service')
                                    <span class="badge bg-primary mb-2">
                                        <i class="bi bi-tools me-1"></i>{{ __('app.beauty.service') }}
                                    </span>
                                @else
                                    <span class="badge bg-success mb-2">
                                        <i class="bi bi-box me-1"></i>{{ __('app.beauty.article') }}
                                    </span>
                                @endif

                                <h5 class="card-title fw-bold">{{ $product['name'] }}</h5>
                                <p class="card-text text-muted small">{{ $product['description'] }}</p>

                                <p class="card-text fs-5 text-primary fw-bold">
                                    ${{ number_format($product['price'], 2) }}
                                </p>

                                <p class="card-text small text-muted">
                                    <i class="bi bi-tag me-1"></i>{{ $product['category'] }}
                                </p>

                                {{-- Rating --}}
                                <div class="mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product['rating'])
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-secondary"></i>
                                        @endif
                                    @endfor
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                {{ __('app.beauty.no_products') }}
            </div>
        @endif
    </div>
@endsection
