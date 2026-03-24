@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h1>{{ $viewData['title'] }}</h1>
                <h5 class="text-muted">{{ $viewData['subtitle'] }}</h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-box-seam me-2"></i>{{ $viewData['title'] }}
                </h5>
            </div>
            <div class="card-body">
                @if ($viewData['orders']->isEmpty())
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ __('admin.orders.index.no_orders') }}
                    </div>
                @else
                    @foreach ($viewData['orders'] as $order)
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">
                                    {{ __('admin.orders.index.order') }} #{{ $order->getId() }}
                                </span>
                                <span class="badge bg-warning">{{ $order->getState() }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <p class="mb-1">
                                            <i class="bi bi-person me-1"></i>
                                            <strong>{{ __('admin.orders.index.customer') }}:</strong>
                                            {{ $order->getUser()->getName() }}
                                        </p>
                                        <p class="mb-1">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            <strong>{{ __('admin.orders.index.address') }}:</strong>
                                            {{ $order->getUser()->getAddress() }}
                                        </p>
                                        <p class="mb-1">
                                            <i class="bi bi-calendar me-1"></i>
                                            <strong>{{ __('admin.orders.index.date') }}:</strong>
                                            {{ $order->getCreatedAt() }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <h5 class="text-primary">
                                            {{ __('admin.orders.index.total') }}:
                                            ${{ number_format($order->getTotalPrice(), 2) }}
                                        </h5>
                                    </div>
                                </div>

                                <table class="table table-bordered table-sm text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>{{ __('admin.orders.index.product') }}</th>
                                            <th>{{ __('admin.orders.index.quantity') }}</th>
                                            <th>{{ __('admin.orders.index.price') }}</th>
                                            <th>{{ __('admin.orders.index.subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->getItems() as $item)
                                            <tr>
                                                <td class="text-start">{{ $item->getProduct()->getTitle() }}</td>
                                                <td>{{ $item->getQuantity() }}</td>
                                                <td>${{ number_format($item->getPrice(), 2) }}</td>
                                                <td>${{ number_format($item->getPrice() * $item->getQuantity(), 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection