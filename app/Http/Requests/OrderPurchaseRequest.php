<?php

namespace App\Http\Requests;

// Made by: Franchesca Garcia

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class OrderPurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $productId = (int) $this->input('product_id');
            $quantity = (int) $this->input('quantity');

            $product = Product::find($productId);

            if ($product === null) {
                return;
            }

            if ($product->getState() !== 'active') {
                $validator->errors()->add('product_id', __('app.order.purchase.product_inactive'));
            }

            if ($product->getStock() < $quantity) {
                $validator->errors()->add('quantity', __('app.order.purchase.insufficient_stock'));
            }
        });
    }
}
