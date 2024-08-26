<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? '' }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; color: #333333; margin: 0; padding: 0;">
<div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h1 style="color: #444444; font-size: 24px; text-align: center; border-bottom: 2px solid #eeeeee; padding-bottom: 10px; margin-bottom: 20px;">
        ایمیل ارسال شده توسط {{ getSetting('website_title') ?? '' }}
    </h1>

    <p style="font-size: 16px; margin: 10px 0;">
        <strong style="color: #007BFF;">نام:</strong> {{ $fullname ?? '' }}
    </p>

    <p style="font-size: 16px; margin: 10px 0;">
        <strong style="color: #007BFF;">شماره تماس کاربر:</strong> {{ $phone ?? '' }}
    </p>

    <p style="font-size: 16px; margin: 10px 0;">
        <strong style="color: #444444;">پیغام:</strong>
    </p>
    <p style="font-size: 16px; margin: 10px 0;">
        {{ $text ?? '' }}
    </p>
</div>
</body>
</html>
