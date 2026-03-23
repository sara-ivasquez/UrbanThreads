@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">

        <!-- Header -->
        <div class="p-4 mb-4 bg-dark text-white rounded-3">
            <div>
                <h1 class="fw-bold mb-1">{{ $viewData['title'] }}</h1>
                <p class="mb-0 text-light">{{ $viewData['subtitle'] }}</p>
            </div>
        </div>

        <!-- Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">

                <!-- Icon -->
                <i class="bi bi-tag fs-1 text-primary mb-3"></i>

                <!-- Info -->
                <h3 class="fw-bold">{{ $viewData['category']->getName() }}</h3>
                <p class="text-muted mb-4">
                    {{ $viewData['category']->getDescription() }}
                </p>

                <!-- Actions -->
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('admin.category.edit', ['id' => $viewData['category']->getId()]) }}"
                        class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>
                        {{ __('app.categories.actions.edit') }}
                    </a>

                    <a href="{{ route('admin.category.delete', ['id' => $viewData['category']->getId()]) }}"
                        class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        {{ __('app.categories.actions.delete') }}
                    </a>

                    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        {{ __('app.categories.actions.back') }}
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection