
<section class="section recent-part">
<div class="container">
<div class="section-heading">
    <h3>محصولات </h3>
</div>


<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

    @foreach(getProducts()->shuffle()->load(['images','types','brand','batches'])->take(10) as $index => $product)

        @if($product->types->count() != 0)
            <div class="col">


                <div class="product-card product-card-main @if($product->batches->isEmpty()) product-disable @endif">

                    <div class="product-media">
                        @if($product->is_featured)

                            <div class="product-label">
                                <label class="label-text sale">ویژه</label>
                            </div>
                        @endif
                        <button class="product-wish wish ">
                            <i class="fas fa-heart"></i>
                        </button>
                        <a class="product-image" href="{{ route('singleProduct',['product' => $product,'slug' => slugMaker($product->name)]) }}">
                            <img class="" height="200" src="{{ $product->images->first()->file_path ?? 'front/assets/images/coming-soon.png' }}" alt="product">
                        </a>
                        <!--   <div class="product-widget">
                         <a title="Product Compare" href="compare.html" class="fas fa-random"></a>
                         <a title="Product Video" href="https://youtu.be/9xzcVxSBbG8" class="venobox fas fa-play vbox-item" data-autoplay="true" data-vbtype="video"></a>
                        <a title="اطلاعات محصول" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view-{{$product->id}}"></a>
                    </div> -->
                    </div>

                    <div class="product-content">

                        <h6 class="product-name">
                            <a  href="{{ route('singleProduct',['product' => $product,'slug' => slugMaker($product->name)]) }}">{{ $product->name }}</a>
                        </h6>
                        <h6 class="product-price product-price-main">
                            @if($product->discount > 0)
                                <span title="تخفیف" class="product-discount-label ms-2"> {{ round($product->discount) }}%</span>
                            @endif


                            <span> {{ number_format(round($product->types->first()->price ?? 0 - ( $product->types->first()->price ?? 0 * $product->discount / 100))) }} تومان  </span>





                        </h6>
                        <a href="{{ route('singleProduct',['product' => $product,'slug' => slugMaker($product->name)]) }}" class="product-add product-add-main" title="مشاهده جزئیات و خرید">
                            <i class="fas fa-shopping-basket"></i>
                            <span>خرید</span>
                        </a>

                    </div>
                </div>
            </div>
        @endif
    @endforeach

</div>

</div>


</section>
