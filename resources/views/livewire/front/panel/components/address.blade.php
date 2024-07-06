<div>

<div class="container d-flex justify-content-center justify-content-md-end mt-3">
    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#get-new-address-modal">
        <i class="fi-map-pin me-2"></i> ثبت ادرس جدید
    </button>
</div>

    <div class="modal fade" id="get-new-address-modal" aria-hidden="true" aria-labelledby="get-address-modalLabel" tabindex="-1" wire:ignore>
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 " id="get-address-modalLabel">ثبت آدرس جدید</h1>
                    <button type="button" class="btn-close me-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveAddress">
                        <div class="row align-items-center">
                            <div class="col-6 mb-3">
                                <label for="province" class="form-label ">استان</label>
                                <span class="text-danger">*</span>
                                <select class="form-select " wire:model="province" >
                                    <optgroup selected disabled value="" label="انتخاب استان">انتخاب استان</optgroup>
                                    @include('livewire.front.cart.inc.province')
                                </select>

                            </div>

                            <div class="col-6 mb-3">
                                <label for="city" class="form-label ">شهر</label>
                                <span class="text-danger">*</span>
                                <input class="form-control" id="city" wire:model="city" placeholder="نام شهر">

                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="postal-address" class="form-label ">آدرس پستی</label>
                            <span class="text-danger">*</span>
                            <textarea placeholder="محله،خیابان،کوچه..." wire:model="postal_address" class="form-control" id="postal-address" rows="3"></textarea>

                        </div>

                        <div class="row align-items-center">

                            <div class="col-4 mb-3">
                                <label for="postal-code" class="form-label ">کد پستی</label>
                                <span class="text-danger">*</span>
                                <input wire:model="postal_code" type="number" class="form-control no-spinner" id="postal-code" placeholder="کد 10 رقمی">

                            </div>

                            <div class="col-4 mb-3">
                                <label for="building-number" class="form-label">پلاک</label>
                                <input wire:model="building_number" type="number" class="form-control no-spinner" id="building-number" placeholder="اختیاری">

                            </div>

                            <div class="col-4 mb-3">
                                <label for="unit-number" class="form-label">شماره واحد</label>
                                <input wire:model="unit_number" type="number" class="form-control no-spinner" id="unit-number" placeholder="اختیاری">

                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-4"  >

                            <button type="submit" class="btn btn-primary ">ثبت آدرس</button>

                        </div>

                    </form>


                </div>
            </div>
        </div>


    </div>

    <!-- Simple list group inside card -->
    <div class="card shadow-lg mt-3">
        <div class="card-body d-flex justify-content-between">
            <p class="card-text fs-sm text-muted">سیسخت...خیابان مطهری</p>

            <div class="dropend ">
                <a class=" fi-dots-vertical dropdown-toggle dropdown-toggle-addressbtnedit" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="fi-dots-vertical"></i> </a>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item " href="#"><i class="fi-edit me-2 text-primary"></i>ویرایش آدرس</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fi-trash me-2 text-primary"></i>حذف آدرس</a></li>
                </ul>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="fi-user me-2"></i><span>محمد اسدی</span></li>
            <li class="list-group-item"><i class="fi-map-pin me-2"></i><span>سیسخت</span></li>
            <li class="list-group-item"><i class="fi-mail me-2"></i><span>(کد پستی)111111</span></li>
            <li class="list-group-item"><i class="fi-phone me-2"></i><span>شماره تلفن(000000)</span></li>
        </ul>
        <div class="card-body">
            <a href="#" class="btn btn-sm btn-success text-center"><i class="fi-plus me-2"></i>افزودن به پیش فرض</a>
        </div>
    </div>

    <!-- Actionable list group inside card -->
    <div class="card shadow-lg mt-3">
        <div class="card-body d-flex justify-content-between">
            <p class="card-text fs-sm text-muted">یاسوج...کوی مخابرات</p>

            <div class="dropend">
                <a class=" fi-dots-vertical dropdown-toggle dropdown-toggle-addressbtnedit" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fi-dots-vertical"></i> </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="#"><i class="fi-edit me-2 text-primary"></i>ویرایش آدرس</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fi-trash me-2 text-primary"></i>حذف آدرس</a></li>
                </ul>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="fi-user me-2"></i><span>میلاد اسدپور</span></li>
            <li class="list-group-item"><i class="fi-map-pin me-2"></i><span>یاسوج</span></li>
            <li class="list-group-item"><i class="fi-mail me-2"></i><span>(کد پستی)111111</span></li>
            <li class="list-group-item"><i class="fi-phone me-2"></i><span>شماره تلفن(000000)</span></li>
        </ul>
        <div class="card-body  d-flex justify-content-center justify-content-md-end">
            <a href="#" class="btn btn-sm btn-success"><i class="fi-plus me-2"></i>افزودن به پیش فرض</a>
        </div>
    </div>
</div>
