<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../vendor/autoload.php';
require '../config.php';
require '../mailer.php';
require_once 'secrets.php';


\Stripe\Stripe::setApiKey($stripeSecretKey);

    $sql = "SELECT id, stripe_customer_id, payment_method_id, subscription_end, price, duration, email,plan,firstname,lastname 
        FROM users 
        WHERE subscription_end <= CURDATE() 
        AND renew_status = 'Enabled' 
        AND subscribe_status = 'Active' AND plan!='free'";

    $result = $mysqli->query($sql);


if (!$result) {
    $errorMessage = "Database query failed: " . $mysqli->error;
    writeLog($errorMessage);
    die($errorMessage);
}

if ($result->num_rows === 0) {
    $noRecordsMessage = "No subscriptions require renewal at this time.";
    writeLog($noRecordsMessage);
    echo $noRecordsMessage;
} else {
    while ($row = $result->fetch_assoc()) {
        $userEmail = $row['email'];
        $amount = intval($row['price'] . '00');
        $stripe_customer_id = $row['stripe_customer_id'];
        $paymentMethodId = $row['payment_method_id'];
        $duration = $row['duration'];
        $price= $row['price'];
        $plan = $row['plan'];
        $firstname= $row['firstname'];
        $lastname = $row['lastname'];
        $name=$firstname.' '.$lastname;
        $subscription_end=$row['subscription_end'];
        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'customer' => $stripe_customer_id,
                'payment_method' => $paymentMethodId,
                'confirmation_method' => 'automatic',
                'confirm' => true,
                'off_session' => true,
                'receipt_email' => $userEmail,
            ]);
            
            $paymentIntent = $paymentIntent->id;    
            $chargeId = $paymentIntent->latest_charge;
            $charge = \Stripe\Charge::retrieve($chargeId);
            $receiptUrl = $charge->receipt_url;

            $newEndDate = date('Y-m-d', strtotime($duration === 'monthly' ? '+1 month' : '+1 year'));
            $newStartDate = date('Y-m-d');
            $status='Active';
            
            $stmt = $mysqli->prepare("UPDATE users SET subscription_start = ?, subscription_end = ?,payment_intent_id=? WHERE username = ?");
            $stmt->bind_param("ssss", $newStartDate, $newEndDate, $paymentIntent, $userEmail);
            $stmt->execute();

            // Insert into subscriptions table
            $sqlInsert = $mysqli->prepare("INSERT INTO user_subscriptions 
                (user_id, plan_id, stripe_customer_id, stripe_payment_intent_id, default_payment_method, paid_amount, plan_interval, customer_name, customer_email, plan_period_start, plan_period_end, status, ReceiptURL) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $sqlInsert->bind_param(
                'sssssssssssss',
                $userEmail, 
                $plan, 
                $stripe_customer_id, 
                $paymentIntent, 
                $paymentMethodId, 
                $price, 
                $duration, 
                $userEmail, 
                $userEmail, 
                $newStartDate, 
                $newEndDate, 
                $status, 
                $receiptUrl
            );

            if (!$sqlInsert->execute()) {
                $insertError = "Insert query failed for user {$userEmail}: " . $sqlInsert->error;
                writeLog($insertError);
                die($insertError);
            }

            $successMessage = "Renewal completed for user ID: {$userEmail} (Email: $userEmail, Amount: $amount, Duration: $duration,New StartDate: $newStartDate,New EndDate:$newEndDate)";
            writeLog($successMessage);
            $subject="Your Subscription Has Been Renewed";
            $to=$userEmail;
            $from="info@infiniteqrcode.com";
            $body='<html>
                <head>
                <title>
                Registration Email
                </title>
                <style>
                body {
                            font-family: Arial, sans-serif;
                            background-color: #3243232;
                            margin: 0;
                            padding: 0;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                        }
                        .email-container {
                            background-color: #ffffff;
                            width: 600px;
                            border: 20px solid #e0e0e0;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            
                        }
                        .header {
                            background-color: #e0e0e0;
                            padding: 20px;
                            text-align: center;
                        }
                        .header img {
                            width: 50px;
                            height: 50px;
                        }
                        .header h1 {
                            margin: 0;
                            font-size: 24px;
                            color: #333333;
                        }
                        .header p {
                            margin: 0;
                            font-size: 14px;
                            color: #666666;
                        }
                        .content {
                            padding: 20px;
                        }
                        .content p {
                            font-size: 16px;
                            color: #333333;
                            line-height: 1.5;
                        }
                        .footer {
                            background-color: #e0e0e0;
                            padding: 10px;
                            text-align: center;
                            font-size: 14px;
                            font-weight:bold;
                            color: #666666;
                        }
                </style>
                </head>
                <body>
                <div class="email-container">
                
                <div class="content">
                    <p>Dear '.$name.', <br> We&rsquo;re happy to inform you that your '. $plan.' subscription with infiniteqrcode.com has been successfully renewed on '.$newStartDate.'.</p>
                            <b>Subscription Details</b>:<br> 
                            <ul>
                            <li>Plan Name:&nbsp; '. $plan.' <br></li> 
                            <li>Renewal Date:&nbsp; '.$newStartDate.' <br></li> 
                            <li>Next Renewal Date:&nbsp; '.$newEndDate.'<br></li> 
                            <li>Amount Charged:&nbsp;'.$amount.' <br></li></ul>
                           <p> No action is required from you.</p>
                            <p> Your subscription will continue automatically, ensuring uninterrupted access to your plan features.</p> 
                            <p> If you need to make any changes or have questions, feel free to visit your Account Settings or contact us at <a href="mailto:support@infiniteqrcode.com" target="_blank" style="text-decoration:none;">support@infiniteqrcode.com</a>.</p>
                            Thank you for continuing to trust infiniteqrcode.com for your QR code needs! <br><br>
                            Best regards,<br>
                            The Infinite QR Code Team,<br> 
                            <a href="https://www.infiniteqrcode.com" target="_blank" style="text-decoration:none;">infiniteqrcode.com</a> | <a href="mailto:support@infiniteqrcode.com" target="_blank" style="text-decoration:none;">support@infiniteqrcode.com</a>.
                            </p>
                </div>
                </div> <div class="footer">
                    <p>
                    ©infinitecode.com 2025, All rights Reserved
                    </p>
                </div>
                </div> </body>
                </html>';
                
            sendMail($userEmail, $subject,$body, "");
            echo $successMessage;
        } catch (\Stripe\Exception\CardException $e) {
            $paymentError = "Payment failed for user ID {$userEmail} (Email: $userEmail): {$e->getMessage()}";
            writeLog($paymentError);
            $body='               <html>
                <head>
                <title>
                Registration Email
                </title>
                <style>
                body {
                            font-family: Arial, sans-serif;
                            background-color: #3243232;
                            margin: 0;
                            padding: 0;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                        }
                        .email-container {
                            background-color: #ffffff;
                            width: 600px;
                            border: 20px solid #e0e0e0;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            
                        }
                        .header {
                            background-color: #e0e0e0;
                            padding-top: 10px;
                            padding-bottom: 10px;
                            text-align: center;
                        }
                        .header img {
                            width: 150px;
                            height: 75px;
                        }
                        .header h1 {
                            margin: 0;
                            font-size: 24px;
                            color: #333333;
                        }
                        .header p {
                            margin: 0;
                            font-size: 14px;
                            color: #666666;
                        }
                        .content {
                            padding: 20px;
                        }
                        .content p {
                            font-size: 16px;
                            color: #333333;
                            line-height: 1.5;
                        }
                        .footer {
                            background-color: #e0e0e0;
                            padding: 3px;
                            text-align: center;
                            font-size: 14px;
                            font-weight:bold;
                            color: #666666;
                        }
                </style>
                </head>
                <body>
                <div class="email-container">
                      <div class="header">
                      <img src="https://www.infiniteqrcode.com/QR%20code%20Logo%20-%20750250.svg">   
                </div> 
                <div class="content">
                   <p> Dear '.$name.',</p>
                    <p>We were unable to process the renewal for your '.$plan.' subscription with <a href="infiniteqrocde.com" target="_blank" style="text-decoration:none;color:black;">infiniteqrcode.com</a> on '.$subscription_end.'.</p>

                    <h3>Details:</h3>
                    <ul>
                    <li><b>Plan Name</b>:&nbsp; '. $plan.'.  </li>
                    <li><b>Renewal Date</b>:  '.$subscription_end.'.</li>
                    <li><b>Amount</b>: '.$amount.'.</li> </ul>
                    <p>This may have occurred due to an issue with your payment method. To avoid any interruption in your service, please update your payment information as soon as possible.</p>
                    <h3>What to Do:</h3>
                    <ol>
                    <li>Log in to your <a href="infiniteqrocde.com/sign" target="_blank" style="text-decoration:none;color:black;">account</a>.</li>
                    <li>Update your payment method in the Account Settings section.</li>
                    <li>Retry the payment.</li></ol>
                    <p> If you need assistance, feel free to contact us at <a href="mailto:support@infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">support@infiniteqrcode.com</a>, and our team will be happy to help.</p>
                    <p>Thank you for your prompt attention to this matter.</p>
                    Best regards,<br>
                    <p>The Infinite QR Code Team<br>
                    <a href="http://www.infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">infiniteqrcode.com</a>  |  <a href="mailto:support@infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">support@infiniteqrcode.com</a></p>

                </div>
                <div class="footer">
                    <p>
                    ©infinitecode.com 2025, All rights Reserved
                    </p>
                </div>
                </div>
                </body>
                </html>';
            sendMail($userEmail, "Action Required: Subscription Renewal Failed", "Your payment for the subscription failed. Please update your payment details.", "");
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $stripeError = "Stripe API error for user ID {$userEmail} (Email: $userEmail): {$e->getMessage()}";
            writeLog($stripeError);
        }
    }
}

function writeLog($message) {
    $logFile = 'subscription_renewal_'.date('Y-m-d h:i:s').'.log'; // Log file path
    $timestamp = date('Y-m-d H:i:s'); // Current timestamp
    $logMessage = "[$timestamp] $message" . PHP_EOL; // Format log message
    file_put_contents($logFile, $logMessage, FILE_APPEND); // Append message to log file
}
