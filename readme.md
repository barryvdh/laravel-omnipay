## Omnipay for Laravel 5

### For Laravel 4, use the [0.1 version](https://github.com/barryvdh/laravel-omnipay/tree/v0.1.0).

This is a package to integrate [Omnipay](https://github.com/omnipay/omnipay) with Laravel.
You can use it to easily manage your configuration, and use the Facade to provide shortcuts to your gateway.

## Installation

Require this package in your composer.json and run composer update (or run `composer require barryvdh/laravel-omnipay:0.2.x` directly):

    "barryvdh/laravel-omnipay": "0.2.*@dev"

After updating composer, add the ServiceProvider to the providers array in config/app.php

    'Barryvdh\Omnipay\ServiceProvider',

You need to publish the config for this package. A sample configuration is provided. The defaults will be merged with gateway specific configuration.

    $ php artisan vendor:publish

To use the Facade (`Omnipay::purchase()` instead of `App::make(`omnipay`)->purchase()`), add that to the facades array.

     'Omnipay' => 'Barryvdh\Omnipay\Facade',

When calling the Omnipay facade/instance, it will create the default gateway, based on the configuration.
You can change the default gateway by calling `Omnipay::setDefaultGateway('My\Gateway')`.
You can get a different gateway by calling `Omnipay::gateway('My\Cass')`

## Examples

    $params = [
        'amount' => $order->amount,
        'issuer' => $issuerId,
        'description' => $order->description,
        'returnUrl' => URL::action('PurchaseController@return', [$order->id]),
    ];
    $response = Omnipay::purchase($params)->send();

    if ($response->isSuccessful()) {
        // payment was successful: update database
        print_r($response);
    } elseif ($response->isRedirect()) {
        // redirect to offsite payment gateway
        return $response->getRedirectResponse();
    } else {
        // payment failed: display message to customer
        echo $response->getMessage();
    }

Besides the gateway calls, there is also a shortcut for the creditcard:

    $formInputData = array(
        'firstName' => 'Bobby',
        'lastName' => 'Tables',
        'number' => '4111111111111111',
    );
    $card = Omnipay::creditCard($formInputData);
