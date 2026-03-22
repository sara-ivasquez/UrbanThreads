{{-- Sara Vasquez --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h1 class="fs-5 mb-0">{{ $viewData['title'] }}</h1>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>{{ __('app.user.show.name') }}</th>
                                    <td>{{ $viewData['user']->getName() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.user.show.email') }}</th>
                                    <td>{{ $viewData['user']->getEmail() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.user.show.address') }}</th>
                                    <td>{{ $viewData['user']->getAddress() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.user.show.budget') }}</th>
                                    <td>${{ number_format($viewData['user']->getBudget(), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ route('user.orders') }}" class="btn btn-primary">
                    <i class="bi bi-box-seam me-2"></i>{{ __('app.user.show.view_orders') }}
                </a>
            </div>
        </div>
    </div>
@endsection