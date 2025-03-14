<html>
    <head>
        <title>Subscription</title>
        <style>
        body {
                    font-family: Arial, sans-serif;
                    background-color: #3243232;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .email-container {
                    background-color: #ffffff;
                    width: 600px;
                    border: 20px solid #e0e0e0;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    
                }
                .header {
                    background-color: #e0e0e0;
                    padding: 2px;
                    text-align: center;
                }
                .header img {
                    width:200px;
                    height: auto;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                    color: #333333;
                }
                .header p {
                    margin: 0;
                    font-size: 14px;
                    color: #666666;
                }
                .content {
                    padding: 20px;
                }
                .content p {
                    font-size: 16px;
                    color: #333333;
                    line-height: 1.5;
                }
                .footer {
                    background-color: #e0e0e0;
                    padding: 3px;
                    text-align: center;
                    font-size: 14px;
                    font-weight:bold;
                    color: #666666;
                }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <img src="{{ asset('images/indexfav.png') }}" class="logo" alt="Infinite QR Code Logo">
            </div> 
            <div class="content">
                <p> Dear {{$user->firstname}},</p>
                <p>We wanted to inform you that automatic payment for your subscription with <a href="http://www.infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">infiniteqrcode.com</a> has been successfully turned off.</p>
                <p>To continue your subscription, you will need to renew it manually before the next due date.</p>
                <p>If you did not make this change or if you have any questions, please contact us at <a href="mailto:support@infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">support@infiniteqrcode.com</a>, and we’ll be happy to assist.</p>
                <p>Thank you for choosing InfiniteQRCode.com!
                </p>
                <p>Best regards,</p>
                <p>The Infinite QR Code Team<br>
               <a href="http://www.infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">infiniteqrcode.com</a>  |  <a href="mailto:support@infiniteqrcode.com" target="_blank" style="text-decoration:none;color:black;">support@infiniteqrcode.com</a></p>
            </div>
            <div class="footer">
                &copy; <a href="https://infiniteqrcode.com" style="text-decoration: none; color: #555;">infiniteqrcode.com</a> 2025, All rights reserved.
            </div>
        </div>
    </body>
</html>