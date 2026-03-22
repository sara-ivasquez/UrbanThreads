@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>{{ $viewData['title'] }}</h1>
                <h5 class="text-muted">{{ $viewData['subtitle'] }}</h5>
            </div>
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                + Crear Categoría
            </a>
        </div>

        <!-- Categories Table -->
        <div class="card">
            <div class="card-body">
                @if (count($viewData['categories']) > 0)
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['categories'] as $category)
                                <tr>
                                    <td>{{ $category->getId() }}</td>
                                    <td>{{ $category->getName() }}</td>
                                    <td>{{ $category->getDescription() }}</td>
                                    <td>
                                        <a href="{{ route('admin.category.show', ['id' => $category->getId()]) }}"
                                            class="btn btn-info btn-sm">
                                            Ver
                                        </a>

                                        <a href="{{ route('admin.category.edit', ['id' => $category->getId()]) }}"
                                            class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <a href="{{ route('admin.category.delete', ['id' => $category->getId()]) }}"
                                            class="btn btn-danger btn-sm">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        No hay categorías registradas
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection