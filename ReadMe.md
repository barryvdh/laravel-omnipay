# Omnipay in Laravel

[![Latest Version](https://img.shields.io/packagist/v/dansmaculotte/laravel-omnipay.svg?style=flat-square)](https://packagist.org/packages/dansmaculotte/laravel-omnipay)
[![Total Downloads](https://img.shields.io/packagist/dt/dansmaculotte/laravel-omnipay.svg?style=flat-square)](https://packagist.org/packages/dansmaculotte/laravel-omnipay)
[![Build Status](https://img.shields.io/travis/dansmaculotte/laravel-omnipay/master.svg?style=flat-square)](https://travis-ci.org/dansmaculotte/laravel-omnipay)
[![Quality Score](https://img.shields.io/scrutinizer/g/dansmaculotte/laravel-omnipay.svg?style=flat-square)](https://scrutinizer-ci.com/g/dansmaculotte/laravel-omnipay)
[![Code Coverage](https://img.shields.io/coveralls/github/dansmaculotte/laravel-omnipay.svg?style=flat-square)](https://coveralls.io/github/dansmaculotte/laravel-omnipay)

> This package allows you to work with [Omnipay](https://github.com/omnipay/omnipay) in Laravel.

## Installation

### Requirements

- PHP 7.2

You can install the package via composer:

```bash
composer require dansmaculotte/laravel-omnipay
```

The package will automatically register itself.

To publish the config file to config/omnipay.php run:

```php
php artisan vendor:publish --provider="DansMaCulotte\Omnipay\OmnipayServiceProvider"
```

## Usage

```php
$params = [
    'amount' => $order->amount,
    'issuer' => $issuerId,
    'description' => $order->description,
    'returnUrl' => URL::action('PurchaseController@return', [$order->id]),
];
$response = Omnipay::purchase($params)->send();

if ($response->isRedirect()) {
    // redirect to offsite payment gateway
    return $response->getRedirectResponse();
}

if ($response->isSuccessful() === false) {
    // payment failed: display message to customer
    echo $response->getMessage();
}

// payment was successful: update database
print_r($response);
```

You can change default gateway with :

```php
OmnipayFacade::setDefaultGateway('Stripe');
```

Or temporary change gateway :

```php
Omnipay::withGateway('Dummy')->purchase($params)->send();
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
