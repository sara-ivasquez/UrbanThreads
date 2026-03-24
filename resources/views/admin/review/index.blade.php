@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h1>{{ $viewData['title'] }}</h1>
                <h5 class="text-muted">{{ $viewData['subtitle'] }}</h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-star me-2"></i>{{ $viewData['title'] }}
                </h5>
            </div>
            <div class="card-body">
                @if ($viewData['reviews']->isEmpty())
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ __('admin.reviews.index.no_reviews') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ __('admin.reviews.index.product') }}</th>
                                    <th>{{ __('admin.reviews.index.total') }}</th>
                                    <th>{{ __('admin.reviews.index.average') }}</th>
                                    <th>{{ __('admin.reviews.index.min') }}</th>
                                    <th>{{ __('admin.reviews.index.max') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData['reviews'] as $review)
                                    <tr>
                                        <td class="text-start">{{ $review->title }}</td>
                                        <td>{{ $review->reviews_count }}</td>
                                        <td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= round($review->reviews_avg_qualification))
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                @else
                                                    <i class="bi bi-star text-secondary"></i>
                                                @endif
                                            @endfor
                                            ({{ number_format($review->reviews_avg_qualification, 1) }})
                                        </td>
                                        <td>{{ $review->reviews_min_qualification }}</td>
                                        <td>{{ $review->reviews_max_qualification }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection