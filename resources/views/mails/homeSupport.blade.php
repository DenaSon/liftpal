<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
<h1>ایمیل ارسال شده توسط    {{ getSetting('website_title') ?? '' }}</h1>
<p><strong>Name:</strong> {{ $fullname }}</p>

<p><strong>Phone:</strong> {{ $phone }}</p>
<p><strong>Message:</strong></p>
<p>{{ $text }}</p>
</body>
</html>
