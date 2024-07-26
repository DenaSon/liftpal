<div class=" align-items-center justify-content-center row">
    <div class="container mt-3"></div>
    <div class="col-12 card  mb-4 shadow-lg mt-5 ">
        <div class="card-header text-center">
            <i class=" me-2 fi-info-square text-primary"></i>
            <span class="cart-header-text text-primary">
            شناسایی خطاهای آسانسور
        </span>

        </div>
        <div class="card-body">
            <div class="my-2 mb-1" wire:ignore>

                <label for="errorCode" class="form-label text-muted">
                    <i class="fi-search me-2"></i>
                    <span class="fs-xs">جستجو خطا</span>
                </label>
                <select dir="ltr" class="select2-error select2 text-center" wire:model.live.debounce.1s="errorCode" style="width: 100%" id="errorCode">
                    <option value="0" selected>ورودی شماره خطا</option>
                    @foreach($errors as $error)

                        <option value="{{ $error->id }}">{{ $error->code }}</option>
                    @endforeach

                </select>
            </div>

        </div>

        <div class="text-center">
            <div wire:loading class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        @if($this->result)

            <div class="alert alert-info mt-2 text-center overflow-auto mx-2 scrollable-alert-eed" role="alert">
                <h4 class="alert-heading fs-sm">
                    <span class="float-end text-info">      دسته :   {{ $type }} </span>
                    <span class="fs-xs float-start">{{ $errorCode }}</span>
                </h4>
                <div class="clearfix"></div>
                <hr class="mt-1 mb-1 text-info" style="width: 100px"/>

                <p class="text-justify">

                    {{ $result->description ?? '...' }}

                </p>
            </div>

        @endif

    </div>

{{--    <div class="col-12  align-items-center justify-content-center mt-0 pt-0">--}}
{{--        <img class="d-none d-md-flex align-items-center justify-content-center pt-0 "--}}
{{--             src="{{ asset('assets/img/liftpal/Alert-Graphics-for-MW_ALERT-750x450.jpg') }}" alt="Illustration">--}}
{{--    </div>--}}

    <!-- Accent alert -->
    <div class="alert alert-primary" role="alert">
        <h4 class="pt-2 alert-heading">خوش آمدید</h4>
        <p>سیستم EED، راهکاری هوشمند و نوآورانه برای شناسایی و رفع خطاهای آسانسور، به شما این امکان را می‌دهد که با وارد کردن شماره خطای صادر شده از آسانسور، به تفسیر دقیق و روش حل آن دست یابید</p>
        <hr>
        <p class="pt-3 mb-2">لطفا کد خطای آسانسور خود را در فیلد بالا وارد نمایید</p>
    </div>


</div>