<?php

namespace App\Http\Controllers;

use App\Services\Shipping\Providers\ShippingProvider;
use App\Services\Shipping\ShippingService;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index(ShippingService $service): JsonResponse
    {
        $providers = $service->getProvidersList();
        return response()->json(['data' => [
            'providers' => $providers,
            'currency' => config('shipping.currency')
        ]]);
    }

    public function getPrice(ShippingProvider $company, Request $request, ShippingService $service): JsonResponse
    {
        $data = $request->validate([
            'weight' => 'required|integer|min:1|max:1000'
        ]);

        $price = $service->calculateDeliveryPrice($data['weight'], $company);

        return response()->json(['data' => [
            'price' => $price,
            'currency' => config('shipping.currency')
        ]]);
    }
}
