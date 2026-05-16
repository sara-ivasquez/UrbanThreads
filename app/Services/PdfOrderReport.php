<?php

/**
 * Franchesca Garcia
 */

namespace App\Services;

use App\Interfaces\OrderReportInterface;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PdfOrderReport implements OrderReportInterface
{
    public function generateReport(Request $request): Response
    {
        $orders = Order::getAllOrdersWithDetails();

        $pdf = Pdf::loadView('admin.order.report', [
            'orders' => $orders,
        ]);

        return new Response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="orders.pdf"',
        ]);
    }
}
