<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Payment Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
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
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
        }
        .header {
            color: #d32f2f;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }
        .details {
            background: #ffebee;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            margin: 20px 0;
        }
        .cta-button {
            display: inline-block;
            background: #d32f2f;
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
            color: #d32f2f;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- LOGO -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Your App Name">
        </div>

        <h2 class="header">⚠️ Subscription Payment Failed</h2>

        <p>Hello, <strong>{{ $user->firstname }}</strong>!</p>

        <p>We regret to inform you that your subscription payment for <strong>[Your App Name]</strong> has <strong>failed</strong>.</p>

        <div class="details">
            <p><strong>Reason:</strong> {{ $reason }}</p>
        </div>

        <p>To avoid service disruption, please update your payment details and retry the transaction.</p>

        <p>
            <a href="{{ $retryLink }}" class="cta-button">
                Retry Payment
            </a>
        </p>

        <p>If you need any assistance, feel free to contact our support team.</p>

        <p>Thank you for choosing <strong>[Your App Name]</strong>.</p>

        <p class="footer">
            Best regards, <br>
            <strong>The [Your App Name] Team</strong> <br>
            <a href="https://yourapp.com">yourapp.com</a> | 
            <a href="mailto:support@yourapp.com">support@yourapp.com</a>
        </p>
    </div>

</body>
</html>

