<?php declare(strict_types=1);

namespace OpenClosed\Violate;

class PayPal {
    public function payByPayPal() {
        return 'Paid by PayPal';
    }
}

class SagePay {
    public function payBySagePay() {
        return 'Paid by SagePay';
    }
}

class WorldPay {
    public function payByWorldPay() {
        return 'Paid by WorldPay';
    }
}

class Checkout {
    private $payment;

    public function __construct($payment) {
        $this->payment = $payment;
    }
    //This method has extensible behaviour i.e needs modification if we add new payment gateway
    public function takePayment() {
        if ($this->payment instanceof PayPal) {
            $this->payment->payByPayPal();
        }elseif ($this->payment instanceof SagePay) {
            $this->payment->payBySagePay();
        } elseif ($this->payment instanceof WorldPay) {
            $this->payment->payByWorldPay();
        }
    }
}

$checkout = new Checkout(new PayPal());
$checkout->takePayment();
