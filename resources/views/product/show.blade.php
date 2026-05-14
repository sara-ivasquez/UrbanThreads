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
                <li class="breadcrumb-item">
                    <a href="{{ route('product.index') }}">{{ __('app.products_nav') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $viewData['product']->getTitle() }}
                </li>
            </ol>
        </nav>
    </div>
@endpush

@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h1 class="fs-5 mb-0">{{ $viewData['product']->getTitle() }}</h1>
                <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> {{ __('app.products.show.back_to_list') }}
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="row g-4">
                    <div class="col-12 col-md-4 text-center">
                        <img
                            src="{{ asset('storage/' . $viewData['product']->getImage()) }}"
                            class="img-fluid rounded w-100"
                            style="max-height: 350px; object-fit: cover;"
                            alt="{{ $viewData['product']->getTitle() }}"
                        >
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5>{{ __('app.products.show.details') }}</h5>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>{{ __('app.products.show.price') }}</th>
                                            <td>${{ number_format($viewData['product']->getPrice(), 2) }} COP</td>
                                        </tr>
                                        <tr>
                                            <th>USD</th>
                                            <td>
                                                @if($viewData['convertedPrices']['USD'])
                                                    ${{ number_format($viewData['convertedPrices']['USD'], 2) }} USD
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>EUR</th>
                                            <td>
                                                @if($viewData['convertedPrices']['EUR'])
                                                    €{{ number_format($viewData['convertedPrices']['EUR'], 2) }} EUR
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('app.products.show.category') }}</th>
                                            <td>{{ $viewData['product']->getCategory()->getName() }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('app.products.show.stock') }}</th>
                                            <td>
                                                @if ($viewData['product']->getStock() > 0)
                                                    <span class="badge bg-success">{{ $viewData['product']->getStock() }}</span>
                                                @else
                                                    <span class="badge bg-danger">0</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('app.products.show.state') }}</th>
                                            <td>
                                                @if ($viewData['product']->getState() == 'active')
                                                    <span class="badge bg-success">{{ __('app.products.show.state_active') }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ __('app.products.show.state_inactive') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>{{ __('app.products.show.description') }}</h5>
                            <div class="p-3 bg-light rounded">
                                {{ $viewData['product']->getDescription() }}
                            </div>
                        </div>

                        @auth
                            @if ($viewData['product']->getState() == 'active' && $viewData['product']->getStock() > 0)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        {{ __('app.cart.add_to_cart') }}
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">
                                                    {{ __('app.order.purchase.quantity') }}
                                                </label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    id="quantity"
                                                    name="quantity"
                                                    min="1"
                                                    max="{{ $viewData['product']->getStock() }}"
                                                    value="1"
                                                    required
                                                >
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="bi bi-cart-plus me-1"></i> {{ __('app.cart.add') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mt-3">
                                    {{ __('app.order.purchase.unavailable') }}
                                </div>
                            @endif
                        @else
                            <div class="alert alert-info mt-3">
                                {{ __('app.order.purchase.login_required') }}
                                <a href="{{ route('login') }}" class="alert-link">{{ __('app.login') }}</a>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">{{ __('app.review.list.title') }}</h5>
                            </div>
                            <div class="card-body">
                                @auth
                                    <div class="mb-4">
                                        @include('components.review.form', ['product' => $viewData['product']])
                                    </div>
                                    <hr>
                                @else
                                    <div class="alert alert-info mb-4">
                                        {{ __('app.review.form.login_to_review') }}
                                        <a href="{{ route('login') }}" class="alert-link">{{ __('app.login') }}</a>
                                    </div>
                                @endauth

                                @include('components.review.list', ['reviews' => $viewData['reviews']])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
