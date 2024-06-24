<section class="container pt-5 mt-5">
    <!-- Breadcrumb-->
    <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('shop') }}">فروشگاه</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->categories->first()->name }}</li>
        </ol>
    </nav>

    <h1 class="h2 mb-2 font-vazir">
        {{ $product->name ?? '' }}
    </h1>


    <!-- Features + Sharing-->
    <div class="d-flex justify-content-between align-items-center">
        <ul class="d-flex mb-4 list-unstyled mt-3">

            <li class="me-3 pe-3 border-end"> <b class="me-1"> {{ $product->types->count() }} </b>
                نوع</li>

            <li><b> {{ $product->comments->count() }} </b> دیدگاه</li>
        </ul>
        <div class="text-nowrap">


            <button wire:click="add_favorite" class="btn btn-icon btn-xs shadow-sm rounded-circle ms-2 mb-2
            @if(\App\Models\Favorite::whereProductId($id)->whereUserId(auth()->id())->first())
                text-white bg-primary
            @endif" type="button"
                    data-bs-toggle="tooltip" aria-label="نشان کردن" data-bs-original-title="نشان کردن"><i
                    class="fi-heart"></i></button>


            <div class="dropdown d-inline-block" data-bs-toggle="tooltip" data-bs-original-title="اشتراک گذاری">
                <button class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle ms-2 mb-2" type="button"
                        data-bs-toggle="dropdown"><i class="fi-share"></i></button>
                <div class="dropdown-menu dropdown-menu-end my-1">
                    <button class="dropdown-item" type="button"><i class="fi-facebook fs-base opacity-75 me-2"></i>
                        فیسبوک
                    </button>
                    <button class="dropdown-item" type="button"><i class="fi-twitter fs-base opacity-75 me-2"></i>توییتر
                    </button>
                    <button class="dropdown-item" type="button"><i class="fi-instagram fs-base opacity-75 me-2"></i>اینستاگرام
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
