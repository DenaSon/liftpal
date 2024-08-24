<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

        <meta charset="utf-8">
        <title>{{ $title ?? '' }}</title>
        <link rel="canonical" href="{{ url()->current() }}">

        @yield('meta')
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
