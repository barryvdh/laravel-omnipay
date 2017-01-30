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
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/omnipay.php';
        $this->publishes([$configPath => config_path('omnipay.php')]);
        
        $this->app->singleton('omnipay',function ($app){
            $defaults = $app['config']->get('omnipay.defaults', array());
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
        return array('omnipay');
    }
}
