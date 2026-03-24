@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h1 class="fs-5 mb-0">{{ $viewData['title'] }}</h1>
                <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> {{ __('app.cart.back_to_products') }}
                </a>
            </div>

            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (count($viewData['products']) == 0)
                    <div class="alert alert-info">
                        <i class="bi bi-cart-x me-2"></i> {{ __('app.cart.empty') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ __('app.cart.table.product') }}</th>
                                    <th>{{ __('app.cart.table.price') }}</th>
                                    <th>{{ __('app.cart.table.quantity') }}</th>
                                    <th>{{ __('app.cart.table.subtotal') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData['products'] as $product)
                                    <tr>
                                        <td class="text-start">
                                            <a href="{{ route('product.show', ['id' => $product->getId()]) }}">
                                                {{ $product->getTitle() }}
                                            </a>
                                        </td>
                                        <td>${{ number_format($product->getPrice(), 2) }}</td>
                                        <td>{{ session('products')[$product->getId()] }}</td>
                                        <td>${{ number_format($product->getPrice() * session('products')[$product->getId()], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end align-items-center gap-3 mt-3">
                        <span class="fw-bold fs-5">
                            {{ __('app.cart.total') }}: ${{ number_format($viewData['total'], 2) }}
                        </span>

                        <form action="{{ route('cart.purchase') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-bag-check me-1"></i> {{ __('app.cart.confirm_purchase') }}
                            </button>
                        </form>

                        <a href="{{ route('cart.delete') }}" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> {{ __('app.cart.clear') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection