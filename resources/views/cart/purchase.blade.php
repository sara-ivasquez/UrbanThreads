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

            <div class="card-body text-center py-5">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                <h2 class="mt-3">{{ __('app.cart.purchase.success_title') }}</h2>
                <p class="text-muted">{{ __('app.cart.purchase.success_message') }}</p>

                <div class="card mx-auto mt-4" style="max-width: 400px;">
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="text-start">{{ __('app.cart.purchase.order_id') }}</th>
                                    <td class="text-end">#{{ $viewData['order']->getId() }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">{{ __('app.cart.purchase.total') }}</th>
                                    <td class="text-end">${{ number_format($viewData['order']->getTotalPrice(), 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">{{ __('app.cart.purchase.state') }}</th>
                                    <td class="text-end">
                                        <span class="badge bg-warning">{{ $viewData['order']->getState() }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-center gap-3">
                    <a href="{{ route('user.orders') }}" class="btn btn-primary">
                        <i class="bi bi-box-seam me-1"></i> {{ __('app.cart.purchase.view_orders') }}
                    </a>
                    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-bag me-1"></i> {{ __('app.cart.purchase.continue_shopping') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection