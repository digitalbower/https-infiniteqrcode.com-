<!DOCTYPE html>
<html>
<head>
    <title>Default Card Set Confirmation</title>
</head>
<body>
    <h2>Hello, {{ $user->firstname }}!</h2>

    <p>We wanted to let you know that your **default payment method** has been successfully updated.</p>

    <p><strong>New Default Card:</strong> **** **** **** {{ $cardLast4 }}</p>

    <p>If you did not authorize this change, please update your payment details immediately.</p>

    <p>
        <a href="{{ url('/billing') }}" style="padding: 10px 15px; background-color: #ff5722; color: #fff; text-decoration: none; border-radius: 5px;">
            Manage Payment Methods
        </a>
    </p>

    <p>If you need any assistance, feel free to contact our support team.</p>

    <p>Best regards,</p>
    <p><strong>The [Your App Name] Team</strong></p>
</body>
</html>
