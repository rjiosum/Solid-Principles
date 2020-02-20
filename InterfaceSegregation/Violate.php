<?php declare(strict_types=1);

namespace InterfaceSegregation\Violate;

interface PaymentInterface
{
    public function pay();
    public function fraudCheck();
    public function threeDSecureCheck();
}

class PayPal implements PaymentInterface
{
    public function pay()
    {
        return 'Paid by PayPal';
    }
    //client should be forced to depend on method it does not use
    public function fraudCheck() {}
    public function threeDSecureCheck() {}
}

class SagePay implements PaymentInterface
{
    public function pay()
    {
        return 'Paid by SagePay';
    }

    public function fraudCheck()
    {
        return 'Card is valid';
    }
    //client should be forced to depend on method it does not use
    public function threeDSecureCheck() {}
}

class WorldPay implements PaymentInterface
{
    public function pay()
    {
        return 'Paid by WorldPay';
    }

    public function fraudCheck()
    {
        return 'Card is valid';
    }

    public function threeDSecureCheck()
    {
        return '3D secured is ok.';
    }
}

class Checkout
{
    private $payment;

    public function __construct(PaymentInterface $payment)
    {
        $this->payment = $payment;
    }

    public function takePayment()
    {
        $this->payment->fraudCheck();
        $this->payment->threeDSecureCheck();
        $this->payment->pay();
    }
}

//PayPal class do not do perform fraudCheck or threeDSecure, but we are forcing those methods
$checkout = new Checkout(new PayPal());
$checkout->takePayment();
