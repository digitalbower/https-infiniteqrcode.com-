<?php
require '../vendor/autoload.php'; // Include Stripe's PHP library
require '../config.php';
require '../mailer.php';
session_start();

require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);
$data = json_decode(file_get_contents('php://input'), true);
$email = $_SESSION['email'];
$username = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];

$setup_intent_id=$data['setup_intent_id'];
  $setupIntent = \Stripe\SetupIntent::retrieve($setup_intent_id);
    $paymentMethodId = $setupIntent->payment_method; 

    // Create a Stripe customer
       $customer = \Stripe\Customer::create([
        'name' => $username,
        'email' => $email, // Replace with the user's email
        'payment_method' => $paymentMethodId,
        'invoice_settings' => ['default_payment_method' => $paymentMethodId],
    ]);
 

// Save the customer ID and payment method ID in your database
$userId = $_SESSION['username'];
$stmt = $mysqli->prepare("UPDATE users SET stripe_customer_id = ?, payment_method_id = ? WHERE username = ?");
$stmt->bind_param("sss", $customer->id, $paymentMethodId, $userId);
$stmt->execute();

echo json_encode(['success' => true]);
?>
