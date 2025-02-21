<!DOCTYPE html>
<html>
<head>
    <title>Subscription Renewal Reminder</title>
</head>
<body>
    <h2>Hello, {{ $user->firstname }}!</h2>

    <p>We hope you're enjoying your **{{ $renewalType }} subscription** to **[Your App Name]**.</p>

    <p><strong>Your next renewal date:</strong> {{ \Carbon\Carbon::parse($renewalDate)->format('F j, Y') }}</p>
    <p><strong>Subscription amount:</strong> ${{ $amount }}</p>

    <p>Your subscription will be renewed automatically on the renewal date. No action is required from your side.</p>

    <p>If you wish to update your subscription settings, you can do so here:</p>
    <p><a href="{{ url('/subscription/settings') }}">Manage Subscription</a></p>

    <p>Thank you for being a valued user of **[Your App Name]**!</p>

    <p>Best regards,</p>
    <p><strong>The [Your App Name] Team</strong></p>
</body>
</html>
