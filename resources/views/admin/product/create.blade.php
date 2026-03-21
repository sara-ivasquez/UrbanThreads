@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <h1 class="my-4">{{ $viewData['title'] }}</h1>

        <!-- Form to Create a New Product -->
        <div class="card">
            <div class="card-header">
                <h5>{{ $viewData['title'] }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.product.save') }}">
                    @csrf

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('admin.products.create.form.title') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('admin.products.create.form.description') }}</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">{{ __('admin.products.create.form.category_id') }}</label>
                        <select class="form-control @error('category_id') is-invalid @enderror"
                            id="category_id" name="category_id" required>
                            <option value="">{{ __('admin.products.create.form.select_category') }}</option>
                            @foreach($viewData['categories'] as $category)
                                <option value="{{ $category->getId() }}"
                                    {{ old('category_id') == $category->getId() ? 'selected' : '' }}>
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">{{ __('admin.products.create.form.image') }}</label>
                        <input type="text" class="form-control @error('image') is-invalid @enderror"
                            id="image" name="image" value="{{ old('image') }}">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">{{ __('admin.products.create.form.price') }}</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                            id="price" name="price" value="{{ old('price') }}" min="0" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">{{ __('admin.products.create.form.stock') }}</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror"
                            id="stock" name="stock" value="{{ old('stock') }}" min="0" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">{{ __('admin.products.create.form.submit') }}</button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary ms-2">{{ __('admin.products.create.form.cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection