<?php namespace Barryvdh\Omnipay;

use Illuminate\Contracts\Foundation\Application;
use Omnipay\Common\GatewayFactory;
use Omnipay\Common\GatewayInterface;

class GatewayManager
{

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The registered gateways
     */
    protected $gateways;

    /**
     * The default settings, applied to every gateway
     */
    protected $defaults;

    /**
     * Create a new Gateway manager instance.
     *
     * @param Application $app
     * @param GatewayFactory $factory
     * @param array
     */
    public function __construct($app, GatewayFactory $factory, $defaults = array())
    {
        $this->app = $app;
        $this->factory = $factory;
        $this->defaults = $defaults;
    }

    /**
     * Set the default gateway name.
     *
     * @param string $name
     * @return void
     */
    public function setDefaultGateway($name)
    {
        $this->app['config']['omnipay.gateway'] = $name;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array(array($this->gateway(), $method), $parameters);
    }

    /**
     * Get a gateway
     *
     * @param string  The gateway to retrieve (null=default)
     * @return GatewayInterface
     */
    public function gateway($class = null)
    {
        $class = $class ?: $this->getDefaultGateway();

        if (!isset($this->gateways[$class])) {
            $gateway = $this->factory->create($class, null, $this->app['request']);
            $gateway->initialize($this->getConfig($class));
            $this->gateways[$class] = $gateway;
        }

        return $this->gateways[$class];
    }

    /**
     * Get the default gateway name.
     *
     * @return string
     */
    public function getDefaultGateway()
    {
        return $this->app['config']['omnipay.gateway'];
    }

    /**
     * Get the configuration, based on the config and the defaults.
     */
    protected function getConfig($name)
    {
        return array_merge(
            $this->defaults,
            $this->app['config']->get('omnipay.gateways.' . $name, array())
        );
    }
}
