<?php

/**
 * Franchesca Garcia
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'required|string|max:1000',
            'qualification' => 'required|integer|min:1|max:5',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }

    public function messages(): array
    {
        return [
            'qualification.required' => __('messages.review.validation.qualification_required'),
            'qualification.integer' => __('messages.review.validation.qualification_integer'),
            'qualification.min' => __('messages.review.validation.qualification_min'),
            'qualification.max' => __('messages.review.validation.qualification_max'),
            'description.required' => __('messages.review.validation.description_required'),
            'description.max' => __('messages.review.validation.description_max'),
            'product_id.required' => __('messages.review.validation.product_required'),
            'product_id.exists' => __('messages.review.validation.product_exists'),
        ];
    }
}
