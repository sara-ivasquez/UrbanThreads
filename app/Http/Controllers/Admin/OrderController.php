<?php

/**
 * Franchezca Garcia
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderReportInterface;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

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

    public function download(Request $request, OrderReportInterface $report): Response
    {
        return $report->generateReport($request);
    }
}
