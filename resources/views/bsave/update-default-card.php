<?php

require '../vendor/autoload.php'; // Include the Stripe PHP library

require_once 'secrets.php';


\Stripe\Stripe::setApiKey($stripeSecretKey);// Replace with your secret API key

header('Content-Type: application/json');

try {
    // Decode the incoming JSON request
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['cardId'])) {
        throw new Exception('Card ID is required.');
    }

    $cardId = $input['cardId']; // The selected card ID from the frontend
    $customerId = $input['customerid']; // Replace with the actual customer ID

    // Update the default payment method
    $customer = \Stripe\Customer::update($customerId, [
        'invoice_settings' => [
            'default_payment_method' => $cardId,
        ],
    ]);

    // Return a success response
    echo json_encode([
        'success' => true,
        'message' => 'Default card updated successfully.',
    ]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle Stripe API errors
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ]);
} catch (Exception $e) {
    // Handle general errors
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ]);
}
