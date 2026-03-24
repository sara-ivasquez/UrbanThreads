<?php

/**
 * Sara Vasquez
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => __('admin.products.list.title'),
            'subtitle' => __('admin.products.list.subtitle'),
            'products' => Product::all(),
        ];

        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [
            'title' => __('admin.products.create.title'),
            'categories' => Category::all(),
        ];

        return view('admin.product.create')->with('viewData', $viewData);
    }

    public function save(ProductRequest $request): RedirectResponse
    {
        $product = new Product;
        $product->setTitle($request->validated()['title']);
        $product->setDescription($request->validated()['description']);
        $product->setPrice($request->validated()['price']);
        $product->setStock($request->validated()['stock']);
        $product->setCategoryId($request->validated()['category_id']);
        $product->setImage('default.png');
        $product->save();

        if ($request->hasFile('image')) {
            $imageName = $product->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
            $product->save();
        }

        return redirect()->route('admin.product.index')
            ->with('success', __('messages.success.product_created'));
    }

    public function show(int $id): View
    {
        $product = Product::findOrFail($id);
        $viewData = [
            'title' => $product->getTitle().' - '.__('admin.products.show.title_suffix'),
            'product' => $product,
        ];

        return view('admin.product.show')->with('viewData', $viewData);
    }

    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);
        $viewData = [
            'title' => __('admin.products.edit.title'),
            'product' => $product,
            'categories' => Category::all(),
        ];

        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(ProductRequest $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->setTitle($request->validated()['title']);
        $product->setDescription($request->validated()['description']);
        $product->setPrice($request->validated()['price']);
        $product->setStock($request->validated()['stock']);
        $product->setCategoryId($request->validated()['category_id']);
        $product->setState($request->validated()['state']);
        $product->save();

        if ($request->hasFile('image')) {
            $imageName = $product->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
            $product->save();
        }

        return redirect()->route('admin.product.show', ['id' => $product->getId()])
            ->with('success', __('messages.success.product_updated'));
    }

    public function disable(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->setState('inactive');
        $product->save();

        return redirect()->route('admin.product.show', ['id' => $product->getId()])
            ->with('success', __('messages.success.product_disabled'));
    }

    public function enable(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->setState('active');
        $product->save();

        return redirect()->route('admin.product.show', ['id' => $product->getId()])
            ->with('success', __('messages.success.product_enabled'));
    }
}
