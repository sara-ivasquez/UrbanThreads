@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <h1 class="my-4">{{ $viewData['title'] }}</h1>

        <!-- Form to Edit a Product -->
        <div class="card">
            <div class="card-header">
                <h5>{{ $viewData['title'] }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.product.update', ['id' => $viewData['product']->getId()]) }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('admin.products.edit.form.title') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" name="title"
                            value="{{ old('title', $viewData['product']->getTitle()) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('admin.products.edit.form.description') }}</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" rows="3" required>{{ old('description', $viewData['product']->getDescription()) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">{{ __('admin.products.edit.form.category_id') }}</label>
                        <select class="form-control @error('category_id') is-invalid @enderror"
                            id="category_id" name="category_id" required>
                            <option value="">{{ __('admin.products.edit.form.select_category') }}</option>
                            @foreach($viewData['categories'] as $category)
                                <option value="{{ $category->getId() }}"
                                    {{ old('category_id', $viewData['product']->getCategoryId()) == $category->getId() ? 'selected' : '' }}>
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
                        <label for="image" class="form-label">{{ __('admin.products.edit.form.image') }}</label>
                    @if ($viewData['product']->getImage())
                      <div class="mb-2">
                         <img src="{{ asset('storage/' . $viewData['product']->getImage()) }}"
                            class="img-thumbnail" style="height: 100px;">
                      </div>
                    @endif
                      <input type="file" class="form-control @error('image') is-invalid @enderror"
                         id="image" name="image">
                    @error('image')
                       <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">{{ __('admin.products.edit.form.price') }}</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                            id="price" name="price" min="0"
                            value="{{ old('price', $viewData['product']->getPrice()) }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">{{ __('admin.products.edit.form.stock') }}</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror"
                            id="stock" name="stock" min="0"
                            value="{{ old('stock', $viewData['product']->getStock()) }}" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- State -->
                    <div class="mb-3">
                        <label for="state" class="form-label">{{ __('admin.products.edit.form.state') }}</label>
                        <select class="form-control @error('state') is-invalid @enderror"
                            id="state" name="state">
                            <option value="active"
                                {{ old('state', $viewData['product']->getState()) == 'active' ? 'selected' : '' }}>
                                {{ __('admin.products.edit.form.state_active') }}
                            </option>
                            <option value="inactive"
                                {{ old('state', $viewData['product']->getState()) == 'inactive' ? 'selected' : '' }}>
                                {{ __('admin.products.edit.form.state_inactive') }}
                            </option>
                        </select>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.product.show', ['id' => $viewData['product']->getId()]) }}"
                            class="btn btn-secondary me-md-2">
                            {{ __('admin.products.edit.form.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            {{ __('admin.products.edit.form.submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection