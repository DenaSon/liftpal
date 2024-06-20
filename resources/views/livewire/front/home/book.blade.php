<section class="min">
<div class="container">

<div class="row justify-content-center">
<div class="col-lg-7 col-md-8">
<div class="sec-heading center">
    <h3 class="font-2">کتاب های آموزشی <span class="theme-cl">PDF</span></h3>
   <p>
        با PDF های آموزشی تایم‌پال، در زمان و هزینه خود صرفه جویی کنید

   </p>
</div>
</div>
</div>

<div class="row justify-content-center" >

@foreach($products as $product)
<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12" >
<div class="prd_grid_box" >
    <div class="prd_label new">جدید</div>
    @if(auth()->check())
    <div class="shd_142">

        <div class="prt_saveed_12lk">
            @php

                $isChecked = \App\Models\Favorite::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
            @endphp
            <label class="toggler toggler-danger">
                <input  type="checkbox"
                       wire:click.debounce.500ms="addFavorite({{ $product->id }}, $event.target.checked)"
                       @if($isChecked) checked @endif
                />

                <i class="fas fa-heart"></i></label>
        </div>
    </div>
    @endif
    <div class="prd_grid_thumb">
        <a wire:navigate href="product-detail.html">

            <img src="{{ asset($product->images->first()->file_path ?? '') }}" class="img-fluid" alt="{{ $product->name }}" style="height:250px;width:100%;border-radius:5px"/>

        </a>

    </div>
    <div class="prd_grid_caption">
        <div class="prd_center_capt">
            <div class="prd_review">
                <i class="fa fa-star filled"></i>
                <i class="fa fa-star filled"></i>
                <i class="fa fa-star filled"></i>
                <i class="fa fa-star filled"></i>
                <i class="fa fa-star"></i>
                <span>(34)</span>
            </div>
            <a wire:navigate href="#" class="prd_title"><h4>{{ $product->name }}</h4></a>
            <div class="prd_price_info">
                <h5 class="org_prc">
                    @if($product->discount > 0)    <span class="old_prc">{{ number_format(round($product->types->first()->price)) }}</span> @endif

                    {{ number_format(round($product->types->first()->price - ( $product->types->first()->price * $product->discount / 100)))  }}

                </h5>
            </div>
        </div>
        <div class="prd_bot_capt">
            <div class="prd_button">
                @php
                    $existsCart = \App\Models\Cart::where('user_id',auth()->id())->where('product_id',$product->id)->exists();
                     $firstTypeId = $product->types->first()->id;
                @endphp
                @if(!$existsCart)
                <a   class="bth bth_prd" wire:click.debounce.300ms="addCart({{ $product->id }},{{ $firstTypeId }})">افزودن به سبد

                </a>
                @else
                    <a   class="bth bth_prd_red" wire:click.debounce.300ms="removeCart({{ $product->id }},{{ $firstTypeId }})"> حذف از سبد</a>
                @endif
            </div>
        </div>




    </div>
</div>
</div>
@endforeach

</div>

</div>
</section>
