<?php

/**
 * Franchesca Garcia
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        $reviews = Review::getProductReviewsReport();

        $viewData = [];
        $viewData['title'] = __('admin.reviews.index.title');
        $viewData['subtitle'] = __('admin.reviews.index.subtitle');
        $viewData['reviews'] = $reviews;

        return view('admin.review.index')->with('viewData', $viewData);
    }
}
