<!DOCTYPE html>
<html lang="fa">

<head>

    <meta charset="utf-8" />
    <title>{{ getSetting('website_title') }} | پنل مدیریت   </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ getSetting('website_title') }} Admin Panel" name="description" />
    <meta content="Mohammad Asadi" name="programmer" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

    <!-- Plugins css -->
    <link href="{{ asset('admin/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('admin/assets/css/config/default/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('admin/assets/css/config/default/app-rtl.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('admin/assets/css/config/default/app-dark-rtl.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('admin/assets/css/icons-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/fontiran.css') }}" rel="stylesheet" type="text/css" />


@if( request()->route()->getName() != 'dashboard' )

    @yield('CustomCss')

    @endif


</head>
