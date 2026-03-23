@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">

        <div class="p-4 mb-4 bg-dark text-white rounded-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold mb-1">{{ $viewData['title'] }}</h1>
                    <p class="mb-0 text-light">{{ $viewData['subtitle'] }}</p>
                </div>
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>
                    {{ __('app.categories.index.create_button') }}
                </a>
            </div>
        </div>

        
        <div class="card shadow-sm border-0">
            <div class="card-body">

                @if (count($viewData['categories']) > 0)

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ __('app.categories.fields.id') }}</th>
                                    <th>{{ __('app.categories.fields.name') }}</th>
                                    <th>{{ __('app.categories.fields.description') }}</th>
                                    <th>{{ __('app.categories.fields.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData['categories'] as $category)
                                    <tr>
                                        <td class="fw-bold">{{ $category->getId() }}</td>
                                        <td>{{ $category->getName() }}</td>
                                        <td class="text-muted">
                                            {{ Str::limit($category->getDescription(), 50) }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('admin.category.show', ['id' => $category->getId()]) }}"
                                                    class="btn btn-outline-info btn-sm">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.category.edit', ['id' => $category->getId()]) }}"
                                                    class="btn btn-outline-warning btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <a href="{{ route('admin.category.delete', ['id' => $category->getId()]) }}"
                                                    class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else

                    
                    <div class="text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                        <p class="mt-3 text-muted">
                            {{ __('app.categories.index.empty') }}
                        </p>
                    </div>

                @endif

            </div>
        </div>
    </div>
@endsection