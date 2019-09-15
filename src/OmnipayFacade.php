<?php

namespace DansMaCulotte\Omnipay;

use Illuminate\Support\Facades\Facade;

/**
 * @method static OmnipayFacade setDefaultGateway(string $string)
 * @method static OmnipayFacade withGateway(string $string)
 * @method static \Omnipay\Common\Message\AbstractRequest authorize(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest completeAuthorize(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest capture(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest purchase(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest completePurchase(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest refund(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest void(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest createCard(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest updateCard(array $parameters)
 * @method static \Omnipay\Common\Message\AbstractRequest deleteCard(array $parameters)
 *
 * @see OmnipayGatewayManager
 */
class OmnipayFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'omnipay';
    }
}
