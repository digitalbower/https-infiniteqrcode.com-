<?php
require '../vendor/autoload.php';

require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);;




try {
    // Create a PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 5000, // Amount in cents
        'currency' => 'usd',
        'payment_method_types' => ['card'],
    ]);

    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (\Stripe\Exception\CardException $e) {
    // Error specific to card processing
    $error = $e->getError();
    switch ($error->code) {
        case 'card_declined':
            $errorMessage = "Your card was declined. Please use a different card.";
            break;
        case 'expired_card':
            $errorMessage = "Your card has expired. Please use a valid card.";
            break;
        case 'incorrect_cvc':
            $errorMessage = "The CVC code is incorrect. Please check and try again.";
            break;
        case 'processing_error':
            $errorMessage = "There was a problem processing your card. Please try again later.";
            break;
        case 'insufficient_funds':
            $errorMessage = "Your card has insufficient funds. Please use another card.";
            break;
        case 'authentication_required':
            $errorMessage = "Authentication is required. Please follow the instructions to complete the payment.";
            break;
        default:
            $errorMessage = $error->message ?? "An error occurred. Please try again.";
    }
    echo $errorMessage;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // General API error handling
    echo "An error occurred: " . $e->getMessage();
} catch (Exception $e) {
    // Handle other unexpected errors
    echo "An unexpected error occurred: " . $e->getMessage();
}
