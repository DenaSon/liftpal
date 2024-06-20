<div>
    @section('css')
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/simplebar/dist/simplebar.min.css') }}"/>
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
        <!-- Main Theme Styles + Bootstrap-->
        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">
    @endsection


    <livewire:front.cart.cart-modal/>

    @include('livewire.front.home-inc.header')


    <!-- Background image parallax -->
    <div class="jarallax bg-dark py-5" data-jarallax data-speed="0.1">
        <span class="img-overlay"></span>
        <div class="jarallax-img"
             style="background-image: url({{ asset('assets/img/real-estate/blog/06.jpg') }})"></div>


        <div class="container content-overlay text-center my-md-4 py-sm-5 justify-content-center">
            <h2 class="h1 text-light py-lg-5 my-5">دانشنامه {{ getSetting('website_title') }}</h2>

            <nav class="mb-3 pt-md-3 text-light" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a wire:navigate class="text-light" href="{{ route('home') }}">خانه</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a wire:navigate class="text-light" href="{{ route('blogIndex') }}"> مقالات </a>
                    </li>
                </ol>
            </nav>

        </div>
    </div>


    <div class="container mt-5 mb-md-4 py-5" id="paginated-posts">

        <div class="row gy-3 mb-4 pb-2">
            <div class="col-md-4 order-md-1 order-2">
                <div class="position-relative">
                    <input wire:model.live.debounce.1500ms="search" class="form-control pe-5" type="text"
                           placeholder="جستجو مقاله ..."><i
                        class="fi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                </div>
            </div>
            <div class="col-lg-6 col-md-8 offset-lg-2 order-md-2 order-1">
                <div class="row gy-3">
                    <div class="col-6 d-flex flex-sm-row flex-column align-items-sm-center">
                        <label class="d-inline-block ms-sm-2 mb-sm-0 mb-2 text-nowrap" for="categories"><i
                                class="fi-align-left fi-rotate mt-n1 me-2 align-middle opacity-70"></i> دسته بندی &nbsp;
                        </label>
                        <select class="form-select" id="categories" wire:model.live.debounce.400ms="selectedCategory">
                            @foreach($categories as $category)
                                <option class="" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 d-flex flex-sm-row flex-column align-items-sm-center">
                        <label class="d-inline-block m-sm-2 mb-sm-0 mb-2 text-nowrap" for="sortby"><i
                                class="fi-arrows-sort mt-n1 me-2 align-middle opacity-70"></i>مرتب سازی براساس </label>

                        <select wire:model.live="selectedFilter" class="form-select" id="sortby">
                            <option value="new">جدیدترین</option>
                            <option value="old">قدیمی ترین</option>
                            <option value="view">پربازدید</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination-->
        <div wire:loading class="d-flex justify-content-center align-items-center position-relative">
            <div wire:loading class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>


        <!-- Articles grid-->
        <div class="row row-cols-md-4 row-cols-1 gy-md-5 gy-4 mb-lg-5 mb-4 blog-list">


            @foreach($posts as $post )
                <!-- Article-->
                <article class="col pb-2 pb-md-1" wire:key="{{$post->id}}">
                    <a wire:navigate class="d-block position-relative mb-3"
                       href="{{ route('singleArticle',['id'=>$post->id,'slug'=>slugMaker($post->title)]) }}">
                    <span
                        class="badge bg-info position-absolute top-0 start-0 m-3 fs-sm"></span>
                        <img class="d-block rounded-3" src="{{ asset($post->images()->first()->file_path) }}" alt=""
                             style="height:220px !important;width:100%">
                    </a>

                    @foreach($post->categories as $category)

                        <a class="fs-sm text-decoration-none text-muted" wire:click="getCategory({{ $category->id }})" href="#paginated-posts">
                            {{ $category->name }}
                        </a>

                    @endforeach
                    <h5 class="h5 mb-2 pt-1">
                        <a class="nav-link" href="{{ route('singleArticle',['id'=>$post->id,'slug'=>slugMaker($post->title)]) }}">
                            {{ $post->title }}

                        </a></h5>
                    <p class="mb-3">
                        {{ jdate($post->created_at)->ago() }}
                    </p>
                </article>
                <!-- Article-->
            @endforeach
            @if( $posts->count() < 1 )

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-center mt-5">نتیجه ای یافت نشد</h2>
                        </div>
                    </div>
                </div>

            @endif
        </div>


        <nav class="pt-4 pb-2 border-top" aria-label="Blog pagination">
            <ul class="pagination mb-0">

                {{ $posts->links(data: ['scrollTo' => '#paginated-posts']) }}

            </ul>
        </nav>
    </div>

    @include('livewire.front.home-inc.footer')
    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script data-navigate-once  src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once  src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once  src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once  src="{{ asset('assets/vendor/nouislider/dist/nouislider.min.js') }}"></script>
        <script data-navigate-once  src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
        <script data-navigate-once  src="{{ asset('assets/vendor/jarallax/dist/jarallax.min.js') }}"></script>

        <script data-navigate-once  src="{{ asset('assets/js/theme.min.js') }}"></script>

    @endsection


</div>
