<?php declare(strict_types=1);

namespace InterfaceSegregation\Valid;

interface PaymentInterface
{
    public function pay();
}
interface FraudCheckInterface
{
    public function fraudCheck();
}
interface ThreeDSecureCheckInterface
{
    public function threeDSecureCheck();
}
interface PaymentProcessInterface
{
    public function process();
}


class PayPal implements PaymentProcessInterface, PaymentInterface
{
    public function pay()
    {
        return 'Paid by PayPal';
    }

    public function process()
    {
        $this->pay();
    }
}

class SagePay implements PaymentProcessInterface, PaymentInterface, FraudCheckInterface
{
    public function pay()
    {
        return 'Paid by SagePay';
    }

    public function fraudCheck()
    {
        return 'Card is valid';
    }

    public function process()
    {
        $this->fraudCheck();
        $this->pay();
    }
}

class WorldPay implements PaymentProcessInterface, PaymentInterface, FraudCheckInterface, ThreeDSecureCheckInterface
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

    public function process()
    {
        $this->fraudCheck();
        $this->threeDSecureCheck();
        $this->pay();
    }
}

class Checkout
{
    private $payment;

    public function __construct(PaymentProcessInterface $payment)
    {
        $this->payment = $payment;
    }

    public function takePayment()
    {
        $this->payment->process();
    }
}

$checkout = new Checkout(new PayPal());
$checkout->takePayment();
