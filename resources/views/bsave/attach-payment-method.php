
<?php 
require '../vendor/autoload.php'; // Include Stripe's PHP library
require '../config.php';
require '../mailer.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'secrets.php';
\Stripe\Stripe::setApiKey($stripeSecretKey);
$data = json_decode(file_get_contents('php://input'), true);
$customerId = $data['customerId'];
$paymentMethodId=$data['paymentMethodId'];


try {
    // Retrieve the PaymentMethod instance
    $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);

    // Attach the PaymentMethod to the customer
    $paymentMethod->attach(['customer' => $customerId]);

    echo 'PaymentMethod attached successfully!';
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle errors from Stripe API
    echo 'Error attaching PaymentMethod: ' . $e->getMessage();
}










?>