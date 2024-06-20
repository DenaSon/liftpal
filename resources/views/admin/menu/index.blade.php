@extends('admin.panel.layouts.master')
@section('page-title','منوها')
@section('CustomCss')





<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('admin/assets/css/customize.css') }}" rel="stylesheet"/>

<script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
<link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
@include('admin.store.products.inc._errors')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->


<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="product-table">
                <thead>
                <tr>
                    <th>عنوان</th>
                    <th>کد دسترسی</th>
                    <th>اقدامات </th>

                  </tr>
                </thead>
                <tbody>






        @foreach($menus as $menu )
               <tr>
                        <td>
                            <a href="{{ route('menu.edit',['menu' => $menu]) }}">     {{ $menu->name }}</a>
                   </td>
                   <td> {{ $menu->slug }}</td>


                   <td>
                       <a  data-bs-toggle="modal" data-bs-target="#bs-edit-modal-md-{{$menu->id}}" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-square-edit-outline"></i> </a>
                       <a  class="btn btn-xs btn-outline-danger">
                           <i class="mdi mdi-trash-can-outline"></i> </a>
                   </td>



                   </tr>
               @include('admin.menu.inc._edit')
        @endforeach


                </tbody>
            </table>



        </div>

        <div class="paginate">

            {{ $menus->links() }}

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

@include('admin.store.products.inc._index_script')
<script src="{{ asset('admin/assets/libs/tippy.js/tippy.all.min.js') }}"></script>

@endsection










