<?php
require '../vendor/autoload.php';

require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);

// Create a SetupIntent
$setupIntent = \Stripe\SetupIntent::create([
    'customer' => $_POST['customerId'], // Customer ID
]);

// Send client secret to frontend
echo json_encode(['clientSecret' => $setupIntent->client_secret]);
?>