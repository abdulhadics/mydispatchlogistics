<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Code</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #f97316;
        }

        .code {
            font-size: 24px;
            font-weight: bold;
            background: #f0f0f0;
            padding: 15px;
            text-align: center;
            letter-spacing: 5px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Verify Your Email</h1>
        <p>Hello,</p>
        <p>Thank you for registering with MyDispatch Logistics. Please use the following One-Time Password (OTP) to
            verify your email address. This code is valid for 10 minutes.</p>
        <div class="code">{{ $otp }}</div>
        <p>If you did not request this code, please ignore this email.</p>
        <p>Best regards,<br>The MyDispatch Logistics Team</p>
        <div class="footer">
            &copy; {{ date('Y') }} MyDispatch Logistics. All rights reserved.
        </div>
    </div>
</body>

</html>