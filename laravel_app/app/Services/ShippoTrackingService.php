<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShippoTrackingService
{
    public function track($trackingNumber)
    {
        // 1. Check the tracking number input
        // 2. IF $trackingNumber starts with "SHIPPO_" (case insensitive)
        if (str_starts_with(strtoupper($trackingNumber), 'SHIPPO_')) {
            $carrier = 'shippo';
        } else {
            // 3. ELSE: Set $carrier = 'usps';
            $carrier = 'usps';
        }

        // 4. Make the API request
        $response = Http::withHeaders([
            'Authorization' => 'ShippoToken ' . config('services.shippo.key'),
        ])->get("https://api.goshippo.com/tracks/{$carrier}/{$trackingNumber}");

        // 5. Return the JSON response
        return $response->json();
    }
}
