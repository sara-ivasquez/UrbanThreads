@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <h1>{{ $viewData['title'] }}</h1>
        <h5 class="text-muted mb-4">{{ $viewData['subtitle'] }}</h5>

        <div class="card">
            <div class="card-body">
                <h3>{{ $viewData['category']->getName() }}</h3>
                <p class="text-muted">{{ $viewData['category']->getDescription() }}</p>

                <a href="{{ route('admin.category.edit', ['id' => $viewData['category']->getId()]) }}"
                    class="btn btn-warning">
                    Editar
                </a>

                <a href="{{ route('admin.category.delete', ['id' => $viewData['category']->getId()]) }}"
                    class="btn btn-danger">
                    Eliminar
                </a>

                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
    </div>
@endsection