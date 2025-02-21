<!DOCTYPE html>
<html>
<head>
    <title>Auto-Renewal Update</title>
</head>
<body>
    <h2>Hello, {{ $user->firstname }}!</h2>

    <p>We wanted to let you know that your **auto-renewal setting** has been **{{ $status }}**.</p>

    @if($status === 'Enabled')
        <p>✅ Your subscription will automatically renew at the end of your current billing cycle.</p>
        <p>You don’t need to do anything to continue enjoying our premium services.</p>
    @else
        <p>⚠️ Your subscription will not renew automatically.</p>
        <p>If you wish to continue your subscription, please manually renew before it expires.</p>
    @endif

    <p>If you have any questions, feel free to contact our support team.</p>

    <p>Best regards,</p>
    <p><strong>The [Your App Name] Team</strong></p>
</body>
</html>
