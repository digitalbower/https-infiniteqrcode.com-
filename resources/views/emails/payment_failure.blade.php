<!DOCTYPE html>
<html>
<head>
    <title>Payment Failure Notification</title>
</head>
<body>
    <h2>Hello, {{ $user->firstname }}!</h2>

    <p>We regret to inform you that your payment of <strong>${{ $amount }}</strong> for your subscription to **[Your App Name]** was **unsuccessful**.</p>

    <p><strong>Reason for failure:</strong> {{ $reason }}</p>

    <p>To continue enjoying our services, please update your payment details and retry the transaction.</p>

    <p><a href="{{ url('/billing') }}" style="padding: 10px 15px; background-color: #ff5722; color: #fff; text-decoration: none; border-radius: 5px;">Update Payment Details</a></p>

    <p>If you need any assistance, feel free to contact our support team.</p>

    <p>Best regards,</p>
    <p><strong>The [Your App Name] Team</strong></p>
</body>
</html>

