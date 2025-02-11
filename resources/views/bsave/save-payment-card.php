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

// Replace with your existing customer ID
$customerId = $data['customerid'];
$amount=$data['amount'].'00';
$paymentId=$data['paymentMethodId'];
// Step 1: Create a PaymentIntent
$newPaymentMethodId = $paymentId; // Replace with actual PaymentMethod ID from frontend
$paymentMethod = \Stripe\PaymentMethod::retrieve($newPaymentMethodId);
$paymentMethod->attach(['customer' => $customerId]);

$paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => $amount, // Amount in cents
    'currency' => 'usd',
    'customer' => $customerId,
    'setup_future_usage' => 'off_session',
    'payment_method' => $paymentId,
     'confirm' => true,
    'automatic_payment_methods' => [
        'enabled' => true,
        'allow_redirects' => 'never', // Prevent redirect-based methods
    ], // Save the card for future use
]);

// Step 2: Collect card details (frontend example using Stripe Elements)
// Use the client secret from the PaymentIntent to confirm the payment on the frontend

json_encode(['clientSecret' => $paymentIntent->client_secret]);

// Step 3: On successful confirmation, attach the new card
// Assuming paymentMethodId is the ID of the new card obtained from the frontend

// Step 4: Confirm the PaymentIntent

if($paymentIntent->client_secret){
   $sql = "UPDATE `users` SET `payment_method_id` = '$newPaymentMethodId' WHERE `id` = '$customerId'";
   $result = $conn->query($sql);

    echo "PaymentIntent confirmed and new card added!";
}




?>