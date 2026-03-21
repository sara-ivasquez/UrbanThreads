@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>{{ $viewData['title'] }}</h1>
                <h5 class="text-muted">{{ $viewData['subtitle'] }}</h5>
            </div>
            <div>
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                    {{ __('admin.products.create.title') }}
                </a>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-body">
                @if(isset($viewData['products']) && count($viewData['products']) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ __('admin.products.list.image') }}</th>
                                    <th>{{ __('admin.products.list.title') }}</th>
                                    <th>{{ __('admin.products.list.price') }}</th>
                                    <th>{{ __('admin.products.list.category') }}</th>
                                    <th>{{ __('admin.products.list.stock') }}</th>
                                    <th>{{ __('admin.products.list.state') }}</th>
                                    <th class="text-end">{{ __('admin.products.list.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewData['products'] as $product)
                                    <tr>
                                        <!-- Product Image -->
                                        <td>
                                            <img src="{{ asset('img/' . $product->getImage()) }}"
                                                class="img-thumbnail" style="max-width: 80px;"
                                                alt="{{ $product->getTitle() }}">
                                        </td>

                                        <!-- Product Info -->
                                        <td>{{ $product->getTitle() }}</td>
                                        <td>${{ number_format($product->getPrice(), 2) }}</td>
                                        <td>{{ $product->getCategory()->getName() }}</td>

                                        <!-- Stock -->
                                        <td>
                                            @if($product->getStock() > 0)
                                                <span class="badge bg-success">{{ $product->getStock() }}</span>
                                            @else
                                                <span class="badge bg-danger">0</span>
                                            @endif
                                        </td>

                                        <!-- State -->
                                        <td>
                                            @if($product->getState() == 'active')
                                                <span class="badge bg-success">{{ __('admin.products.list.state_active') }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ __('admin.products.list.state_inactive') }}</span>
                                            @endif
                                        </td>

                                        <!-- Actions -->
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.product.show', ['id' => $product->getId()]) }}"
                                                    class="btn btn-sm btn-info me-1">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('admin.product.edit', ['id' => $product->getId()]) }}"
                                                    class="btn btn-sm btn-primary me-1">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                @if($product->getState() == 'active')
                                                    <a href="{{ route('admin.product.disable', ['id' => $product->getId()]) }}"
                                                        class="btn btn-sm btn-warning me-1">
                                                        <i class="bi bi-toggle-off"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.product.enable', ['id' => $product->getId()]) }}"
                                                        class="btn btn-sm btn-success me-1">
                                                        <i class="bi bi-toggle-on"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        {{ __('admin.products.list.no_products') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection