<?php namespace Barryvdh\Omnipay;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Message\AbstractRequest;

/**
 * @method static AbstractRequest purchase(array $options = [])
 * @method static AbstractRequest completePurchase(array $options = [])
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * @param  array  $parameters
     * @return CreditCard
     */
    public static function creditCard($parameters = null)
    {
        return new CreditCard($parameters);
    }

    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'omnipay';
    }
}
