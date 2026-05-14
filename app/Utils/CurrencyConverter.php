<?php

/**
 * Franchesca Garcia
 */

namespace App\Utils;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyConverter
{
    private const API_URL = 'https://open.er-api.com/v6/latest/COP';

    public static function convert(int $priceInCOP): array
    {
        try {
            $response = Http::timeout(10)->get(self::API_URL);

            if ($response->successful()) {
                $rates = $response->json()['rates'];

                return [
                    'USD' => round($priceInCOP * $rates['USD'], 2),
                    'EUR' => round($priceInCOP * $rates['EUR'], 2),
                ];
            }

            return ['USD' => null, 'EUR' => null];

        } catch (Exception $e) {
            Log::error('Error fetching exchange rates: '.$e->getMessage());

            return ['USD' => null, 'EUR' => null];
        }
    }
}
