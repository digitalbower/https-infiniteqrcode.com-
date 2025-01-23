<!-- plan-details.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .plan-details {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            max-width: 600px;
            margin: 0 auto;
        }
        .plan-details h2 {
            color: #333;
        }
        .plan-details .price {
            font-size: 24px;
            color: #3955D9;
        }
        .plan-details .feature {
            margin-bottom: 10px;
        }
        .back-btn {
            padding: 10px 20px;
            background-color: #3955D9;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .back-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<h1>Plan Details</h1>
<div class="plan-details" id="plan-details"></div>

<script>
    const plans = {
        '500cc': {
            title: 'PLAN 1',
            price: '$49.99',
            ram: '16GB',
            ssd: '5TB',
            server: 'Dedicated Server',
            version: '2.1.8.05',
            mobileApp: true,
            webPortal: true
        },
        '1000cc': {
            title: 'PLAN 2',
            price: '$79.99',
            ram: '32GB',
            ssd: '10TB',
            server: 'Dedicated Server',
            version: '2.1.8.05',
            mobileApp: true,
            webPortal: true
        },
        '2000cc': {
            title: 'PLAN 3',
            price: '$149.99',
            ram: '64GB',
            ssd: '50TB',
            server: 'Dedicated Server',
            version: '2.1.8.05',
            mobileApp: true,
            webPortal: true
        },
        '5000cc': {
            title: 'PLAN 4',
            price: '$299.99',
            ram: '256GB',
            ssd: '100TB',
            server: 'Dedicated Server',
            version: '2.1.8.05',
            mobileApp: true,
            webPortal: true
        }
    };

    const urlParams = new URLSearchParams(window.location.search);
    const planId = urlParams.get('planId');

    if (plans[planId]) {
        const plan = plans[planId];
        const detailsDiv = document.getElementById('plan-details');

        detailsDiv.innerHTML = `
            <h2>${plan.title}</h2>
            <p class="price">${plan.price} / Month</p>
            <div class="feature">RAM: ${plan.ram}</div>
            <div class="feature">SSD: ${plan.ssd}</div>
            <div class="feature">Server: ${plan.server}</div>
            <div class="feature">Version: ${plan.version}</div>
            <div class="feature">Mobile App: ${plan.mobileApp ? 'Yes' : 'No'}</div>
            <div class="feature">Web Portal: ${plan.webPortal ? 'Yes' : 'No'}</div>
            <a href="plan-cart.html" class="back-btn">Back to Plans</a>
        `;
    } else {
        document.getElementById('plan-details').innerHTML = '<p>Plan not found.</p>';
    }
</script>

</body>
</html>
