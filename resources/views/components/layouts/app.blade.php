<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }}</title>
    <link rel="canonical" href="{{ url()->current() }}">

    @yield('meta')

    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favico.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favico.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favico.png') }}">
    <link rel="mask-icon" color="#5bbad5" href="{{ asset('favico.png') }}">
    <meta name="msapplication-TileColor" content="#766df4">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    @yield('css')
    @stack('styles')
    @livewireStyles

    <!-- Core JS Files -->
    <script data-navigate-onc src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}" ></script>
    <script data-navigate-onc src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}" ></script>
    @yield('schema')
</head>

<body dir="rtl">
@livewireScripts
<script data-navigate-once src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div id="main-wrapper">

    {{ $slot }}

</div>
<x-livewire-alert::scripts/>



@yield('js')
<script data-navigate-once src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script data-navigate-onc src="{{ asset('assets/js/theme.min.js') }}"></script>



</body>

</html>
