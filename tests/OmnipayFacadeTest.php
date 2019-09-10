<?php

namespace DansMaCulotte\Omnipay\Tests;

use DansMaCulotte\Omnipay\OmnipayFacade;
use DansMaCulotte\Omnipay\OmnipayGatewayManager;
use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;

class OmnipayFacadeTest extends TestCase
{
    /** @test */
    public function should_instantiate_facade()
    {
        $omnipay = $this->app[Omnipay::class];
        $this->assertInstanceOf(OmnipayGatewayManager::class, $omnipay);
    }

    /** @test */
    public function should_purchase_with_dummy_gateway()
    {
        $card = new CreditCard([
            'firstName' => 'John',
            'lastName' => 'Snow',
            'number' => '4242424242424242',
            'expiryMonth' => '01',
            'expiryYear' => '2020',
            'cvv' => '123',
        ]);

        $transaction = OmnipayFacade::withGateway('Dummy')
            ->purchase([
                'amount' => '10',
                'currency' => 'EUR',
                'card' => $card,
            ]);
        $response = $transaction->send();

        $this->assertTrue($response->isSuccessful());
    }

    /** @test */
    public function should_purchase_successfully_with_dummy_gateway()
    {
        OmnipayFacade::setDefaultGateway('Dummy');

        $card = new CreditCard([
            'firstName' => 'John',
            'lastName' => 'Snow',
            'number' => '4242424242424242',
            'expiryMonth' => '01',
            'expiryYear' => '2020',
            'cvv' => '123',
        ]);

        $transaction = OmnipayFacade::purchase([
            'amount' => '10',
            'currency' => 'EUR',
            'card' => $card,
        ]);
        $response = $transaction->send();

        $this->assertTrue($response->isSuccessful());
    }

    /** @test */
    public function should_fail_purchase_with_dummy_gateway()
    {
        OmnipayFacade::setDefaultGateway('Dummy');

        $card = new CreditCard([
            'firstName' => 'John',
            'lastName' => 'Snow',
            'number' => '4111111111111111',
            'expiryMonth' => '01',
            'expiryYear' => '2020',
            'cvv' => '123',
        ]);

        $transaction = OmnipayFacade::purchase([
            'amount' => '10',
            'currency' => 'EUR',
            'card' => $card,
        ]);
        $response = $transaction->send();

        $this->assertFalse($response->isSuccessful());
    }
}
