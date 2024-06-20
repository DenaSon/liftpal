<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
<h1>ایمیل ارسال شده توسط فرم تماس  {{ getSetting('website_title') ?? '' }}</h1>
<p><strong>Name:</strong> {{ $name }}</p>
@if ($email)
    <p><strong>Email:</strong> {{ $email }}</p>
@endif
<p><strong>Phone:</strong> {{ $phone }}</p>
<p><strong>Message:</strong></p>
<p>{{ $text }}</p>
</body>
</html>
