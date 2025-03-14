<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Plan Change</title>
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
            color: #007bff;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }
        .details {
            background: #e6f0ff;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            margin: 20px 0;
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
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="header">🚀 Subscription Plan Updated!</h2>

        <p>Dear <strong>{{ $user->firstname }}</strong>,</p>

        @if($previousPlan)
        <p>Thank you for upgrading from <b>Plan {{ $previousPlan }}</b> to <b>Plan {{ $plan }}</b>! We’re excited to provide you with even more features to enhance your QR code experience.</p>
        @else
        <p>Thank you for subscribing to <b>Plan {{ $plan }}</b>! We’re thrilled to have you onboard.</p>
        @endif

        <div class="details">
            <p><strong>Your Subscription Details:</strong></p>
            <p><strong>Previous Plan:</strong> {{ $previousPlan }}</p>
            <p><strong>Plan:</strong> {{ $plan }}</p>
            <p><strong>Next Billing Date:</strong> {{  \Carbon\Carbon::parse($endDate)->format('d M, Y') }}</p>
            <p><strong>Monthly Price:</strong> ${{ $amount }}</p>
        </div>

        <p><strong>Here’s what you now enjoy with {{ $plan }}:</strong></p>

        <ul> 
            <li>✅ Unlimited Static QR Codes</li>
            <li>✅ 50 Dynamic QR Codes</li>
            <li>✅ 20,000 Scans per month/<  li>
            <li>✅ Advanced Customizable QR Code Designs</li>
            <li>✅ Scheduled QR Code Activation</li>
            <li>✅ Mobile-Friendly Dashboard</li>
            <li>✅ Quick QR Code Generation</li>
            <li>✅ Multi-user Access for Team Collaboration</li>
        </ul>

        <p>We’re here to ensure your experience is seamless. If you have any questions, feel free to contact us anytime.</p>

        <a href="{{ url('/index') }}" class="cta-button">Access My Dashboard</a>

        <p class="footer">
            Best regards, <br>
            <strong>The Infinite QR Code Team</strong> <br>
            <a href="https://infiniteqrcode.com">Infiniteqrcode.com</a> | 
            <a href="mailto:support@infiniteqrcode.com">support@infiniteqrcode.com</a>
        </p>
    </div>

</body>
</html>
