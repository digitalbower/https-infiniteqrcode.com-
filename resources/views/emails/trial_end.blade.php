<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Free Trial is Ending Soon!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            text-align: center;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            color: #ff6600;
            font-size: 24px;
            font-weight: bold;
        }
        .plan-section {
            background: #ff6600;
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 18px;
            margin: 20px 0;
            font-weight: bold;
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
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="header">Your Free Trial Is About to Expire</h2>

        <p>Dear <strong>{{ $user->firstname }}</strong>,</p>

        <p>We hope you’ve enjoyed exploring the features of <strong>Infinite QR Code</strong> during your free trial! This is a quick reminder that your trial will expire on <strong>{{ $user->created_at->addDays(7)->format('Y-m-d') }}</strong>.</p>

        <p>To continue enjoying uninterrupted access to our premium QR code creation and management tools, upgrade to one of our subscription plans today.</p>

        <a href="{{ route('upgrade') }}" class="cta-button">Upgrade My Plan Now</a>

        <p>Don’t let your QR codes go inactive! Choose a plan that suits your needs and keep your QR code journey going.</p>

        <p>If you have any questions or need assistance, feel free to reach out.</p>

        <p class="footer">
            Best regards, <br>
            <strong>The Infinite QR Code Team</strong> <br>
            <a href="https://infiniteqrcode.com">Infiniteqrcode.com</a> | 
            <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a>
        </p>
    </div>

</body>
</html>
