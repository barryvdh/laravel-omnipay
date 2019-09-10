<?php

namespace DansMaCulotte\Omnipay;

use Illuminate\Support\ServiceProvider;
use Omnipay\Common\GatewayFactory;
use Omnipay\Omnipay;

class OmnipayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/omnipay.php', 'omnipay');

        $this->publishes([
            __DIR__.'/../config/omnipay.php' => config_path('omnipay.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton(Omnipay::class, function ($app) {
            $defaults = config('omnipay.defaults', []);
            return new OmnipayGatewayManager($app, new GatewayFactory, $defaults);
        });

        $this->app->alias(Omnipay::class, 'omnipay');
    }
}
