@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h1 class="fs-5 mb-0">{{ $viewData['product']->getTitle() }}</h1>
                <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> {{ __('app.products.show.back_to_list') }}
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img
                            src="{{ asset('img/' . $viewData['product']->getImage()) }}"
                            class="img-fluid rounded"
                            alt="{{ $viewData['product']->getTitle() }}"
                        >
                    </div>

                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5>{{ __('app.products.show.details') }}</h5>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>{{ __('app.products.show.price') }}</th>
                                            <td>${{ number_format($viewData['product']->getPrice(), 2) }}</td>
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
                                        Comprar producto
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('order.purchase') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">

                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">{{ __('app.user.orders.quantity') }}</label>
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

                                            <button type="submit" class="btn btn-primary">
                                                Comprar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mt-3">
                                    Producto no disponible para compra.
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">{{ __('app.reviews.title') }}</h5>
                            </div>
                            <div class="card-body">
                                @if (count($viewData['reviews']) > 0)
                                    @foreach ($viewData['reviews'] as $review)
                                        <div class="mb-3 p-3 bg-light rounded">
                                            <div class="d-flex justify-content-between">
                                                <strong>{{ $review->getQualification() }}/5 ⭐</strong>
                                                <small class="text-muted">{{ $review->getCreatedAt() }}</small>
                                            </div>
                                            <p class="mb-0 mt-2">{{ $review->getDescription() }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">
                                        {{ __('app.reviews.no_reviews') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection