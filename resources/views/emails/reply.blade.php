<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We're Here to Help!</title>
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
            <img src="{{ asset('images/logo.png') }}" alt="Infinite QR Code">
        </div>

        <h2 class="header">🤝 We're Here to Help, {{ $name }}!</h2>

        <p>Thank you for reaching out to us! Our team is here to assist you with any **questions or concerns** you may have.</p>

        <p>You can **reply to this email** or use our **contact form** on the website. We’ll get back to you **within 24–48 hours**.</p>

        <p>
            <a href="{{ url('/contact') }}" class="cta-button">
                Contact Support
            </a>
        </p>

        <p class="footer">
            Best regards, <br>
            <strong>The Infinite QR Code Team</strong> <br>
            <a href="https://yourwebsite.com">yourwebsite.com</a> | 
            <a href="mailto:support@yourwebsite.com">support@yourwebsite.com</a>
        </p>
    </div>

</body>
</html>
