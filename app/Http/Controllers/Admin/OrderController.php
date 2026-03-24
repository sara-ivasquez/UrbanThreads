<?php

/**
 * Sara Vasquez
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.orders.index.title');
        $viewData['subtitle'] = __('admin.orders.index.subtitle');
        $viewData['orders'] = Order::getAllOrdersWithDetails();

        return view('admin.order.index')->with('viewData', $viewData);
    }
}
