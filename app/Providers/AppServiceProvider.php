<?php

/**
 * franchezca garcia
 */

namespace App\Providers;

use App\Interfaces\OrderReportInterface;
use App\Services\CsvOrderReport;
use App\Services\PdfOrderReport;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrderReportInterface::class, function () {
            $type = request()->route('type', 'csv');

            return match ($type) {
                'pdf' => new PdfOrderReport,
                default => new CsvOrderReport,
            };
        });
    }

    public function boot(): void
    {
        //
    }
}
