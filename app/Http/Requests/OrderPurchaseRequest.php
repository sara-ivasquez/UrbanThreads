<?php
 
/**
 * Franchesca Garcia
 */
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
 
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
}