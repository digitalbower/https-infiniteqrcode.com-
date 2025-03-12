<!DOCTYPE html>
<html>
<head>
    <title>Auto-Renewal Update</title>
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
        .details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: left;
        }
        .details strong {
            color: #333;
        }
        .button {
            display: inline-block;
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
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

        <h2>Dear {{ $user->firstname }},</h2>

        <p>
            We hope this message finds you well.<br>
            Your <strong>{{ $user->plan }}</strong> subscription with <strong>Infinite QR Code</strong> is scheduled to auto-renew on 
            <strong>{{ $user->subscription_end->format('Y-m-d') }}</strong>.
        </p>

        <div class="details">
            <strong>Subscription Details:</strong><br>
            <strong>Plan Name:</strong> {{ $user->plan }}<br>
            <strong>Renewal Date:</strong> {{$user->subscription_end->format('Y-m-d') }}<br>
            <strong>Amount:</strong> ${{ $user->price }}
        </div>

        <p>
            If you wish to update your payment method or cancel your subscription, please visit your 
            <a href="{{ url('/account/settings') }}">Account Settings</a> 
            or contact us at 
            <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a> before the renewal date.
        </p>

        <a href="{{ url('/account/settings') }}" class="button">Manage Subscription</a>

        <p class="footer">
            Thank you for choosing Infinite QR Code. We’re excited to continue serving your QR code needs!<br>
            <br>
            Best regards,<br>
            <strong>The Infinite QR Code Team</strong><br>
            <a href="https://infiniteqrcode.com">Infiniteqrcode.com</a> | 
            <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a>
        </p>
    </div>
</body>
</html>
