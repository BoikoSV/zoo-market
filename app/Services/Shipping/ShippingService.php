<?php


namespace App\Services\Shipping;


use App\Services\Shipping\Providers\ShippingProvider;
use Illuminate\Support\Collection;

class ShippingService
{
    private array $providers = [];

    public function __construct()
    {
        $this->providers = config('shipping.providers');

    }

    public function getProvidersList(): Collection
    {
        $providersList = [];

        foreach ($this->providers as $provider) {

            $companyName = call_user_func([$provider, 'getCompanyName']);
            $serviceSlug = call_user_func([$provider, 'getSlug']);
            $providersList[] = [
                'title' => $companyName,
                'slug' => $serviceSlug
            ];

        }

        return collect($providersList);
    }

    public function calculateDeliveryPrice(float $weight, ShippingProvider $provider): string
    {
        return $provider->calculatePrice($weight);
    }
}
