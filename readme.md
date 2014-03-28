## Omnipay for Laravel 4

This is a package to integrate [Omnipay](https://github.com/omnipay/omnipay) with Laravel.
You can use it to easily manage your configuration, and use the Facade to provide shortcuts to your gateway.

## Installation

Require this package in your composer.json and run composer update (or run `composer require barryvdh/laravel-omnipay:0.1.x` directly):

    "barryvdh/laravel-omnipay": "0.1.*"

After updating composer, add the ServiceProvider to the providers array in app/config/app.php

    'Barryvdh\Omnipay\ServiceProvider',

You need to publish the config for this package

    $ php artisan config:publish barryvdh/laravel-omnipay

To use the Facade (`Omnipay::purchase()` instead of `App::make(`omnipay`)->purchase()`), add that to the facades array.

     'Omnipay' => 'Barryvdh\Omnipay\Facade',

When calling the Omnipay facade/instance, it will create the default gateway, based on the configuration.
You can change the default gateway by calling `Omnipay::setDefaultGateway('My\Gateway')`.
You can get a different gateway by calling `Omnipay::gateway('My\Cass')`
