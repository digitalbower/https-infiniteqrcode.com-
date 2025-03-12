<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Renewed</title>
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
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 150px;
        }
        .header {
            color: #28a745;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }
        .details {
            background: #e9f8ee;
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
        <img src="{{ asset('images/indexfav.png') }}" class="logo" alt="Infinite QR Code Logo">

        <h2 class="header">🎉 Subscription Renewed Successfully!</h2>

        <p>Dear <strong>{{ $user->firstname }}</strong>,</p>

        <p>We’re happy to inform you that your <strong>{{ $user->plan }}</strong> subscription with <strong>Infinite QR Code</strong> has been successfully renewed on <strong>{{ $user->subscription_start->format('Y-m-d') }}</strong>.</p>

        <div class="details">
            <p><strong>Plan Name:</strong> {{ $user->plan }}</p>
            <p><strong>Renewal Date:</strong> {{ $user->subscription_start->format('Y-m-d') }}</p>
            <p><strong>Next Renewal Date:</strong> {{ $user->subscription_end->format('Y-m-d') }}</p>
            <p><strong>Amount Charged:</strong> ${{ $user->price }}</p>
        </div>

        <p>No action is required from you. Your subscription will continue automatically, ensuring uninterrupted access to your plan features.</p>

        <p>If you need to make any changes or have any questions, feel free to visit your 
            <a href="{{ url('/account/settings') }}">Account Settings</a> or contact us at 
            <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a>.
        </p>

        <a href="{{ url('/account/settings') }}" class="cta-button">Manage Subscription</a>

        <p class="footer">
            Best regards, <br>
            <strong>The Infinite QR Code Team</strong> <br>
            <a href="https://infiniteqrcode.com">Infiniteqrcode.com</a> | 
            <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a>
        </p>
    </div>

</body>
</html>
