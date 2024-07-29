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

            <div class="milad alert alert-info mt-2 text-center overflow-auto mx-2 scrollable-alert-eed" role="alert">
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
        <div class="col-12 d-flex align-items-center justify-content-center mt-0 pt-0">
            <img class="d-md-block pt-0 pb-4"
                 src="{{ asset('assets/img/inspect-eed.png') }}" alt="SEARCH" style="opacity: 0.2; position:absolute" id="inspect-image">


        </div>

    </div>


    <!-- Accent alert -->
    <div class=" alert alert-primary opacity-75" role="alert" id="eed-alert">

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        <hr>
        <p class="pt-1 text-justify">
            با سیستم خطایاب EED، تکنسین‌ها می‌توانند زمان خرابی را کاهش داده و عملکرد بهینه و ایمن آسانسورها را تضمین کنند. EED یک ابزار ضروری برای هر تیم پشتیبانی آسانسور است
            که به دنبال بهبود کارایی و کیفیت خدمات خود هستند.

        </p>


    </div>


</div>

@script
<script>
    // Listen for the Livewire event
    $wire.on('remove-alert', () => {
        // Find the alert element
        var alertElement = document.getElementById('eed-alert');
        alertElement.style.display = "none";
        alert("dena");

    });
</script>
@endscript
