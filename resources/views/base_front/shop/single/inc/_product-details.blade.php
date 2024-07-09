<!--=====================================
        PRODUCT DETAILS PART START
=======================================-->
<section class="inner-section">
<div class="container">
<div class="row">


    <div class="col-lg-3">
        <div class="details-gallery details-gallery-single">
            <div class="details-label-group">
                <label class="details-label new">جدید</label>
                <label class="details-label off">%{{ round($product->discount)}}</label>
            </div>
            <ul class="details-preview details-preview-single ">
                @foreach($product->images as $image)
                    <li><img src="{{ asset($image->file_path ?? 'front/assets/images/coming-soon.png' ) }}" alt="product"></li>

                @endforeach
            </ul>
            <ul class="details-thumb">
                @foreach($product->images as $image)
                    <li><img src="{{ asset($image->file_path ) }}" alt="product"></li>

                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-lg-6">

        <div class="details-content product-single-cart">

            <h1 class="details-name"><a href="{{ route('singleProduct',['product' => $product,'slug' => slugMaker($product->name)]) }}">{{ $product->name }}</a></h1>
            <div class="details-meta">
                <p>کد محصول:  <span> {{ $product->sku }} </span></p>
                <p>برند:<a href="{{ route('indexByBrand',['brand'=>$product->brand,'slug' => slugMaker($product->name)]) }}">{{ $product->brand->name }}</a></p>
            </div>
            <hr>
            <!-- <div class="details-rating">
                 <i class="active icofont-star"></i>
                 <i class="active icofont-star"></i>
                 <i class="active icofont-star"></i>
                 <i class="active icofont-star"></i>
                 <i class="icofont-star"></i>
                 <a href="#">(3 امتیاز)</a>
             </div> -->

            <div class="row">
                <div class="col-lg-12 product-overview">
                    <p class="product-description">

                        {{ $product->description }}

                    </p>

                    <div class="footer">


                        <div class="shop-box-container">
                            <div class="shop-box">
                                <i class="fas fa-shopping-cart shop-icon"></i>
                                <span class="shop-box-text">خرید آسان</span>
                            </div>
                            <div class="shop-box">
                                <i class="fas fa-fingerprint shop-icon"></i>
                                <span class="shop-box-text">پرداخت امن</span>
                            </div>
                            <div class="shop-box">
                                <i class="fas fa-truck  shop-icon"></i>
                                <span class="shop-box-text">ارسال سریع</span>
                            </div>
                            <div class="shop-box">
                                <i class="fas fa-star shop-icon"></i>
                                <span class="shop-box-text">تضمین کیفیت</span>
                            </div>

                        </div>





                    </div>

                </div>






            </div>
        </div>

    </div>


        <div class="col-lg-3 mt-1" id="cart-box">

            <h3 class="details-price">

                @if($product->discount > 0 )
                <del class="text-warning" style="font-size: 20px">
                    {{ number_format(round($product->types->first()->price))  }}
                </del>
                @endif
                <span class="product-unit-price" id="selectedTypeLabel-{{$product->id}}"> {{ number_format(round($product->types->first()->price - ( $product->types->first()->price * $product->discount / 100))) }}  </span> <span class="unit-price"> تومان</span>
            </h3>
            <hr/>

            @php
                $typeCount = $product->types->count();
            @endphp

            @if($typeCount > 0)
                <div class="product-option" @if($typeCount == 1) style="display:none" @endif>

                    <label class="visually-hidden" for="productType-{{$product->id}}"></label>


                    @php
                        $totalQuantity = 0;
                    @endphp
                    @foreach($product->types->load('batches') as $index=> $type)
                        @php
                            $typeQuantity = $type->batches->sum('quantity') - $type->batches->sum('sales_number');
                            $totalQuantity += $typeQuantity;
                        @endphp
                        @if($typeQuantity > 0)

                            <div class="row">

                                <div class="col-md-12 col-lg-12 alert fade show">

                                    <div class="profile-card address typeselect @if( $typeQuantity > 0 && $index ==0 ) active @endif" data-value="{{ $type->id }}"
                                         data-product = "{{ $product->id }}"
                                         data-price = "{{ round($type->price - ($type->price * ($product->discount / 100)))  }}">

                                        <span> {{ $type->name }}</span>

                                    </div>
                                </div>

                            </div>

                        @endif
                        @stack('scripts')
                    @endforeach
                </div>
            @endif

      





            <div class="d-flex justify-content-center">
                افزودن به سبد خرید
            </div>


            <div id="counter-container" class="counter">
                <button id="plus-btn">+</button>
                <div id="qty-counter"
                     data-value=""
                     data-price =""
                     data-product =""
                     class="qty-counter">  </div>
                <button id="minus-btn">-</button>
            </div>

            @if(!auth()->check())
                <label id="login-label-alert" class="alert alert-dark" style="text-align: center; display: block; margin: auto;">
                    وارد حساب کاربری خود شوید
                </label>

            @endif

        </div>





    </div>
</div>

</section>
<!--=====================================
PRODUCT DETAILS PART END
=======================================-->



