<?php


namespace App\Services\Shipping\Providers;


abstract class ShippingProvider
{

    public abstract function calculatePrice(float $weight): float;

    public static abstract function getCompanyName(): string;

    public static abstract function getSlug(): string;
}
