<?php

/**
 * Franchesca Garcia
 */

namespace App\Interfaces;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

interface OrderReportInterface
{
    public function generateReport(Request $request): Response;
}
