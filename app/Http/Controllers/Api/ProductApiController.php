<?php

/**
 * Sara Vasquez
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::getActiveInStock();

        $data = $products->map(function (Product $product) {
            return [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'price' => $product->getPrice(),
                'stock' => $product->getStock(),
                'category' => $product->getCategory()->getName(),
                'image' => $product->getImage(),
                'links' => [
                    'view' => route('product.show', ['id' => $product->getId()]),
                ],
            ];
        });

        return response()->json([
            'data' => $data,
            'additionalData' => [
                'storeName' => 'Urban Threads',
                'storeProductsLink' => route('product.index'),
            ],
        ]);
    }
}
