<!DOCTYPE html>
<html>
<head>
    <title>Your Free Trial Awaits!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn {
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
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/indexfav.png') }}" class="w-[200px]" alt="Company Logo" />

        <h2>Welcome to Infinite QR Code, {{ $user->firstname }}!</h2>
        <p>Your 7-day free trial is now active. Explore all the premium features and see how our platform can simplify your QR code needs.</p>

        <a href="{{ url('/login') }}" class="btn">Login to Your Account</a>

        <p class="footer">If you have any questions, we’re here to help.</p>
        <p class="footer">Cheers, <br> The Infinite QR Code Team</p>
    </div>
</body>
</html>
