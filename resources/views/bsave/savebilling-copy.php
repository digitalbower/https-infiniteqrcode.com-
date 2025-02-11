<?php session_start();
include_once('../config.php');
require  '../vendor/autoload.php'; // Include Stripe PHP library 
require '../mailer.php';

use Stripe\Stripe;
// Set your secret key (from Stripe Dashboard)
require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey); // Replace with your own Secret Key



$token = $_POST['token'];
$price = '10';
$stripe_price = intval($price . "00");
$plan = 'basic';
$duration = '1';
$paymentid = '';
$username = $_SESSION['firstname'] . '' . $_SESSION['lastname'];
$date = date('Y-m-d');

$plan_id = $plan;
$name = $username;
$email = $_SESSION['email'];
$paymentMethodId = $_POST['payment_id'];


// Retrieve JSON from POST body 
$jsonStr = file_get_contents('php://input');
$jsonObj = json_decode($jsonStr);

// Get user ID from current SESSION 
$userID = isset($_SESSION['username']) ? $_SESSION['username'] : 0;


// Fetch plan details from the database 
$sqlQ = "SELECT `id`,`name`,`price`,`interval`,`interval_count` FROM plans WHERE name=?";
$stmt = $mysqli->prepare($sqlQ);
$stmt->bind_param("i", $plan_id);
$stmt->execute();
$stmt->bind_result($subscr_plan_id,$planName, $planPrice, $planInterval, $intervalCount);
$stmt->fetch();
$stmt->close();
//$mysqli->close();
// Convert price to cents 
$planPriceCents = round($planPrice * 100);
//fetch existing subscription 

$customersql = "SELECT strp_customerid,subscription_id FROM users where username='{$userID}'";
$fetchcust = $mysqli->query($customersql);
$result = $fetchcust->fetch_assoc();
$scustomer_id = $result['strp_customerid'] ?? '';
$status=false;
$subsql = "SELECT stripe_subscription_id FROM user_subscriptions A LEFT JOIN USERS B ON A.customer_email = B.email WHERE A.id='{$result['subscription_id']}'";
$fetchsubs = $mysqli->query($subsql);
$resultsub = $fetchsubs->fetch_assoc();
$strpsub_id = $resultsub['stripe_subscription_id'] ?? '';
if (!empty($strpsub_id)) {
    try {
        // Retrieve the subscription
        $subscription = \Stripe\Subscription::retrieve($strpsub_id);
        $end = date("Y-m-d H:i:s", $subscription->current_period_end);
        $start = date("Y-m-d H:i:s", $subscription->current_period_start);
        // Get today's timestamp
        $today_timestamp = time(); // Current timestamp
        // Convert dates to timestamps
        $start_timestamp = strtotime($start);
        $end_timestamp = strtotime($end);
        // Check if today's timestamp is between start and end timestamps
        if ($today_timestamp >= $start_timestamp && $today_timestamp <= $end_timestamp) {
            echo "Active";
            $status=false;
            exit;
        } else {
            //$status = "Inactive";
            $status=true;
        }
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle error
        echo 'Error: ' . $e->getMessage();
        return null;
    }
}else{
    $status=true;
}

if ($status) {
    if (!empty($scustomer_id)) {
        try {
            $customer = \Stripe\Customer::retrieve($scustomer_id);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }
    } else if (empty($scustomer_id)) {
        try {
            $customer = \Stripe\Customer::create([
                'name' => $name,
                'email' => $email,
                'payment_method' => $paymentMethodId,
                'invoice_settings' => ['default_payment_method' => $paymentMethodId]
            ]);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }
    }
    //print_r($customer);
    if (empty($api_error) && $customer) {
        $pricecode = [];
        try {
            // Step 1: Retrieve the Product by Name
            $targetProductName = $planName; // Replace with the product name
            $products = \Stripe\Product::all(['limit' => 10]); // Fetch all products
            $productId = null;
            foreach ($products->data as $product) {
                if ($product->name === $targetProductName) {
                    $productId = $product->id;
                    break;
                }
            }
            if (!$productId) {
                throw new Exception("Product with name '{$targetProductName}' not found.");
            }
            // Step 2: Retrieve Prices for the Found Product
            $prices = \Stripe\Price::all(['product' => $productId, 'limit' => 1]);
            //echo "Retrieve Prices for the Found Product";
            //print_r($prices);
            foreach ($prices->data as $price) {
                $stprice = $price->unit_amount / 100;
                if ($planPrice == $stprice && $planInterval == $price->recurring->interval) {
                    $pricecode = $prices;
                }
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo 'Stripe API Error: ' . $e->getMessage();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        //print_r($pricecode);
        if (empty($pricecode)) {
            try {
                //echo "Create price with subscription info and interval";
                $price = \Stripe\Price::create([
                    'unit_amount' => $planPriceCents,
                    'currency' => "USD",
                    'recurring' => ['interval' => $planInterval, 'interval_count' => $intervalCount],
                    'product_data' => ['name' => $planName],
                ]);
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }
        } else {
            //echo "Retrive price with subscription info and interval";
            $price = $pricecode;
        }

        if (empty($api_error) && $price) {

            if (!empty($price['data'][0]['id'])) {
                $priceid = $price['data'][0]['id'];
            } else {
                $priceid = $price->id;
            }

            try {
                $subscription = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [[
                        'price' => $priceid,
                    ]],
                    'payment_behavior' => 'default_incomplete',
                    'payment_settings' => ['save_default_payment_method' => 'on_subscription'],
                    'expand' => ['latest_invoice.payment_intent'],
                ]);
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }
            //print_r($subscription);
            if (empty($api_error) && $subscription) {

                try {
                    // Create a charge: amount is in cents (e.g., $20.00 = 2000)
                    $charge = \Stripe\Charge::create([
                        'amount' => $stripe_price, // Amount in cents
                        'currency' => 'usd',
                        'description' => $username . ' Payment',
                        'source' => $token,

                    ]);

                    $paymentid = $charge['id'];
                    $ReceiptURL = $charge['receipt_url'];
                    $payment_intent_staus = $charge['status'];
                } catch (\Stripe\Exception\CardException $e) {
                    // Handle the error
                    http_response_code(500);
                    echo 'Error: ' . $e->getError()->message;
                }
                //print_r($charge);
                if (!empty($customer->id)) {
                    $output = [
                        'subscriptionId' => $subscription->id,
                        'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret,
                        'customerId' => $customer->id,
                        'payment_id' => $charge
                    ];
                } else {
                    $output = [
                        'subscriptionId' => $subscription->id,
                        'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret,
                        'customerId' => $customer_id,
                        'payment_id' => $charge,
                        "subscr_plan_id"=>$plan
                    ];
                }
                echo json_encode($output);
            } else {
                echo json_encode(['error' => $api_error]);
            }
        } else {
            echo json_encode(['error' => $api_error]);
        }
    } else {
        echo json_encode(['error' => $api_error]);
    }
    //}elseif($jsonObj->request_type == 'payment_insert'){ 
    //print_r($output);
    $payment_intent = $output['payment_id'];
    $subscription_id = $output['subscriptionId'];
    $customer_id = $output['customerId'];
    $subscr_plan_id = $subscr_plan_id;

    // Retrieve customer info 
    try {
        $customer = \Stripe\Customer::retrieve($customer_id);
    } catch (Exception $e) {
        $api_error = $e->getMessage();
    }

    $payment_intent_id = $payment_intent->id;
    $paidAmount = $payment_intent->amount;
    $paidAmount = ($paidAmount / 100);
    $paidCurrency = $payment_intent->currency;
    $payment_status = $payment_intent->status;
    $created = date("Y-m-d H:i:s", $payment_intent->created);

    // Retrieve subscription info 
    try {
        $subscriptionData = \Stripe\Subscription::retrieve($subscription_id);
    } catch (Exception $e) {
        $api_error = $e->getMessage();
    }
    $default_payment_method = $subscriptionData->default_payment_method;
    $default_source = $subscriptionData->default_source;
    $plan_obj = $subscriptionData->plan;
    $plan_price_id = $plan_obj->id;
    $plan_interval = $plan_obj->interval;
    $plan_interval_count = $plan_obj->interval_count;

    $current_period_start = $current_period_end = '';
    if (!empty($subscriptionData)) {
        $created = date("Y-m-d H:i:s", $subscriptionData->created);
        $current_period_start = date("Y-m-d H:i:s", $subscriptionData->current_period_start);
        $current_period_end = date("Y-m-d H:i:s", $subscriptionData->current_period_end);
    }
    $customer_name = $customer_email = '';
    if (!empty($customer)) {
        $customer_name = !empty($customer->name) ? $customer->name : '';
        $customer_email = !empty($customer->email) ? $customer->email : '';

        if (!empty($customer_name)) {
            $name_arr = explode(' ', $customer_name);
            $first_name = !empty($name_arr[0]) ? $name_arr[0] : '';
            $last_name = !empty($name_arr[1]) ? $name_arr[1] : '';
        }
        // Insert user details if not exists in the DB users table 
    }
    // Check if any transaction data exists already with the same TXN ID  ch_3QXJIoLg6tc3IU2s0Xhwg1Hq
    $sqlQ1 = "SELECT id FROM user_subscriptions WHERE stripe_payment_intent_id = ?";
    $stmt = $mysqli->prepare($sqlQ1);
    $stmt->bind_param("s", $payment_intent_id);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $prevPaymentID = $id;
    $stmt->close();

    $payment_id = 0;
    if (!empty($prevPaymentID)) {
        $payment_id = $prevPaymentID;
    } else {
        $userID=$_SESSION['username'];
        // Insert transaction data into the database 
        $sqlQ = "INSERT INTO user_subscriptions (user_id,plan_id,stripe_customer_id,stripe_plan_price_id,stripe_payment_intent_id,stripe_subscription_id,default_payment_method,default_source,paid_amount,paid_amount_currency,plan_interval,plan_interval_count,customer_name,customer_email,plan_period_start,plan_period_end,created,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($sqlQ);
        $stmt->bind_param("iissssssdssissssss", $userID, $subscr_plan_id, $customer_id, $plan_price_id, $payment_intent_id, $subscription_id, $default_payment_method, $default_source, $paidAmount, $paidCurrency, $plan_interval, $plan_interval_count, $customer_name, $customer_email, $current_period_start, $current_period_end, $created, $payment_status);
        $insert = $stmt->execute();
        if ($insert) {
            $payment_id = $stmt->insert_id;
            $active="Active";
            // Update subscription ID in users table 
            $sqlQ2 = "UPDATE users SET subscription_id='{$payment_id}',`price`='{$stripe_price}', `plan`='{$plan_id}', 
            `paymentid`='{$payment_intent_id}',`duration`='{$plan_interval}',subscibe_status='{$active}',strp_customerid='{$customer_id}'  WHERE username='{$userID}'";
            $stmt = $mysqli->query($sqlQ2);
        }
    }

    $output = [
        'payment_id' => base64_encode($payment_id)
    ];
    echo json_encode($output);
}
