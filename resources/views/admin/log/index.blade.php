@extends('admin.panel.layouts.master')
@section('page-title','گزارشات ')
@section('CustomCss')

    <script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

    @include('admin.inc.printStyle')

    @include('admin.store.products.inc._errors')
@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">


                        <table class="table table-log table-hover">
                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th style="width:100px;">کاربر</th>
                                <th>اقدام</th>
                                <th>توضیحات</th>
                                <th>آدرس IP</th>
                                <th>نوع</th>
                                <th>زمان</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($logs as $log)

                                <div id="info-alert-modal-{{$log->id}}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-body p-4">
                                                <div class="text-center">
                                                    <i class="@if($log->severity == 'info') dripicons-information text-info @endif
                                    @if($log->severity == 'warning') dripicons-warning text-warning @endif
                                    @if($log->severity == 'danger') dripicons-warning text-danger @endif
                                     h1 "></i>
                                                    <h4 class="mt-2">{{ $log->action }}</h4>
                                                    <p class="mt-3">

                                                        @if($log->action == 'Send-Sms' && Str::contains($log->description, 'message') )
                                                            {{ trim(explode('"message":"', explode('","data":', $log->description )[0])[1]) }}
                                                        @else
                                                            {{ $log->description }}
                                                        @endif
                                                    </p>
                                                    <button type="button" class="btn btn-sm btn-outline-blue my-2"
                                                            data-bs-dismiss="modal">بستن
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <tr class="@if($log->severity == 'danger') text-danger @endif">

                                    <td @if($log->severity == 'danger') class="bold" @endif>{{ $log->id }}</td>
                                    <td class="font-12">
                                        @if($log->user_id == null)
                                            احراز نشده
                                        @else
                                            {{ $log->profile->name ?? '' }} {{ $log->profile->last_name ?? '' }}
                                        @endif
                                    </td>
                                    <td>  {{ $log->action }}</td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-outline-blue btn-show"
                                                data-bs-toggle="modal" data-bs-target="#info-alert-modal-{{$log->id}}">
                                            مشاهده
                                        </button>
                                        <div
                                            class="description-text"> @if($log->action == 'Send-Sms' && Str::contains($log->description, 'message'))

                                                {{ trim(explode('"message":"', explode('","data":', $log->description)[0])[1]) }}
                                            @else
                                                {{ $log->description }}

                                            @endif </div>
                                    </td>
                                    <td>{{ $log->ip_address }}</td>
                                    <td>
                                        @if($log->severity == 'info')
                                            <span class="badge badge-outline-blue p-1"> معمولی </span>
                                        @endif
                                        @if($log->severity == 'warning')
                                            <span class="badge badge-outline-warning p-1"> هشدار </span>
                                        @endif
                                        @if($log->severity == 'danger')
                                            <span class="badge badge-outline-danger p-1"> مهم </span>
                                        @endif

                                    </td>
                                    <td style="font-size:12px;"
                                        title="{{ jdate($log->created_at)->toFormattedDateTimeString() }}">
                                        <div class="time-ago"> {{ jdate($log->created_at )->ago()  }} </div>
                                        <div
                                            class="hidden-date"> {{ jdate($log->created_at )->toFormattedDateTimeString()  }} </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>

                    <div class="report-button">

                        <button class="btn btn-outline-blue btn-sm" onclick="window.print()"> چاپ گزارش</button>

                        <a href="{{ route('log-save') }}" class="btn btn-outline-pink btn-sm"> ذخیره </a>
                        <a class="btn btn-outline-danger btn-sm" onclick="deleteLogs()"> حذف </a>


                        @if(session('link') == 1)

                            <a target="_blank" class="btn btn-sm btn-outline-dark" href="{{ asset('logs/logs.json') }}">
                                لینک دانلود </a>

                        @endif


                    </div>


                    <div class="report-text">
                        این گزارش در تاریخ
                        {{ jdate(now())->toFormattedDateTimeString() }}
                        چاپ شده است.
                    </div>

                    <div class="paginate">


                        {{ $logs->links() }}


                    </div>
                    <hr/>

                    <div class="row hidden-info" dir="ltr">


                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Server & Software Information </h5>
                                </div>
                                <ul class="list-group list-group-flush system-info-list">
                                    <li class="list-group-item"><span
                                            class="label label-default font-12"> Software  :</span><span class=""> {{ $_SERVER['SERVER_SOFTWARE'] ?? null }} | Laravel</span>
                                    </li>
                                    <li class="list-group-item"><span class="label label-default font-12"> PHP Version  :</span><span
                                            class=""> {{  phpversion() }}</span></li>
                                    <li class="list-group-item"><span class="label label-default font-12"> Laravel Version  :</span><span
                                            class=""> {{ app()->version() }}</span></li>
                                    <li class="list-group-item"><span class="label label-default font-12">PORT  :</span>
                                        <span class="">{{ $_SERVER['SERVER_PORT'] ?? ''  }}</span></li>
                                    <li class="list-group-item"><span
                                            class="label label-default font-12">IP Address :</span><span
                                            class=""> {{ $_SERVER['SERVER_ADDR'] ?? null }}</span></li>
                                    <li class="list-group-item"><span
                                            class="label label-default font-12">Server Name :</span><span
                                            class=""> {{ $_SERVER['SERVER_NAME'] ?? null }}</span></li>
                                    <li class="list-group-item"><span class="label label-default font-12">CPU Architecture :</span><span
                                            class=""> {{ php_uname('m') ?? null }}</span></li>
                                    <li class="list-group-item"><span class="label label-default font-12">Using Memory (RAM) :</span><span
                                            class=""> {{ number_format(round(memory_get_usage() / (10240),0),0) ?? null }} MB</span>
                                    </li>
                                    <li class="list-group-item"><span class="label label-default font-12">Max Memory Usage (RAM) :</span><span
                                            class=""> {{ number_format(round(memory_get_peak_usage() / (10240),0),0) ?? null }} MB</span>
                                    </li>
                                    <li class="list-group-item"><span class="label label-default font-12">Total Disk Space (HDD) :</span><span
                                            class=""> {{ number_format(round(disk_total_space(public_path()) / (1024*1024*1024),0),0) ?? null }} MB</span>
                                    </li>
                                    <li class="list-group-item"><span class="label label-default font-12">Free Disk Space (HDD) :</span><span
                                            class=""> {{ number_format( round(disk_free_space(public_path()) / (1024*1024*1024),0),0) ?? null }} MB</span>
                                    </li>


                                </ul>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Operating System</h5>
                                </div>
                                <ul class="list-group list-group-flush system-info-list">
                                    <li class="list-group-item"><span
                                            class="label label-default font-12">OS Name  :</span> <span
                                            class=""> {{ php_uname('s') ?? null }} </span></li>
                                    <li class="list-group-item"><span
                                            class="label label-default font-12">OS Version  :</span><span
                                            class=""> {{ php_uname('r') ?? null }}</span></li>
                                    <li class="list-group-item"><span
                                            class="label label-default font-12"> Host Name:</span><span
                                            class=""> {{ php_uname('n') ?? null }}</span></li>

                                </ul>
                            </div>
                        </div>


                    </div>


                </div>


            </div>
            <!-- end card-->
        </div>
        <!-- end col-->
    </div>




    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection




@section('CustomJs')

    @include('admin.log.inc.scripts')

@endsection










