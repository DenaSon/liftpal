<div>
    @section('css')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/simplebar/dist/simplebar.min.css') }}"/>
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.css') }}"/>

        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">
        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme-style.css') }}">

    @endsection


    @include('livewire.front.home-inc.header')


    <div class="container-fluid mt-5 pt-5 p-0">
        <div class="row g-0 mt-n3">

            @include('livewire.front.shop.inc.sidebar')


            <div class="col-lg-8 col-xl-9 position-relative overflow-hidden pb-5 pt-4 px-3 px-xl-4 px-xxl-5">


                <nav class="mb-3 pt-md-2" aria-label="Breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                        <li class="breadcrumb-item " aria-current="page">
                            <a wire:navigate class=" breadcrumb-item active" href="{{ route('shop') }}">
                                فروشگاه </a>

                        </li>
                    </ol>
                </nav>


                <!-- Sorting-->
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch my-2">
                    <div class="d-flex align-items-center flex-shrink-0">
                        <label class="fs-sm me-2 pe-1 text-nowrap" for="sortby"><i
                                class="fi-arrows-sort text-muted mt-n1 me-2"></i>مرتب سازی براساس: </label>
                        <select class="form-select form-select-sm" id="sortby" wire:model.live.debounce.150ms="sortby">
                            <option value="new">جدیدترین</option>
                            <option value="view">پربازدیدترین</option>
                            <option value="inprice">قیمت بالا</option>
                            <option value="deprice">قیمت پایین</option>

                        </select>
                    </div>
                    <hr class="d-none d-sm-block w-100 mx-4">
                    <div class="d-none d-sm-flex align-items-center flex-shrink-0 text-muted"><i
                            class="fi-check-circle me-2"></i><span class="fs-sm mt-n1">{{ $products->count() }} نتیجه یافت شد</span>
                    </div>
                </div>
                <!-- Catalog grid-->
                <div class="row g-2 py-4">

                    <div class="d-flex justify-content-center">
                        <button wire:loading type="button" class="btn btn-primary btn-icon">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>

                    @if($products->count() == 0)
                        <h1 style="font-size: 22px">محصول مرتبط یافت نشد</h1>
                    @endif
                    @foreach($products->load('categories', 'images', 'types') as $product)

                        <div class="col-sm-4 col-xl-3">

                            <div class="card shadow-sm card-hover border-0 h-100">

                                <div class=" card-img-top card-img-hover">

                                    <div class="position-absolute start-0 top-0 pt-3 ps-3"><span
                                            class="d-table badge bg-success">{{ $product->categories->first()->name }}</span>
                                    </div>
                                    <div class="content-overlay end-0 top-0 pt-3 pe-3">
                                        <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle"
                                                type="button" data-bs-toggle="tooltip" data-bs-placement="right"
                                                title="نشان کردن"><i class="fi-heart"></i></button>
                                    </div>
                                    <div class="tns-carousel-inner">
                                        <a style="text-decoration: none; color: inherit;" wire:navigate
                                           href="{{ route('singleProduct',['id'=>$product->id,'slug'=>slugMaker($product->name)]) }}">
                                            <img src="{{ $product->images->first()->file_path  ?? ""}}"
                                                 alt="{{ $product->name }}"
                                                 style="height: 250px">
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body position-relative pb-3">
                                    <h2 class="mb-2 fs-sm fw-normal text-primary ">

                                        <a style="text-decoration: none; color: inherit;" wire:navigate
                                           href="{{ route('singleProduct',['id'=>$product->id,'slug'=>slugMaker($product->name)]) }}">   {{ $product->name }}</a>
                                    </h2>


                                    <div class="fw-bold">
                                        <hr class="mt-2 mb-3"/>
                                        @if($product->types->count() > 0)
                                            @foreach($product->types->take(3) as $type)
                                                <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>     {{ number_format($type->price) }}
                                            @endforeach
                                        @endif

                                        <span class="small fw-normal">تومان</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- Pagination-->
                <nav class="border-top pb-md-4 pt-4 mt-2" aria-label="Pagination">
                    <ul class="pagination mb-1">
                        {{ $products->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>


    @include('livewire.front.home-inc.footer')

    @section('js')
        <script data-navigate-once src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts/>
        <script data-navigate-once
                src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>

    @endsection
</div>
