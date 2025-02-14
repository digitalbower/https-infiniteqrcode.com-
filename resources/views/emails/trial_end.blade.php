<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Free Trial is Ending Soon</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; text-align: center;">

    <div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #ff6600;">Your Free Trial is Almost Over!</h2>

        <p>Hi <strong>{{ $user->firstname }}</strong>,</p>
        
        <p>Your **7-day free trial** of **[Your App Name]** will end on <strong>{{ $trial_end_date }}</strong>.  
        Don't miss out on your favorite features! Upgrade now to continue enjoying:</p>

        <ul style="text-align: left; display: inline-block;">
            <li>✅ Unlimited access to premium features</li>
            <li>✅ Exclusive content and tools</li>
            <li>✅ Priority customer support</li>
        </ul>

        <p><strong>Upgrade now to avoid losing access:</strong></p>

        <a href="{{ $subscription_link }}" style="background: #ff6600; color: #fff; padding: 12px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px;">
            Upgrade Now
        </a>

        <p>If you have any questions, feel free to <a href="{{ $support_link }}">contact our support team</a>.</p>

        <p>Thank you for being part of **[Your App Name]**! 💙</p>

        <p>Best Regards, <br>  
        <strong>The [Your App Name] Team</strong></p>

        <p style="font-size: 12px; color: #777;">If you don’t want to continue, no action is needed – your trial will automatically expire.</p>
    </div>

</body>
</html>
