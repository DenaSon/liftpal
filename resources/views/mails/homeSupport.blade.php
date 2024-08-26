<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? '' }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333333;
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
        }
        h1 {
            color: #444444;
            font-size: 24px;
            text-align: center;
            border-bottom: 2px solid #eeeeee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin: 10px 0;
        }
        .info {
            background-color: #f9f9f9;
            padding: 10px;
            border-left: 4px solid #007BFF;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .info strong {
            display: block;
            color: #007BFF;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>ایمیل ارسال شده توسط {{ getSetting('website_title') ?? '' }}</h1>

    <div class="info">
        <strong>نام:</strong> {{ $fullname ?? '' }}
    </div>

    <div class="info">
        <strong>شماره تماس کاربر:</strong> {{ $phone ?? '' }}
    </div>

    <p><strong>پیغام:</strong></p>
    <p>{{ $text ?? ''}}</p>
</div>
</body>
</html>
