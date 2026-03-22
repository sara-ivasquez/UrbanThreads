@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <h1>{{ $viewData['title'] }}</h1>
        <h5 class="text-muted mb-4">{{ $viewData['subtitle'] }}</h5>

        <form method="POST" action="{{ route('admin.category.update', ['id' => $viewData['category']->getId()]) }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control"
                    value="{{ $viewData['category']->getName() }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="description" class="form-control" rows="3" required>{{ $viewData['category']->getDescription() }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection