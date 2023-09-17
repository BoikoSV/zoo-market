<?php


namespace App\Services\Shipping\Providers;


class PackGroup extends ShippingProvider
{
    public function calculatePrice(float $weight): float
    {
        return  $weight * 1;
    }

    public static function getCompanyName(): string
    {
        return 'Pack group';
    }

    public static function getSlug(): string
    {
        return 'pack-group';
    }
}
