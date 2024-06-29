<div>
    <label class="form-label pt-2 text-muted fs-xs" for="account-bio">توضیح مختصر</label>
    <div class="row pb-2">
        <div class="col-lg-12 col-sm-12 mb-4">
            <textarea wire:model="resume" class="form-control fs-sm" id="account-bio" rows="3" placeholder="بیوگرافی خود را اینجا بنویسید"></textarea>
        </div>

    </div>
    <div class="border rounded-3 p-3 mb-4" id="personal-info">
        <!-- Name-->
        <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="ps-2">
                    <label class="form-label fw-bold">نام </label>
                    <div id="name-value">{{ $authUserProfile?->name }}</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0" href="#name-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="name-collapse" data-bs-parent="#personal-info">
                <input class="form-control mt-3" type="text" data-bs-binded-element="#name-value" data-bs-unset-value="ثبت نشده" wire:model="name" placeholder="نام خود را وارد کنید">
            </div>
        </div>
        <!-- Last Name-->
        <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="ps-2">
                    <label class="form-label fw-bold">نام خانوادگی</label>
                    <div id="lastName-value"> {{ $authUserProfile?->last_name }} </div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0" href="#lastName-collapse" data-bs-toggle="collapse">
                        <i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="lastName-collapse" data-bs-parent="#personal-info">
                <input placeholder="نام خانوادگی خود را وارد کنید" class="form-control mt-3" type="text" data-bs-binded-element="#last-name-value" data-bs-unset-value="ثبت نشده"
                       wire:model="last_name">
            </div>
        </div>
        <!-- Email-->
        <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="ps-2">
                    <label class="form-label fw-bold">پست الکترونیکی</label>
                    <div id="email-value">{{ $authUser?->email }}</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0" href="#email-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="email-collapse" data-bs-parent="#personal-info">
                <input wire:model="email" placeholder="ایمیل خود را وارد کنید" class="form-control mt-3" type="email" data-bs-binded-element="#email-value" data-bs-unset-value="ثبت نشده"
                       value="annette_black@email
                .com">
            </div>
        </div>
        <!-- Phone number-->
        <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="ps-2">
                    <label class="form-label fw-bold">شماره تماس</label>
                    <div id="phone-value">(302) 555-0107</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0" href="#phone-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="phone-collapse" data-bs-parent="#personal-info">
                <input class="form-control mt-3" type="text" data-bs-binded-element="#phone-value" data-bs-unset-value="ثبت نشده" value="(302) 555-0107">
            </div>
        </div>
        <!-- Company name-->
        <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="ps-2">
                    <label class="form-label fw-bold">نام شرکت</label>
                    <div id="company-value">مشخص نشده است</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0" href="#company-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="company-collapse" data-bs-parent="#personal-info">
                <input class="form-control mt-3" type="text" data-bs-binded-element="#company-value" data-bs-unset-value="ثبت نشده" placeholder="Enter company name">
            </div>
        </div>
        <!-- Address-->
        <div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="ps-2">
                    <label class="form-label fw-bold">آدرس</label>
                    <div id="address-value">مشخص نشده است</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0" href="#address-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="address-collapse" data-bs-parent="#personal-info">
                <input class="form-control mt-3" type="text" data-bs-binded-element="#address-value" data-bs-unset-value="ثبت نشده" placeholder="Enter address">
            </div>
        </div>
    </div>
    <!-- Socials-->
    <div class="pt-2">
        <label class="form-label fw-bold mb-3">شبکه های اجتماعی</label>
    </div>


    <div class="d-flex align-items-center mb-3">
        <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-twitter text-body"></i></div>
        <input class="form-control" type="text" placeholder="اکانت توییتر">
    </div>
    <div class="collapse" id="showMoreSocials">
        <div class="d-flex align-items-center mb-3">
            <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-instagram text-body"></i></div>
            <input class="form-control" type="text" placeholder="اکانت اینستاگرام">
        </div>
        <div class="d-flex align-items-center mb-3">
            <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-pinterest text-body"></i></div>
            <input class="form-control" type="text" placeholder="اکانت پینترست">
        </div>
    </div>
    <a class="collapse-label collapsed d-inline-block fs-sm fw-bold text-decoration-none pt-2 pb-3" href="#showMoreSocials" data-bs-toggle="collapse" data-bs-label-collapsed="مشاهده بیشتر"
       data-bs-label-expanded="بستن" role="button"
       aria-expanded="false" aria-controls="showMoreSocials"><i class="fi-arrow-down me-2"></i></a>
    <div class="d-flex align-items-center justify-content-between border-top mt-4 pt-4 pb-1">
        <button class="btn btn-primary px-3 px-sm-4" type="button">ذخیره تغییرات</button>
        <button wire:click="hello" class="btn btn-link btn-sm px-0" type="button"><i class="fi-trash me-2"></i>حذف اکانت</button>
    </div>

</div>
