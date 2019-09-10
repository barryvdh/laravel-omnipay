<?php

namespace DansMaCulotte\Omnipay;

use Omnipay\Common\GatewayFactory;

class OmnipayGatewayManager
{

    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var GatewayFactory
     */
    protected $factory;

    /**
     * The default settings, applied to every gateway
     */
    protected $defaults;

    /**
     * The registered gateways
     */
    protected $gateways;

    /**
     * The default gateway override
     */
    protected $gateway;

    /**
     * Create a new Gateway manager instance.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @param  \Omnipay\Common\GatewayFactory $factory
     * @param  array
     */
    public function __construct($app, GatewayFactory $factory, $defaults = [])
    {
        $this->app = $app;
        $this->factory = $factory;
        $this->defaults = $defaults;
        $this->gateway = null;
    }

    /**
     * Get a gateway
     *
     * @return \Omnipay\Common\GatewayInterface
     */
    public function makeGateway()
    {
        $class = $this->gateway ?: $this->getDefaultGateway();

        if (!isset($this->gateways[$class])) {
            $gateway = $this->factory->create($class, null, $this->app['request']);
            $gateway->initialize($this->getConfig($class));
            $this->gateways[$class] = $gateway;
        }

        return $this->gateways[$class];
    }

    /**
     * Get the configuration, based on the config and the defaults.
     * @param string $name
     * @return array
     */
    protected function getConfig(string $name)
    {
        return array_merge(
            $this->defaults,
            $this->app['config']->get('omnipay.gateways.'.$name, [])
        );
    }

    /**
     * Get the default gateway name.
     *
     * @return string
     */
    public function getDefaultGateway()
    {
        return $this->app['config']['omnipay.default'];
    }

    /**
     * Set the default gateway name.
     *
     * @param string $name
     * @return void
     */
    public function setDefaultGateway(string $name)
    {
        $this->app['config']['omnipay.default'] = $name;
    }

    /**
     * @param string $name
     * @return OmnipayGatewayManager
     */
    public function withGateway(string $name)
    {
        $this->gateway = $name;

        return $this;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->makeGateway(), $method], $parameters);
    }
}
