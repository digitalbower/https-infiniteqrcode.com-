<?php

use PhpParser\Node\Stmt\Echo_;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
require '../vendor/autoload.php'; // Include Stripe's PHP library
require '../config.php';
require '../mailer.php';

$userID = isset($_SESSION['username']) ? $_SESSION['username'] : '';

$customersql = "SELECT subscribe_status FROM users where username='{$userID}'";
$fetchcust = $mysqli->query($customersql);
$result = $fetchcust->fetch_assoc();

/* if ($result['subscribe_status'] == 'Active') {
    echo json_encode(['success' => false]);
    exit;
} */
//define("PUBLIK_KEY", );
require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey); // Replace with your Stripe secret key

$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);
$paymentMethodId = $data['payment_method_id'];
$plan = $data['plan'];
$duration = $data['duration'] == '30' ? 'monthly' : 'yearly';
$amount = intval($data['price'] . '00'); // Amount in cents ($10 or $100)
$price = $data['price'];
$setup_intent_id = $data['setup_intent_id'];
$email = $_SESSION['email'];
$username = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];

try {
    // Create a charge
    $charge = \Stripe\Charge::create([
        'amount' => 5000, // Amount in cents (e.g., $50.00)
        'currency' => 'usd',
        'source' => 'tok_visa', // Replace with the actual source token
        'description' => 'Example charge',
    ]);

    // Retrieve the receipt URL
    $receiptUrl = $charge->receipt_url;

    echo 'Receipt URL: ' . $receiptUrl;
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo 'Error: ' . $e->getMessage();
}
try {
    $customer = \Stripe\Customer::create([
        'name' => $username,
        'email' => $email, // Replace with the user's email
        'payment_method' => $paymentMethodId,
        'invoice_settings' => ['default_payment_method' => $paymentMethodId],
    ]);

    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'usd',
        'customer' => $customer->id,
        'payment_method' => $paymentMethodId,
        'confirmation_method' => 'automatic',
        'confirm' => true, // Confirm the payment immediately
        'return_url' => 'https://seo-backlinks-articles.com/bsave/clientnode.php',
        'receipt_email' => $email
    ]);

    $chargeid = $paymentIntent->latest_charge;
    $charge = \Stripe\Charge::retrieve($chargeid);
    $receiptUrl = $charge->receipt_url;
} catch (\Stripe\Exception\CardException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
try {
    // Create a PaymentIntent
    $setup_intent_id = $data['setup_intent_id'];
    $setupIntent = \Stripe\SetupIntent::retrieve($setup_intent_id);
    $paymentMethodId1 = $setupIntent->payment_method;

    // Create a Stripe customer


    // Update user's subscription in your database
    $userId = $_SESSION['username']; // Assume user is logged in
    $startDate = date('Y-m-d');
    $status = "Active";
    $customer = $customer->id;
    if ($customer != '') {
        $renewstatus = 'Enabled';
    } else {
        $renewstatus = 'disabled';
    }

    $endDate = date('Y-m-d', strtotime($duration === 'monthly' ? '+1 month' : '+1 year'));
    //print_r($amount, $plan, $duration, $startDate, $endDate, $userId);
    $paymentIntentid = $paymentIntent->id;
    $sqlinsert = $mysqli->prepare("INSERT INTO `user_subscriptions`(`user_id`, `plan_id`, `stripe_customer_id`, `stripe_payment_intent_id`, `default_payment_method`,
     `paid_amount`, `plan_interval`, `customer_name`, `customer_email`, `plan_period_start`, `plan_period_end`, `status`,`ReceiptURL`)  
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    $sqlinsert->bind_param(
        'sssssssssssss',
        $userID,
        $plan,
        $customer,
        $paymentIntentid,
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
    $sqlinsert->execute();

    $stmt = $mysqli->prepare("UPDATE users SET stripe_customer_id = ?, payment_method_id = ?,payment_intent_id = ?, subscribe_status=?, renew_status =? ,`price`=?, `plan`=?, `duration`=?, subscription_start = ?, subscription_end = ? WHERE username = ?");
    $stmt->bind_param("sssssssssss", $customer, $paymentMethodId, $paymentIntentid, $status, $renewstatus, $price, $plan, $duration, $startDate, $endDate, $userId);
    if ($stmt->execute()) {
        $to = $email;
        $subject = "Welcome to Plan {$plan} Your Upgrade Is Complete!";
        $body = "Dear [Name],<br>
        <p>Thank you for upgrading to Plan-{$plan}! We're thrilled to have you onboard as a premium subscriber.</p><br>
        Your subscription details:
        Plan: {$plan}<br>
        Next Billing Date: {$endDate} <br>
        With {$plan}, you now have access to: <br>
        <p>Unlimited Static QR Codes <br>
        Customizable QR Code Designs <br>
        Scheduled QR Code Activation <br>
        Mobile-Friendly Dashboard <br>
        Quick QR Code Generation</p>
        <p>
        We're here to support you as you take your QR code experience to the next level. If you have any questions or need assistance, feel free to contact us anytime.
        <a href='https://seo-backlinks-articles.com/dashboard' target='_blank' style='text-decoration:none;'>Dashboard</a>
        <br>
        Best regards,<br>
        The Infinite QR Code Team";
        sendMail($to, $subject, $body, $altBody = '');
        echo json_encode(['success' => true]);
    }
} catch (\Stripe\Exception\CardException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
