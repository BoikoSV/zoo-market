<?php


namespace App\Services\Shipping\Providers;


class TransCompany extends ShippingProvider
{
    public function calculatePrice(float $weight): float
    {
        $price = $weight <= 10 ? 20 : 100;

        return  $price * $weight;
    }

    public static function getCompanyName(): string
    {
        return 'Trans company';
    }

    public static function getSlug(): string
    {
        return 'trans-company';
    }
}
