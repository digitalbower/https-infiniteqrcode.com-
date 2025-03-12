<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Renewal Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
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
            color: #007bff;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }
        .cta-button {
            display: inline-block;
            background: #007bff;
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
            color: #007bff;
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

        <h2 class="header">📢 Subscription Renewal Reminder</h2>

        <p>Hello, <strong>{{ $user->firstname }}</strong>!</p>

        <p>We hope you're enjoying your <strong>{{ $renewalType }} subscription</strong> to **Your App Name**.</p>

        <p><strong>Next Renewal Date:</strong> {{ \Carbon\Carbon::parse($renewalDate)->format('F j, Y') }}</p>
        <p><strong>Subscription Amount:</strong> ${{ $amount }}</p>

        <p>Your subscription will be automatically renewed on the renewal date. No action is required from your side.</p>

        <p>If you wish to update your subscription settings, click below:</p>

        <p>
            <a href="{{ url('/subscription/settings') }}" class="cta-button">
                Manage Subscription
            </a>
        </p>

        <p>Thank you for being a valued user of <strong>Your App Name</strong>! 🎉</p>

        <p class="footer">
            Best regards, <br>
            <strong>The Your App Name Team</strong> <br>
            <a href="https://yourwebsite.com">yourwebsite.com</a> | 
            <a href="mailto:support@yourwebsite.com">support@yourwebsite.com</a>
        </p>
    </div>

</body>
</html>
