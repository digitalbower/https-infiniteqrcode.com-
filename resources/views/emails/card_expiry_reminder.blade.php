<!DOCTYPE html>
<html>
<head>
    <title>Your Card is Expiring Soon</title>
</head>
<body>
    <h2>Hello, {{ $user->firstname }}!</h2>

    <p>We noticed that your saved payment card is set to **expire on {{ $expiryDate }}**.</p>

    <p>To ensure uninterrupted service for your **[Your App Name]** subscription, please update your payment details as soon as possible.</p>

    <p>
        <a href="{{ $updateLink }}" style="padding: 10px 15px; background-color: #ff5722; color: #fff; text-decoration: none; border-radius: 5px;">
            Update Payment Details
        </a>
    </p>

    <p>If your card has already been updated, please ignore this email.</p>

    <p>Thank you for being a valued customer!</p>

    <p>Best regards,</p>
    <p><strong>The [Your App Name] Team</strong></p>
</body>
</html>
