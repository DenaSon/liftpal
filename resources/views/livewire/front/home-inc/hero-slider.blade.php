@php
    $slider = \App\Models\Slider::with('images')?->whereCaption('hero-slider')?->first();
@endphp
@if($slider->images->count() > 0)
<div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush" dir="ltr">
    <div class="tns-carousel-inner"
         data-carousel-options='{

        "items": 1,
        "controls": true,
        "autoplay": false,
        "autoplayTimeout": 6500,
        "swipeAngle": false,
        "speed": 4500,
        "arrowKeys": true,
        "loop": true,
        "responsive": {
            "0": {"items": 1},
            "768": {"items": 1},
            "1024": {"items": 1}
        }
    }'>





        @if($slider && $slider?->images)
            @foreach($slider->images as $image)
                <div class="col mx-2 position-relative" style="height: 400px;">
                    <img src="{{ asset($image->file_path) }}" class="rounded" alt="" style="height: 100%; width: 100%; object-fit: cover;">

                    <div class="menu-overlay bg-dark bg-opacity-50 text-white rounded p-3 position-absolute bottom-0 w-100">
                        <p class="text-center fs-sm">
                            آیا آماده‌اید تا تجربه‌ای جدید از مدیریت آسانسورهای ساختمان خود داشته باشید؟ سامانه آنلاین ما، یک پلتفرم هوشمند، جامع است که تمامی نیازهای شما را پوشش می‌دهد.
                        </p>
                        <div class="d-flex justify-content-center">
                            <a wire:navigate href="{{ $image->link }}" class="btn btn-sm btn-outline-light w-25">جستجو</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
        @endif



    </div>


</div>

@endif
