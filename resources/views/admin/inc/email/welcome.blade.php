<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Atel System Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }
        h1 {
            color: #333333;
            margin-bottom: 20px;
        }
        p {
            color: #777777;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome To Atel </h1>



    <p style="direction: rtl;text-align: right;">{{ jdate(now())->toFormattedDateTimeString() }}</p>
</div>
</body>
</html>
