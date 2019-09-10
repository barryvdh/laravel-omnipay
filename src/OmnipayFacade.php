<?php

namespace DansMaCulotte\Omnipay;

use Illuminate\Support\Facades\Facade;

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
