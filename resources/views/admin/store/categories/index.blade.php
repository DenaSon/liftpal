@extends('admin.panel.layouts.master')
@section('page-title','دسته بندی های فروشگاه')
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

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">نام دسته‌بندی:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">دسته والد:</label>
                <select name="parent_id" id="parent_id" class="js-example-basic-single form-control">
                    <option  selected value="null">بدون والد </option>
                    @foreach ($categoriesList as $category)
                        <option class="text-danger bold bg-blue" value="{{ $category->id }}" >{{ $category->name }} : {{ $category->id }}   </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-outline-primary mb-3">ثبت دسته‌بندی</button>
            </div>
        </form>


    </div> <!-- end col -->


    <div class="col-md-8">
      @if(count($categories) > 1)
            <h4 class="header-title">لیست دسته های فروشگاه</h4>
      @endif


<ul class="list-group">



    @foreach($categories->where('parent_id', null) as $index => $category)
    <li class="list-group-item mt-1 border-1 showsub cursor-pointer p-1 catItemHover">

        <div class="d-flex justify-content-between align-items-center">

                {{ $category->id }}  -  {{ $category->name }}

            <form id="deleteForm-{{$category->id}}" action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
                @csrf
                @method('delete')
                <input name="type" type="hidden" value="category">
               <a href="#" onclick="confirmDelete({{$category->id}})" class="text-danger mdi mdi-delete"></a>
                <a class="text-primary mdi mdi-book-edit" href="{{ route('categories.edit',['category' => $category->id, 'type' => 'category']) }}" >

                </a>
            </form>

        </div>

        @if( $category->subcategories->count() > 0 )
            <ul class="list-group mt-1 w-100 hidden-cat" >

                @foreach( $category->subcategories as $subIndex => $subcategory )
                    <li class="list-group-item bg-soft-primary mt-1 w-75 sub-cat-li p-1 catItemHover ms-2">

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fe-arrow-down-left"> </span>
                            <small>  <span class="fe-check-square"></span>   {{  $subcategory->id }}  -    {{  $subcategory->name }}  </small>
                            <form id="delSub-{{$subcategory->id}}" action="{{ route('categories.destroy', ['category' => $subcategory->id ]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input name="type" type="hidden" value="subcategory">
                                <input type="hidden" name="subcategory_id" value="{{ $subcategory->id }}">
                                <a href="#" onclick="confirmDeleteSub({{$subcategory->id}})" class="text-danger mdi mdi-delete"></a>
                                <a class="text-primary mdi mdi-book-edit" href="{{ route('categories.edit',['category' => $subcategory->id, 'type' => 'category']) }}" ></a>
                            </form>
                        </div>


                        @if ($subcategory->subcategories->count() > 0)

                            <ul  class="list-group mt-1 w-100 ">
                                @foreach ($subcategory->subcategories as $innerSubcategories)
                                    <li class="list-group-item bg-soft-dark mt-1 w-50 sub-cat-li p-1 catItemHover ms-2">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <small class="mx-auto">  <span class="fe-check-square"> </span> {{ $innerSubcategories->id }} -  {{ $innerSubcategories->name }}</small>

                                            <form id="innersub-{{$innerSubcategories->id}}" action="{{ route('categories.destroy', ['category' => $innerSubcategories->id ]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input name="type" type="hidden" value="subcategory">
                                                <input type="hidden" name="subcategory_id" value="{{ $innerSubcategories->id}}">
                                                <a href="#" onclick="confirmDeleteInner({{$innerSubcategories->id}})" class="text-danger mdi mdi-delete"></a>
                                                <a class="text-primary mdi mdi-book-edit" href="{{ route('categories.edit',['category' => $innerSubcategories->id, 'type' => 'category']) }}" ></a>
                                            </form>


                                        </div>
                                    </li>
                                    <!-- ادامه برای سطوح بیشتر -->
                                @endforeach
                            </ul>

                        @endif


                    </li>




                    @endforeach
            </ul>
        @endif
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
