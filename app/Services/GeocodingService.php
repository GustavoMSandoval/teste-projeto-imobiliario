<?php

namespace App\Services;

use Geocoder;

class GeocodingService
{
    public function geocodeAddress(array $address): ?array
    {
        // Build full address string
        $fullAddress = "{$address['rua']}, {$address['bairro']}, {$address['cidade']}, {$address['estado']}";

        $results = app('geocoder')->geocode($fullAddress)->get();

        if ($results->isEmpty()) {
            return null;
        }

        $coordinates = $results->first()->getCoordinates();

        return [
            'latitude' => $coordinates->getLatitude(),
            'longitude' => $coordinates->getLongitude(),
        ];
    }
}
