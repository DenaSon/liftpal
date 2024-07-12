<!--=====================================
                    BRAND PART START
        =======================================-->



<section class="section brand-part">
    <div class="container">
        <div class="section-heading">
            <h3>  برندها </h3>


        </div>
        <div class="brand-slider slider-arrow">

            @foreach(getBrands(15)->load(['products','images']) as $brand)

            <div class="brand-wrap">
                <div class="brand-media" title="{{ $brand->description }}">
                    <img src="{{ $brand->images->first()->file_path ?? 'front/assets/images/brand/05.jpg' }}" alt="{{ $brand->name }}" title="{{ $brand->description }}">
                    <div class="brand-overlay">
                        <a title="{{ $brand->description }}" href="{{ route('indexByBrand',['brand' =>$brand,'slug' => slugMaker($brand->name)]) }}">
                            <i title="{{ $brand->description }}" class="fas fa-link"></i></a>
                    </div>
                </div>
               <div class="brand-meta">
                    <!--<h4 title="{{ $brand->description }}">{{ $brand->name }}</h4> -->
                    <p class="font-12">{{ $brand->name}}  </p>
                </div>
            </div>
            @endforeach

        </div>
 <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-25">
                    <a title="مشاهده تمام برندها" href="{{ route('brandList') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-eye"></i>
                        <span>مشاهده همه برندها</span>
                    </a>
                </div>
            </div>
        </div>


    </div>
</section>
<!--=====================================
            BRAND PART END
=======================================-->
