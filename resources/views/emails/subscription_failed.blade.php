<!DOCTYPE html>
<html>
<head>
    <title>Subscription Payment Failed</title>
</head>
<body>
    <h2>Hello, {{ $user->firstname }}!</h2>

    <p>We regret to inform you that your subscription payment for **[Your App Name]** has **failed**.</p>

    <p><strong>Reason:</strong> {{ $reason }}</p>

    <p>To avoid service disruption, please update your payment details and retry the transaction.</p>

    <p>
        <a href="{{ $retryLink }}" style="padding: 10px 15px; background-color: #ff5722; color: #fff; text-decoration: none; border-radius: 5px;">
            Retry Payment
        </a>
    </p>

    <p>If you need any assistance, feel free to contact our support team.</p>

    <p>Thank you for choosing **[Your App Name]**.</p>

    <p>Best regards,</p>
    <p><strong>The [Your App Name] Team</strong></p>
</body>
</html>
