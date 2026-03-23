@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
    @forelse ($viewData['orders'] as $order)
        <div class="card mb-4">
            <div class="card-header">
                {{ __('app.user.orders.order_number') }} #{{ $order->getId() }}
            </div>
            <div class="card-body">
                <b>{{ __('app.user.orders.date') }}:</b> {{ $order->getCreatedAt() }}<br />
                <b>{{ __('app.user.orders.total') }}:</b> ${{ $order->getTotalPrice() }}<br />

                <table class="table table-bordered table-striped text-center mt-3">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('app.user.orders.item_id') }}</th>
                            <th scope="col">{{ __('app.user.orders.product_name') }}</th>
                            <th scope="col">{{ __('app.user.orders.price') }}</th>
                            <th scope="col">{{ __('app.user.orders.quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->getItems() as $item)
                            <tr>
                                <td>{{ $item->getId() }}</td>
                                <td>
                                    <a class="link-success" href="{{ route('product.show', ['id' => $item->getProduct()->getId()]) }}">
                                        {{ $item->getProduct()->getTitle() }}
                                    </a>
                                </td>
                                <td>${{ $item->getPrice() }}</td>
                                <td>{{ $item->getQuantity() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-danger" role="alert">
            {{ __('app.user.orders.no_orders') }}
        </div>
    @endforelse
@endsection