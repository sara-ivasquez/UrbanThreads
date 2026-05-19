<?php

/**
 * Jacobo Montes
 */

namespace App\Utils;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VenekaBeautyService
{
    private const API_URL = 'http://34.68.27.58/api/products';

    public static function getProducts(): array
    {
        try {
            $response = Http::timeout(10)->get(self::API_URL);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['success']) && $data['success'] === true) {
                    return $data['data'];
                }
            }

            return [];

        } catch (Exception $e) {
            Log::error('Error fetching VeneKa Beauty products: '.$e->getMessage());

            return [];
        }
    }
}
