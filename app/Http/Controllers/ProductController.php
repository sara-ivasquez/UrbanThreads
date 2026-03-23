<?php

/**
 * Sara Vasquez
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $categoryId = $request->query('category');
        $searchQuery = $request->query('search');
        $productsQuery = Product::where('state', 'active');

        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }
        if ($searchQuery) {
            $productsQuery->where('title', 'like', '%'.$searchQuery.'%');
        }

        $products = $productsQuery->get();
        $categories = Category::all();

        $viewData = [
            'title' => __('app.products.list.title'),
            'subtitle' => __('app.products.list.subtitle'),
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $categoryId,
            'searchQuery' => $searchQuery,
        ];

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $viewData = [
            'title' => $product->getTitle().' - '.__('app.products.show.title_suffix'),
            'product' => $product,
            'reviews' => $reviews,
        ];

        return view('product.show')->with('viewData', $viewData);
    }
}
