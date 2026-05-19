<?php

/**
 * Jacobo Montes
 */

namespace App\Http\Controllers;

use App\Utils\VenekaBeautyService;
use Illuminate\View\View;

class BeautyProductController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => __('app.beauty.title'),
            'subtitle' => __('app.beauty.subtitle'),
            'products' => VenekaBeautyService::getProducts(),
        ];

        return view('beauty.index')->with('viewData', $viewData);
    }
}
