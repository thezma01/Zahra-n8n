<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your One-Time Password (OTP)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px 0;
            text-align: center;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #28a745;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #e9f7ef;
            display: inline-block;
            border-radius: 5px;
            letter-spacing: 2px;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #777;
        }
        .expiry-info {
            font-size: 14px;
            color: #dc3545;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your One-Time Password (OTP)</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You have requested a One-Time Password to verify your identity. Please use the following code:</p>
            <div class="otp-code">{{ $otp_code }}</div>
            <p class="expiry-info">This OTP is valid for {{ $otp_expires_in_minutes ?? '5' }} minutes and will expire automatically.</p>
            <p>If you did not request this OTP, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
