<?php

namespace App\Http\Controllers;

/**
 * Franchesca Garcia
 */

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function save(ReviewRequest $request): RedirectResponse
    {
        $review = new Review();
        $review->setQualification((int) $request->input('qualification'));
        $review->setDescription($request->string('description')->toString());
        $review->setProductId((int) $request->input('product_id'));
        $review->setUserId((int) auth()->id());
        $review->save();

        return redirect()->route('product.show', ['id' => $review->getProductId()])
            ->with('success', __('messages.success.review_created'));
    }
}