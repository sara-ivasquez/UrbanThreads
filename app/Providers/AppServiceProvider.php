<?php

/**
 * Franchesca Garcia
 */

namespace App\Providers;

use App\Interfaces\OrderReportInterface;
use App\Services\CsvOrderReport;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrderReportInterface::class, CsvOrderReport::class);
    }

    public function boot(): void
    {
        //
    }
}
