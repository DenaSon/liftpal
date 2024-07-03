<div>
<form wire:submit.prevent="updateProfileInfo">

<label class="form-label pt-2 text-muted fs-xs" for="account-bio">توضیح مختصر بیوگرافی</label>
<div class="row pb-2">
    <div class="col-lg-12 col-sm-12 mb-4">
    <textarea wire:model="resume" class="form-control fs-sm text-justify" id="account-bio" rows="3" placeholder="معرفی کوتاه از خود،شامل تخصص و مهارت ها،مدارک تحصیلی و...
    "></textarea>
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
            <input class="form-control mt-3" type="text"
                   data-bs-binded-element="#name-value"
                   data-bs-unset-value="ثبت نشده"
                   wire:model="name"
                   placeholder="نام خود را وارد کنید">

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
        <div class="collapse" id="lastName-collapse"
             data-bs-parent="#personal-info">
            <input placeholder="نام خانوادگی خود را وارد کنید" class="form-control mt-3"
                   type="text"
                   data-bs-binded-element="#last-name-value"
                   data-bs-unset-value="ثبت نشده"
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
            <input wire:model="email"
                   placeholder="ایمیل خود را وارد کنید"
                   class="form-control mt-3"
                   type="email"
                   data-bs-binded-element="#email-value"
                   data-bs-unset-value="ثبت نشده">
        </div>
    </div>

    <!-- Company name-->
    <div class="border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="ps-2">
                <label class="form-label fw-bold">تحصیلات</label>
                <div id="education-value">مشخص نشده است</div>
            </div>
            <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش">
                <a class="nav-link py-0" href="#education-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
        </div>
        <div class="collapse" id="education-collapse" data-bs-parent="#personal-info">
            <input wire:model="education" class="form-control mt-3" type="text" data-bs-binded-element="#education-value" data-bs-unset-value="ثبت نشده" placeholder="تحصیلات خود را وارد کنید">
        </div>
    </div>


    <div class="d-flex align-items-center justify-content-center mt-4 pt-4 pb-1">
        <button class="btn btn-primary px-3 px-sm-4" type="submit">ذخیره پروفایل</button>
        <!-- <button class="btn btn-link btn-sm px-0" type="button"><i class="fi-trash me-2"></i>حذف اکانت</button> -->
    </div>

</div>

</form>

    <!-- skills-->
    <div class="border rounded shadow-sm p-4">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-md-6 d-flex justify-content-center">
                    <div class=" ps-2 text-center">
                        <label class="form-label fw-bold">افزودن مهارت ها</label>
                        <div id="skill-value">{{ auth()->user()->skills->count() }} مهارت ثبت شده</div>
                    </div>
                </div>
            </div>
            <div class="position-absolute top-0 end-0 d-none d-md-block  me-0" data-bs-toggle="tooltip" title="ویرایش">
                <a class="nav-link py-0" href="#skill-collapse" data-bs-toggle="collapse">
                    <i class="fi-dots-vertical text-warning"></i>
                </a>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-12 col-md-10 mb-3 mb-md-0 d-flex justify-content-center justify-content-md-start">

                        <select wire:model="skill" class="form-select">
                            @foreach(\App\Models\Skill::all() as $skill_list)
                                <option value="{{ $skill_list->id }}" wire:key="{{ $skill_list->id }}">{{ $skill_list->name }}</option>
                            @endforeach
                        </select>

                </div>
                <div class="col-12 col-md-2 text-center">
                    <div class="mamad mt-4 mt-md-0">
                        <button class="btn btn-warning btn-xs" wire:click="saveSkill">
                            <i class="fi-plus-circle me-1 fs-sm"></i>
                            افزودن
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container mt-3 ">
            <div class="collapse" id="showMoreSkill">

        </div>


        <!-- List group with icons and badges -->
        <ul class="list-group">
            @foreach(auth()->user()->skills as $skill)
                <li wire:key="{{$skill->id}}" class="list-group-item d-flex justify-content-between align-items-center">
        <span>
        <i class="fi-star text-warning me-2"></i>
       {{ $skill->name }}
        </span>
                    <a href="javascript:void(0)" class="" wire:click="skillDelete({{$skill->id}})">
                        <i class=" btn-xs fi fi-trash"></i>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
    <a class="collapse-label collapsed d-inline-block ms-md-2 fs-md fw-bold text-decoration-none pt-2 pb-3" href="#showMoreSkill" data-bs-toggle="collapse"
       data-bs-label-collapsed="مشاهده مهارت‌ها "
       data-bs-label-expanded="بستن" role="button"
       aria-expanded="false" aria-controls="showMoreSocials"><i class="fi-arrow-down me-2"></i></a>
</div>

    </div>

</div>
