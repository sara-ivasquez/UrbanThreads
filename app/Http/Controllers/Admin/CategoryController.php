<?php

/**
 * Jacobo Montes
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        $viewData = [
            'title' => __('app.categories.index.title'),
            'subtitle' => __('app.categories.index.subtitle'),
            'categories' => $categories,
        ];

        return view('admin.category.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [
            'title' => __('app.categories.create.title'),
            'subtitle' => __('app.categories.create.subtitle'),
        ];

        return view('admin.category.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'state' => 'active',
        ]);

        return redirect()->route('admin.category.index');
    }

    public function edit(int $id): View
    {
        $category = Category::findOrFail($id);

        $viewData = [
            'title' => __('app.categories.edit.title'),
            'subtitle' => __('app.categories.edit.subtitle'),
            'category' => $category,
        ];

        return view('admin.category.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only(['name', 'description']));

        return redirect()->route('admin.category.index');
    }

    public function disable(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->setState('disabled');
        $category->save();

        return redirect()->route('admin.category.index');
    }

    public function enable(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->setState('active');
        $category->save();

        return redirect()->route('admin.category.index');
    }
}