<?php declare(strict_types=1);

namespace App\OpenClosed\Valid;

interface PaymentInterface {
    public function pay();
}

class PayPal implements PaymentInterface {
    public function pay() {
        return 'Paid by PayPal';
    }
}

class SagePay implements PaymentInterface {
    public function pay() {
        return 'Paid by SagePay';
    }
}

class WorldPay implements PaymentInterface {
    public function pay() {
        return 'Paid by WorldPay';
    }
}

class Checkout {
    private $payment;

    public function __construct(PaymentInterface $payment) {
        $this->payment = $payment;
    }
    public function takePayment() {
        echo $this->payment->pay();
    }
}

$checkout = new Checkout(new PayPal());
$checkout->takePayment();
