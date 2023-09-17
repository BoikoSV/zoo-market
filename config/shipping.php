<?php

return [
    'providers' => [

        \App\Services\Shipping\Providers\TransCompany::class,
        \App\Services\Shipping\Providers\PackGroup::class,

    ],

    'currency' => 'eur'
];
