<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <title>{{ $title ?? '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="">
    <link rel="icon" type="image/png" sizes="32x32" href="">
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <link rel="manifest" href="">
    <link rel="mask-icon" color="#5bbad5" href="">
    <meta name="msapplication-TileColor" content="#766df4">

@yield('css')
    @stack('styles')
</head>

<body dir="rtl">

<div id="main-wrapper">

{{ $slot }}

</div>

@yield('js')
<x-livewire-alert::scripts/>
</body>

</html>
