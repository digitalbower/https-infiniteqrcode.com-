<?php
//use PhpParser\Node\Stmt\Echo_;
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
require '../vendor/autoload.php'; // Include Stripe's PHP library
require '../config.php';
require '../mailer.php';

$userID = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$data = json_decode(file_get_contents('php://input'), true);
$customersql = "SELECT * FROM users where username='{$userID}'";
$fetchcust = $mysqli->query($customersql);
$result = $fetchcust->fetch_assoc();
$rplan = trim($result['plan']);
$dplan = trim($data['plan']);

if ($rplan === $dpaln) {
    if ($result['subscribe_status'] == 'Active') {
        echo json_encode(['success' => false]);
        exit;
    }
} else if ($dplan == 'pro' || $dplan == 'expert') {
}

//define("PUBLIK_KEY", );
require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey); // Replace with your Stripe secret key



// Extracting data from request
$paymentMethodId = $data['payment_method_id'];
$plan = trim($data['plan']);
$duration = $data['duration'] == '30' ? 'monthly' : 'yearly';
$amount = intval($data['price'] . '00'); // Convert price to cents
$price = $data['price'];
$setupIntentId = $data['setup_intent_id'];

// Session values
$email = $_SESSION['email'];
$username = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
$userId = $_SESSION['username']; // Assume username is stored in session

try {
    $setup_intent_id = $data['setup_intent_id'];
    $setupIntent = \Stripe\SetupIntent::retrieve($setup_intent_id);
    $paymentMethodId1 = $setupIntent->payment_method;
    // Create Stripe Customer
    $customer = \Stripe\Customer::create([
        'name' => $username,
        'email' => $email,
        'payment_method' => $paymentMethodId,
        'invoice_settings' => ['default_payment_method' => $paymentMethodId],
    ]);

    // Calculate subscription end date based on duration
    $startDate = date('Y-m-d');
    $endDate = date('Y-m-d', strtotime(
        $duration === 'daily' ? '+1 day' : ($duration === 'monthly' ? '+1 month' : '+1 year')
    ));

    // Create PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'usd',
        'customer' => $customer->id,
        'payment_method' => $paymentMethodId,
        'confirmation_method' => 'automatic',
        'confirm' => true,
        'setup_future_usage' => 'off_session', // Enable saving for future off-session use
        'receipt_email' => $email,
        'return_url' => 'https://infiniteqrcode.com/return', // URL for 3D Secure redirection
    ]);

    // Check for 3D Secure or other required actions
    if ($paymentIntent->status === 'requires_action' && $paymentIntent->next_action->type === 'use_stripe_sdk') {
        echo json_encode([
            'success' => false,
            'requires_action' => true,
            'payment_intent_client_secret' => $paymentIntent->client_secret
        ]);
        exit;
    }
    //print_r($paymentIntent);
    $chargeId = $paymentIntent->latest_charge;
    if (!$chargeId) {
        echo json_encode(['success' => false, 'error' => 'PaymentIntent did not generate a charge.']);
        exit;
    }

    try {
        $charge = \Stripe\Charge::retrieve($chargeId);
        $receiptUrl = $charge->receipt_url;
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to retrieve charge: ' . $e->getMessage()]);
        exit;
    }
    

    
   

    // Save subscription to database
    $status = "Active";
    $renewStatus = $customer->id ? 'Enabled' : 'Disabled';
    $paymentIntentId = $paymentIntent->id;

    $sqlInsert = $mysqli->prepare("INSERT INTO `user_subscriptions` 
        (`user_id`, `plan_id`, `stripe_customer_id`, `stripe_payment_intent_id`, `default_payment_method`,
        `paid_amount`, `plan_interval`, `customer_name`, `customer_email`, `plan_period_start`, `plan_period_end`, `status`, `ReceiptURL`)  
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sqlInsert->bind_param(
        'sssssssssssss',
        $userId,
        $plan,
        $customer->id,
        $paymentIntentId,
        $paymentMethodId,
        $price,
        $duration,
        $username,
        $email,
        $startDate,
        $endDate,
        $status,
        $receiptUrl
    );
    $sqlInsert->execute();

    // Update user's subscription in `users` table
    $stmt = $mysqli->prepare("UPDATE users SET stripe_customer_id = ?, payment_method_id = ?, payment_intent_id = ?, subscribe_status = ?, renew_status = ?, `price` = ?, `plan` = ?, `duration` = ?, subscription_start = ?, subscription_end = ? WHERE username = ?");
    $stmt->bind_param("sssssssssss", $customer->id, $paymentMethodId, $paymentIntentId, $status, $renewStatus, $price, $plan, $duration, $startDate, $endDate, $userId);
    $stmt->execute();

    // Send subscription confirmation email
    $to = $email;
    $subject = "Welcome to Plan {$plan} - Your Upgrade Is Complete!";
    $body = "Dear {$username},<br>
        <p>Thank you for upgrading to Plan-{$plan}! We're thrilled to have you onboard as a premium subscriber.</p>
        <p><strong>Subscription Details:</strong><br>
        Plan: {$plan}<br>
        Next Billing Date: {$endDate}<br>
        With {$plan}, you now have access to:<br>
        - Unlimited Static QR Codes<br>
        - Customizable QR Code Designs<br>
        - Scheduled QR Code Activation<br>
        - Mobile-Friendly Dashboard<br>
        - Quick QR Code Generation</p>
        <p>If you have any questions, feel free to contact us anytime.</p>
        <a href='https://seo-backlinks-articles.com/dashboard' target='_blank'>Go to Dashboard</a><br>
        Best regards,<br>The Infinite QR Code Team";

    sendMail($to, $subject, $body);

    echo json_encode(['success' => true, 'receipt_url' => $receiptUrl]);

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
    echo json_encode(['success' => false, 'error' => 'CardException: ' . $errorMessage]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['success' => false, 'error' => 'ApiErrorException: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'GeneralException: ' . $e->getMessage()]);
}
