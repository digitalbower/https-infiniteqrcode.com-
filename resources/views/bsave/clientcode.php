<?php
require '../vendor/autoload.php';
require '../config.php';
session_start();
\Stripe\Stripe::setApiKey("sk_test_51Q4eUWLg6tc3IU2s1KIvKWpoun2MNomSJ6zCrEiMKQzcWx5CKcTeYr1i10rgtCi6Z9jolQQTLkDYX6SB6peRe9fR00GcXSFy4m"); // Replace with your Stripe secret key


// Check if the query parameters include a setup intent ID
if (isset($_GET['setup_intent']) && isset($_GET['setup_intent_client_secret'])) {
    $setupIntentId = $_GET['setup_intent'];

    try {
        // Retrieve the SetupIntent from Stripe
        $setupIntent = \Stripe\SetupIntent::retrieve($setupIntentId);

        if ($setupIntent->status === 'succeeded') {
            // SetupIntent was successful
            $paymentMethodId = $setupIntent->payment_method;

            // Save the payment method in your database
            $userId = $_SESSION['username']; // Assume user is logged in

            $stmt = $conn->prepare("UPDATE users SET stripe_payment_method_id = ? WHERE id = ?");
       
            $stmt->bind_param("si", $paymentMethodId, $userId);
       
            $stmt->execute();

            echo "Your payment method has been saved successfully!";
        } else {
            echo "Failed to set up the payment method. Status: " . $setupIntent->status;
        }
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo "Error retrieving SetupIntent: " . $e->getMessage();
    }
} else {
    echo "Invalid request. No SetupIntent found.";
}
