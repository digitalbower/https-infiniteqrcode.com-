<?php

// Include Stripe PHP library
require_once '../vendor/autoload.php';

// Set your Stripe secret key
\Stripe\Stripe::setApiKey('sk_test_51Q4eUWLg6tc3IU2s1KIvKWpoun2MNomSJ6zCrEiMKQzcWx5CKcTeYr1i10rgtCi6Z9jolQQTLkDYX6SB6peRe9fR00GcXSFy4m');

// Retrieve the payload from the request
$payload = @file_get_contents('php://input');
$sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];

// Your webhook secret from the Stripe Dashboard
$endpointSecret = 'whsec_WEx3qes5IbCKf9siBsEHXoBBWdykYt37';

try {
    // Verify the webhook signature
    $event = \Stripe\Webhook::constructEvent(
        $payload,
        $sigHeader,
        $endpointSecret
    );

    // Handle the event
    switch ($event->type) {
        case 'payment_intent.amount_capturable_updated':
            $paymentIntent = $event->data->object; // Contains a Stripe PaymentIntent
            // Handle amount capturable updated
            handleAmountCapturableUpdated($paymentIntent);
            break;

        case 'payment_intent.canceled':
            $paymentIntent = $event->data->object; // Contains a Stripe PaymentIntent
            // Handle payment intent canceled
            handlePaymentIntentCanceled($paymentIntent);
            break;

        case 'payment_intent.created':
            $paymentIntent = $event->data->object; // Contains a Stripe PaymentIntent
            // Handle payment intent created
            handlePaymentIntentCreated($paymentIntent);
            break;

        case 'payment_intent.payment_failed':
            $paymentIntent = $event->data->object; // Contains a Stripe PaymentIntent
            // Handle payment failed
            handlePaymentFailed($paymentIntent);
            break;

        case 'payment_intent.succeeded':
            $paymentIntent = $event->data->object; // Contains a Stripe PaymentIntent
            // Handle payment succeeded
            handlePaymentSucceeded($paymentIntent);
            break;

        case 'payment_method.attached':
            $paymentMethod = $event->data->object; // Contains a Stripe PaymentMethod
            // Handle payment method attached
            handlePaymentMethodAttached($paymentMethod);
            break;

        case 'payment_method.automatically_updated':
            $paymentMethod = $event->data->object; // Contains a Stripe PaymentMethod
            // Handle payment method automatically updated
            handlePaymentMethodUpdated($paymentMethod);
            break;

        default:
            // Handle other event types
            error_log('Unhandled event type: ' . $event->type);
    }

    http_response_code(200); // Respond with HTTP 200 OK
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    echo 'Webhook signature verification failed.';
    exit();
} catch (\Exception $e) {
    // Handle other exceptions
    http_response_code(400);
    echo 'Error: ' . $e->getMessage();
    exit();
}

// Functions to handle each event
function handleAmountCapturableUpdated($paymentIntent) {
    // Your logic for amount capturable updated
    error_log('Amount capturable updated for PaymentIntent ID: ' . $paymentIntent->id);
}

function handlePaymentIntentCanceled($paymentIntent) {
    // Your logic for payment intent canceled
    error_log('PaymentIntent canceled with ID: ' . $paymentIntent->id);
}

function handlePaymentIntentCreated($paymentIntent) {
    // Your logic for payment intent created
    error_log('PaymentIntent created with ID: ' . $paymentIntent->id);
}

function handlePaymentFailed($paymentIntent) {
    // Your logic for payment failed
    error_log('Payment failed for PaymentIntent ID: ' . $paymentIntent->id);
}

function handlePaymentSucceeded($paymentIntent) {
    // Your logic for payment succeeded
    error_log('Payment succeeded for PaymentIntent ID: ' . $paymentIntent->id);
}

function handlePaymentMethodAttached($paymentMethod) {
    // Your logic for payment method attached
    error_log('PaymentMethod attached with ID: ' . $paymentMethod->id);
}

function handlePaymentMethodUpdated($paymentMethod) {
    // Your logic for payment method updated
    error_log('PaymentMethod updated with ID: ' . $paymentMethod->id);
}
