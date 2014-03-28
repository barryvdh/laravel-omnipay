<?php namespace Barryvdh\Omnipay;

use Omnipay\Common\GatewayFactory;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['config']->package('barryvdh/laravel-omnipay', $this->guessPackagePath() . '/config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['omnipay.manager'] = $this->app->share(function ($app){
            $defaults = $app['config']->get('laravel-omnipay::defaults', array());
            return new GatewayManager($app, new GatewayFactory, $defaults);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('omnipay.manager');
    }
}
