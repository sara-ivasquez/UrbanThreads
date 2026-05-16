<?php

/**
 * Franchesca Garcia
 */

namespace App\Services;

use App\Interfaces\OrderReportInterface;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvOrderReport implements OrderReportInterface
{
    public function generateReport(Request $request): Response
    {
        $orders = Order::getAllOrdersWithDetails();

        $callback = function () use ($orders) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Order ID',
                'Customer',
                'Address',
                'Date',
                'Total',
                'State',
            ]);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->getId(),
                    $order->getUser()->getName(),
                    $order->getUser()->getAddress(),
                    $order->getCreatedAt(),
                    $order->getTotalPrice(),
                    $order->getState(),
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="orders.csv"',
        ]);
    }
}
