<section class="banner-part">
    <div class="container container-banner">

       

        <div class="row">
            <div class="col-lg-4 order-1 order-lg-0 order-xl-0 banners-home">
                <div class="row">
                    @if(!empty($banner))
                        @foreach($banner->images->sortByDesc('created_at')->take(2) as $image)
                            <div class="col-sm-6 col-lg-12">
                                <div class="home-grid-promo">
                                    <a href="{{ $image->link ?? route('home') }}">
                                        <img src="{{ asset($image->file_path) }}" alt="promo" class="home-banner">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-8 order-0 order-lg-1 order-xl-1">
                <div class="home-grid-slider slider-arrow slider-dots">
                    @foreach($slider->images ?? [] as $image)
                        <a href="{{ $image->link ?? route('home') }}"><img class="main-slider-image" src="{{ asset($image->file_path)  }}" alt="slider-{{$image->caption }}"></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<!--=====================================
            BANNER PART END
=======================================-->





