<?php

/**
 * Franchesca Garcia
 */

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function save(ReviewRequest $request): RedirectResponse
    {
        $data = $request->validated();

        /** @var User $user */
        $user = auth()->user();

        $review = new Review;
        $review->setQualification($data['qualification']);
        $review->setDescription($data['description']);
        $review->setProductId($data['product_id']);
        $review->setUserId($user->getId());
        $review->save();

        return redirect()
            ->route('product.show', ['id' => $review->getProductId()])
            ->with('success', __('messages.success.review_created'));
    }
}
