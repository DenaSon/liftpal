<div class="mb-4">
    <h2 class="h2 mb-0 mt-3">ماشین حساب مهندسی محاسبات آسانسور</h2>

</div>

<nav class="mb-3 pt-md-2" aria-label="Breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a wire:navigate href="{{ route('calcMain') }}" class="breadcrumb-item active">{{ $page_title }}</a> </li>
    </ol>
</nav>

<!-- Basic info-->
<section class="card card-body border-0 shadow-sm p-4 mb-4 text-center" id="basic-info">

    <h4 class="h5 mb-4"><i class="fi-info-circle text-primary fs-5 mt-n1 me-2"></i>انتخاب نوع محاسبات
    </h4>
    <div class="row">
        <div class="col-sm-12 mb-3  text-center">
            <label class="form-label visually-hidden" for="ap-category"> نوع محاسبات <span
                    class="text-danger">*</span></label>
            <select class="form-select text-center w-100" id="ap-category" required="" wire:model.live="selectedCategory">
             @include('livewire.calc.inc.options')
            </select>
        </div>

    </div>

</section>
<div class="d-flex justify-content-center">
    <button wire:loading type="button" class="btn btn-primary btn-icon">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    </button>
</div>
