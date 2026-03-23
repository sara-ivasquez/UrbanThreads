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

        <!-- Form Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <!-- Form -->
                <form method="POST" action="{{ route('admin.category.update', ['id' => $viewData['category']->getId()]) }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            {{ __('app.categories.fields.name') }}
                        </label>
                        <input type="text" name="name" class="form-control form-control-lg"
                            value="{{ $viewData['category']->getName() }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            {{ __('app.categories.fields.description') }}
                        </label>
                        <textarea name="description" class="form-control form-control-lg" rows="4" required>{{ $viewData['category']->getDescription() }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-arrow-repeat me-1"></i>
                            {{ __('app.categories.actions.update') }}
                        </button>

                        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i>
                            {{ __('app.categories.actions.cancel') }}
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection