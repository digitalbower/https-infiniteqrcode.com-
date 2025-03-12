<!DOCTYPE html>
<html>
<head>
    <title>Your Card is Expiring Soon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        p {
            color: #555;
            font-size: 14px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            background: #ff5722;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/indexfav.png') }}" class="logo" alt="Infinite QR Code Logo">

        <h2>Hello, {{ $user->firstname }}!</h2>

        <p>We noticed that your saved payment card is set to <strong>expire on {{ $expiryDate }}</strong>.</p>

        <p>To ensure uninterrupted service for your <strong>Infinite QR Code</strong> subscription, please update your payment details as soon as possible.</p>

        <div class="details">
            <strong>Card Expiry Date:</strong> {{ $expiryDate }}<br>
            <strong>Subscription Plan:</strong> {{ $user->plan }}
        </div>

        <a href="{{ $updateLink }}" class="button">Update Payment Details</a>

        <p>If your card has already been updated, please ignore this email.</p>

        <p class="footer">
            Thank you for being a valued customer!<br><br>
            Best regards,<br>
            <strong>The Infinite QR Code Team</strong><br>
            <a href="https://infiniteqrcode.com">Infiniteqrcode.com</a> | 
            <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a>
        </p>
    </div>
</body>
</html>
