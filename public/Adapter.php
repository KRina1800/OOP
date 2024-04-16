<?php

interface PaymentGateway {
    public function processPayment($amount);
}
class PayPalPaymentGateway {
    public function processPayment($amount) {
        // Логика для проведения платежа через PayPal
        echo "Платеж на сумму $amount руб. с помощью PayPal успешно проведен.\n";
    }
}
class StripePaymentGateway {
    public function makePayment($amount) {
        // Логика для проведения платежа через Stripe
        echo "Платеж на сумму $amount руб. с помощью Stripe успешно проведен.\n";
    }
}
class PayPalAdapter implements PaymentGateway {
    private $paypal;
    public function __construct(PayPalPaymentGateway $paypal) {
        $this->paypal = $paypal;
    }
    public function processPayment($amount) {
        // Используем метод processPayment() из PayPalPaymentGateway
        $this->paypal->processPayment($amount);
    }
}
class StripeAdapter implements PaymentGateway {
    private $stripe;
    public function __construct(StripePaymentGateway $stripe) {
        $this->stripe = $stripe;
    }
    public function processPayment($amount) {
        // Используем метод makePayment() из StripePaymentGateway
        $this->stripe->makePayment($amount);
    }
}
// Пример использования
$paypalGateway = new PayPalPaymentGateway();
$paypalAdapter = new PayPalAdapter($paypalGateway);
$paypalAdapter->processPayment(100.00);

$stripeGateway = new StripePaymentGateway();
$stripeAdapter = new StripeAdapter($stripeGateway);
$stripeAdapter->processPayment(150.00);
