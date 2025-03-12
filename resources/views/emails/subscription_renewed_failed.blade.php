<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Renewal Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .header {
            color: #ff0000;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }
        .details {
            background: #ffebeb;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            margin: 20px 0;
        }
        .cta-button {
            display: inline-block;
            background: #ff6600;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
            text-align: center;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="header">⚠️ Subscription Renewal Failed</h2>

        <p>Dear <strong>{{ $user->firstname }}</strong>,</p>

        <p>We were unable to process the renewal for your <strong>{{ $plan }}</strong> subscription on <strong>{{ $date->format('Y-m-d') }}</strong>.</p>

        <div class="details">
            <p><strong>Plan Name:</strong> {{$plan }}</p>
            <p><strong>Renewal Date:</strong> {{ $date->format('Y-m-d') }}</p>
            <p><strong>Amount:</strong> ${{ $amount }}</p>
        </div>

        <p>This may have occurred due to an issue with your payment method. To avoid service interruption, please update your payment information as soon as possible.</p>

        <h3>What to Do:</h3>
        <ul>
            <li>🔹 Log in to your account at <a href="https://infiniteqrcode.com">Infinite QR Code</a>.</li>
            <li>🔹 Update your payment method in the Account Settings.</li>
            <li>🔹 Retry the payment.</li>
        </ul>


        <p>If you need assistance, feel free to contact us at <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a>.</p>

        <p class="footer">
            Best regards, <br>
            <strong>The Infinite QR Code Team</strong> <br>
            <a href="https://infiniteqrcode.com">Infiniteqrcode.com</a> | 
            <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a>
        </p>
    </div>

</body>
</html>
