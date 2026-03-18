<?php

/**
 * Sara Vasquez
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => __('admin.dashboard.title'),
            'subtitle' => __('admin.dashboard.subtitle'),
        ];

        return view('admin.home.index')->with('viewData', $viewData);
    }
}
