<?php

/**
 * Franchesca Garcia
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CsvOrderReport;
use App\Services\PdfOrderReport;
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

    public function downloadCsv(Request $request, CsvOrderReport $report): Response
    {
        return $report->generateReport($request);
    }

    public function downloadPdf(Request $request, PdfOrderReport $report): Response
    {
        return $report->generateReport($request);
    }
}
