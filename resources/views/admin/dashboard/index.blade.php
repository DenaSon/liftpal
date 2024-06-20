@extends('admin.panel.layouts.master')
@section('page-title','داشبورد')
@section('content')


    @include('admin.dashboard.inc._counters')
<!-- end row-->
    @include('admin.dashboard.inc._charts')

<!-- end row -->
    @include('admin.dashboard.inc._lists')
<!-- end row -->




@endsection

@section('CustomJs')

<!-- Plugins js-->
<script src="{{ asset('admin/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- Dashboard 1 init js-->
@include('admin.dashboard.inc._scripts')





@endsection
