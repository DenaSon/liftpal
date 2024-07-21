@extends('admin.panel.layouts.master')
@section('page-title',' مدیریت  EED')
@section('CustomCss')

    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    @include('admin.elevator.eed.inc._counters')

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">


                <table id="tech-companies-1" class="table table-striped">

                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th data-priority="1"> کد خطا</th>
                        <th data-priority="1"> نوع</th>
                        <th data-priority="4">توضیح</th>
                        <th data-priority="6">تاریخ ایجاد</th>
                        <th data-priority="2" style="width:35px"> اقدامات</th>

                    </tr>

                    </thead>
                    <tbody>
                    @foreach($errors as $index => $error)
                     <tr>
                         <td>  {{ $index }} </td>
                         <td>  {{ $error->code }} </td>
                         <td>  {{ $error->type }} </td>
                         <td title="{{ $error->description }}">  {{ \Illuminate\Support\Str::limit($error->description,25,'...') }} </td>
                         <td>  {{ jdate($error->created_at)->toFormattedDateString()  }} </td>
                         <td>
                             <button class="btn btn-outline-danger btn-xs">
                                 <i class="mdi mdi-close"></i>
                             </button>
                         </td>
                     </tr>
                    @endforeach
                    </tbody>

                </table>

            </div> <!-- end .responsive-table-plugin-->
        </div>


    </div>

@endsection

@section('CustomJs')

    <script src="{{ asset('admin/assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('admin/assets/js/pages/responsive-table.init.js') }}"></script>

@endsection










