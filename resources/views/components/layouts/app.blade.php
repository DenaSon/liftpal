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
</head>

<body dir="rtl">
@livewireScripts
<script data-navigate-once src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<div id="main-wrapper">

    {{ $slot }}

</div>
<x-livewire-alert::scripts/>


<script data-navigate-once src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
@yield('js')
<script data-navigate-onc src="{{ asset('assets/js/theme.min.js') }}"></script>
<script data-navigate-onc>
    document.addEventListener('DOMContentLoaded', function() {
        function convertPersianNumbers(str) {
            const persianNumbers = '۰۱۲۳۴۵۶۷۸۹';
            const englishNumbers = '0123456789';
            return str.replace(/[۰-۹]/g, (char) => englishNumbers[persianNumbers.indexOf(char)]);
        }

        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                this.value = convertPersianNumbers(this.value);
            });
        });
    });
</script>

</body>

</html>
