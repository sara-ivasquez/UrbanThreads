<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ __('admin.orders.report.title') }} - {{ __('admin.orders.report.subtitle') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        h1 { text-align: center; color: #333; margin-bottom: 5px; }
        p.subtitle { text-align: center; color: #666; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #333; color: white; padding: 8px; text-align: left; }
        td { padding: 6px 8px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .total { font-weight: bold; color: #333; }
        .footer { margin-top: 30px; text-align: center; color: #999; font-size: 10px; }
    </style>
</head>
<body>
    <h1>{{ __('admin.orders.report.title') }}</h1>
    <p class="subtitle">{{ __('admin.orders.report.subtitle') }} — {{ now()->format('Y-m-d') }}</p>

    <table>
        <thead>
            <tr>
                <th>{{ __('admin.orders.report.order_id') }}</th>
                <th>{{ __('admin.orders.report.customer') }}</th>
                <th>{{ __('admin.orders.report.address') }}</th>
                <th>{{ __('admin.orders.report.date') }}</th>
                <th>{{ __('admin.orders.report.total') }}</th>
                <th>{{ __('admin.orders.report.state') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->getId() }}</td>
                    <td>{{ $order->getUser()->getName() }}</td>
                    <td>{{ $order->getUser()->getAddress() }}</td>
                    <td>{{ $order->getCreatedAt() }}</td>
                    <td class="total">${{ number_format($order->getTotalPrice(), 2) }}</td>
                    <td>{{ $order->getState() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        {{ __('admin.orders.report.footer') }}
    </div>
</body>
</html>