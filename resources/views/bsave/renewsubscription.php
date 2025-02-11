<?php
require '../config.php';
require '../mailer.php';
session_start();

if (isset($_POST['canceltype']) && $_POST['canceltype'] == 'enable') {
    $userID = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $stmtqrb = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmtqrb->bind_param("s", $userID);
    $stmtqrb->execute();
    $qrb = $stmtqrb->get_result();
    $row = $qrb->fetch_assoc();
    $renewstatus = $row['renew_status'];
    if ($renewstatus == 'disabled') {
       $updaterenew = "UPDATE users SET renew_status='Enabled' WHERE  username = '{$userID}'";
        if ($mysqli->query($updaterenew)) {
            $to=$userId;
            $Subject="Automatic Payment Turned On";
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
                            padding: 2px;
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
                   <p> Dear '.$firstname.',</p>
<p>We’re happy to inform you that automatic payment for your subscription with infiniteqrcode.com has been successfully turned on. Your subscription will now renew automatically before the next due date, ensuring uninterrupted service.</p>
<p>If you did not make this change or if you have any questions, please contact us at <a href="mailto:support@infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">support@infiniteqrcode.com</a>, and we’ll be happy to assist.</p>
<p>Thank you for choosing InfiniteQRCode.com!
</p>
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
            sendMail($to,$Subject,$body,"");
            header('Content-Type: application/json'); 
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json'); 
            echo json_encode(['success' => false]);
        }
    } else {
    }
} elseif (isset($_POST['canceltype']) && $_POST['canceltype'] == 'disable') {
    
    $userID = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $stmtqrb = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmtqrb->bind_param("s", $userID);
    $stmtqrb->execute();
    $qrb = $stmtqrb->get_result();
    $row = $qrb->fetch_assoc();
    $renewstatus = $row['renew_status'];
    if ($renewstatus == 'Enabled') {
        $updaterenew = "UPDATE users SET renew_status='disabled' WHERE username = '{$userID}'";
        if ($mysqli->query($updaterenew)) {
             $to=$userId;
            $Subject="Automatic Payment Turned Off";
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
                            padding: 2px;
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
                   <p> Dear '.$firstname.',</p>
<p>We wanted to inform you that automatic payment for your subscription with <a href="http://www.infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">infiniteqrcode.com</a> has been successfully turned off.
<p>
To continue your subscription, you will need to renew it manually before the next due date.</p>
<p>If you did not make this change or if you have any questions, please contact us at <a href="mailto:support@infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">support@infiniteqrcode.com</a>, and we’ll be happy to assist.</p>
<p>Thank you for choosing InfiniteQRCode.com!
</p>
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
            
            sendMail($to,$Subject,$body,"");
            header('Content-Type: application/json'); 
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json'); 
            echo json_encode(['success' => false]);
        }
    }
}elseif (isset($_POST['canceltype']) && $_POST['canceltype'] == 'cancel') {
    $userID = $_SESSION['username'];
    $stmtqrb = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmtqrb->bind_param("s", $userID);
    $stmtqrb->execute();
    $qrb = $stmtqrb->get_result();
    $row = $qrb->fetch_assoc();
    if($row['subscribe_status']=='Active'){
        $updaterenew = "UPDATE users SET renew_status='disabled' ,subscribe_status='Inactive' WHERE username = '{$userID}'";
        if ($mysqli->query($updaterenew)) {
             $to=$userId;
            $Subject=" Subscription Cancellation Request";
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
                            padding: 2px;
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
                   <p> Dear '.$firstname.',</p>
<p>We’re sorry to see you go! Your subscription cancellation request has been processed. Your account will remain active until the end of your current billing cycle.</p>
<p>If you’d like to reactivate your subscription or have any feedback, feel free to reach out.</p>

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
            sendMail($to,$Subject,$body,"");
            header('Content-Type: application/json'); 
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json'); 
            echo json_encode(['success' => false]);
        }
    }


}elseif (isset($_POST['canceltype']) && $_POST['canceltype'] == 'Reactivate') {
    $userID = $_SESSION['username'];
    $stmtqrb = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmtqrb->bind_param("s", $userID);
    $stmtqrb->execute();
    $qrb = $stmtqrb->get_result();
    $row = $qrb->fetch_assoc();
    if($row['subscribe_status']=='Inactive'){
        $updaterenew = "UPDATE users SET renew_status='Enabled' ,subscribe_status='Active' WHERE username = '{$userID}'";
        if ($mysqli->query($updaterenew)) {
             $to=$userId;
            $Subject="Subscription Reactivate Request";
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
                            padding: 2px;
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
                   <p> Dear '.$firstname.',</p>
<p>We’re sorry to see you go! Your  subscription Reactivate request has been processed. Your account enabled for auto-renewal billing cycle.</p>
<p>If you have any queries, feel free to reach out.</p>

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
            sendMail($to,$Subject,$body,"");
            header('Content-Type: application/json'); 
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json'); 
            echo json_encode(['success' => false]);
        }
    }

}