@extends('admin.panel.layouts.master')
@section('page-title','ویرایش دسته')
@section('CustomCss')

<script src="{{ asset('vendor/ckstandard/ckeditor.js') }}"></script>


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
<div class="col-sm-12">
<div class="card">
<div class="card-body">
    <div class="row">

        <div class="col-md-4">
            <h4 class="header-title mt-3 mt-md-0 mb-3">افزودن دسته</h4>

            <form method="POST" action="{{ route('blogCategories.update',$id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">نام دسته‌بندی:</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{ $catName }}">
                    <input type="hidden" name="type" id="type" class="form-control" value="{{ request()->input('type') }}" required>
                </div>



                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-primary mb-3">ثبت دسته‌بندی</button>
                </div>
            </form>


        </div> <!-- end col -->


        <div class="col-md-8">
            <h4 class="header-title">لیست دسته های مقالات</h4>



            <ul class="list-group">
                @foreach($categories as $index => $category)
                    <li class="list-group-item mt-1 border-1 showsub cursor-pointer ">
                        <div class="d-flex justify-content-between align-items-center">
                            <b class="">

                                {{ $category->name }}  </b>
                            <form id="deleteForm-{{$category->id}}" action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input name="type" type="hidden" value="category">
                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="confirmDelete({{$category->id}})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('categories.edit',['category' => $category->id, 'type' => 'category']) }}" >
                                    <i class="fas fa-edit"></i>
                                </a>
                            </form>
                        </div>

                    </li>
                @endforeach
            </ul>


            <div class="paginate">
                {{ $categories->links() }}
            </div>


        </div><!-- end col -->


    </div> <!-- end row -->
</div>
</div> <!-- end card -->
</div> <!-- end col -->
</div>








<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

@endsection

@section('CustomJs')

@include('admin.store.categories.inc._scripts')

@endsection
