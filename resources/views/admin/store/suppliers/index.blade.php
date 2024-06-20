@extends('admin.panel.layouts.master')
@section('page-title','لیست تامین کنندگان')
@section('CustomCss')

    <script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>


    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
          type="text/css"/>
    @include('admin.store.products.inc._errors')
@endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    @include('admin.store.suppliers.inc._create')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a data-bs-toggle="modal" data-bs-target="#top-modal"
                       class="btn btn-sm btn-warning waves-effect waves-light float-end">
                        <i class="mdi mdi-plus-circle"></i> افزودن تامین کننده
                    </a>
                    <div class="header-title mb-4">
                        <form method="get" action="{{ request()->fullUrl() }}">
                            <input value="{{ request()->query('name') ?? "" }}" name="name" class="form-control w-25"
                                   type="search" placeholder="عنوان یا نام تامین کننده + Enter">
                        </form>
                    </div>
                    <hr/>


                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100"
                               id="product-table">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>عنوان</th>
                                <th>نام</th>
                                <th>تلفن</th>
                                <th>ایمیل</th>
                                <th>امتیاز</th>
                                <th class="hidden-sm">اقدامات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($suppliers as  $supplier)
                                <tr id="row-{{ $supplier->id }}">
                                    <td><b>{{$supplier->id}}</b></td>
                                    <td>
                                        {{ $supplier->name }}
                                    </td>

                                    <td>
                                        {{ $supplier->contact_name }}


                                    </td>

                                    <td>
                                        {{ $supplier->phone }}
                                    </td>

                                    <td>
                                        {{ $supplier->email }}
                                    </td>

                                    <td>
                                        {{ $supplier->rating }} از 20
                                    </td>


                                    <td>
                                        <div class="d-flex align-items-center">


                                            <a data-bs-toggle="modal" data-bs-target="#standard-modal-{{$supplier->id}}"
                                               class="btn btn-sm btn-outline-primary m-1">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </a>


                                            @include('admin.store.suppliers.inc._edit')

                                            <a data-bs-toggle="modal" data-bs-target="#top-modal-{{$supplier->id}}"
                                               class="btn btn-sm btn-outline-blue  m-1">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>


                                            <a href="{{route('products.index').'?supplier='.$supplier->id}}" target="_blank"
                                               class="btn btn-sm btn-outline-danger  m-1">
                                                <i class="mdi mdi-shopping-search"></i>
                                            </a>


                                                <form action="{{ route('products.destroy', $supplier->id) }}"
                                                  class="inline-form delete-form"
                                                  data-id="{{ $supplier->id}}">
                                                @csrf
                                                @method('Delete')
                                                <button title="حذف" id="delete-btn-{{$supplier->id}}" type="button"
                                                        class="btn btn-sm btn-outline-danger delete-btn m-1">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                                @include('admin.store.suppliers.inc._show')

                            @endforeach

                            </tbody>
                        </table>



                    </div>

                    <div class="paginate">

                        {{ $suppliers->links() }}

                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->





    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection

@section('CustomJs')

    @include('admin.store.suppliers.inc._scripts')

@endsection










