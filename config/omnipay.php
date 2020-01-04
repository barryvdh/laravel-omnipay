<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Gateway
    |--------------------------------------------------------------------------
    |
    | Here you can specify the gateway that the facade should use by default.
    |
    */
    'gateway' => env('OMNIPAY_GATEWAY', 'PayPal_Express'),

    /*
    |--------------------------------------------------------------------------
    | Default settings
    |--------------------------------------------------------------------------
    |
    | Here you can specify default settings for gateways.
    |
    */
    'defaults' => [
        'testMode' => env('OMNIPAY_TESTMODE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Gateway specific settings
    |--------------------------------------------------------------------------
    |
    | Here you can specify gateway specific settings.
    |
    */
    'gateways' => [
        'PayPal_Express' => [
            'username' => env('OMNIPAY_PAYPAL_USERNAME'),
            'landingPage' => ['billing', 'login'],
        ],
    ],

];
