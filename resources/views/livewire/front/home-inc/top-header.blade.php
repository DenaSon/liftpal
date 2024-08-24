<!DOCTYPE html>
<html lang="fa">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? '' }}</title>
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- SEO Meta Tags-->
    <meta name="description" content="{{ getSetting('meta_description') }}">
    <meta name="keywords" content="{{ getSetting('meta_keywords') }}">
    <meta name="author" content="Liftpal Systems">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favico.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favico.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favico.png') }}">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" color="#5bbad5" href="{{ asset('favico.png') }}">
    <meta name="msapplication-TileColor" content="#766df4">
    <meta name="theme-color" content="#ffffff">

</head>
