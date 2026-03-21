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
                    <!-- Product Image -->
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('img/' . $viewData['product']->getImage()) }}"
                            class="img-fluid rounded" alt="{{ $viewData['product']->getTitle() }}">
                    </div>

                    <!-- Product Details -->
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
                                                @if($viewData['product']->getStock() > 0)
                                                    <span class="badge bg-success">{{ $viewData['product']->getStock() }}</span>
                                                @else
                                                    <span class="badge bg-danger">0</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('app.products.show.state') }}</th>
                                            <td>
                                                @if($viewData['product']->getState() == 'active')
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

                        <!-- Product Description -->
                        <div class="mb-4">
                            <h5>{{ __('app.products.show.description') }}</h5>
                            <div class="p-3 bg-light rounded">
                                {{ $viewData['product']->getDescription() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">{{ __('app.reviews.title') }}</h5>
                            </div>
                            <div class="card-body">
                                @if(count($viewData['reviews']) > 0)
                                    @foreach($viewData['reviews'] as $review)
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