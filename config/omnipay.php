<?php

return [

    /**
     * The default gateway name
     */
    'default' => env('OMNIPAY_GATEWAY'),

    /**
     * The default settings, applied to all gateways
     */
    'defaults' => [
        'testMode' => env('OMNIPAY_TEST_MODE', false),
    ],

    /**
     * Gateway specific parameters
     */
    'gateways' => [
//        'PayPal_Express' => [
//            'username' => env('PAYPAL_USERNAME'),
//            'password' => env('PAYPAL_PASSWORD'),
//            'signature' => env('PAYPAL_SIGNATURE'),
//        ],
    ],

];
