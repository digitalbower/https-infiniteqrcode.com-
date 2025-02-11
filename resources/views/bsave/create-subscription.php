<?php

require '../vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51Q4eUWLg6tc3IU2s1KIvKWpoun2MNomSJ6zCrEiMKQzcWx5CKcTeYr1i10rgtCi6Z9jolQQTLkDYX6SB6peRe9fR00GcXSFy4m');

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethodId = $input['paymentMethodId'];
    $plan = $input['plan'];
    $email = $input['email'];
    try {
        // Create customer
        try {
            $customer = \Stripe\Customer::create([
                'payment_method' => $paymentMethodId,
                'email' => $email,
                'invoice_settings' => ['default_payment_method' => $paymentMethodId],
            ]);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }

        if (empty($api_error) && $customer) {
            try {
                // Create price with subscription info and interval 
                $price = \Stripe\Price::create([
                    'unit_amount' => $planPriceCents,
                    'currency' => "usd",
                    'recurring' => ['interval' => $planInterval, 'interval_count' => $intervalCount],
                    'product_data' => ['name' => $planName],
                ]);
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }
            if (empty($api_error) && $price) {
                // Create a new subscription 
                try {
                    // Create subscription
                    $subscription = \Stripe\Subscription::create([
                        'customer' => $customer->id,
                        'items' => [['price' => $plan]],
                        'expand' => ['latest_invoice.payment_intent'],
                    ]);
                } catch (Exception $e) {
                    $api_error = $e->getMessage();
                }

                if (empty($api_error) && $subscription) {
                    $paymentIntent = $subscription->latest_invoice->payment_intent;

                    echo json_encode([
                        'status' => $paymentIntent->status,
                        'subscriptionId' => $subscription->id,
                    ]);
                }
            } else {
                echo json_encode(['error' => $api_error]);
            }
        } else {
            echo json_encode(['error' => $api_error]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}


?>









