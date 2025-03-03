<div>
    <form wire:submit.debounce.1000ms="updateProfileInfo">

        @can('technician')
            <label class="form-label pt-2 text-muted fs-xs" for="account-bio">توضیح مختصر بیوگرافی</label>
        @endcan

        <div class="row pb-2">
            @can('technician')
                <div class="col-lg-12 col-sm-12 mb-4">
                    <textarea wire:model="resume" class="form-control fs-sm text-justify" id="account-bio" rows="2"
                              placeholder="{{ $resume ?? 'معرفی کوتاه...' }}"></textarea>
                </div>
            @endcan

        </div>
        <div class="border rounded-3 p-3 mb-4" id="personal-info">
            <!-- Name-->
            <div class="border-bottom pb-3 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="ps-2">
                        <label class="form-label fw-bold">نام </label>
                        <div id="name-value">{{ $name }}</div>
                    </div>
                    <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0"
                                                                                  href="#name-collapse"
                                                                                  data-bs-toggle="collapse"><i
                                class="fi-edit"></i></a></div>
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
                        <div id="lastName-value"> {{ $last_name }} </div>
                    </div>
                    <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0"
                                                                                  href="#lastName-collapse"
                                                                                  data-bs-toggle="collapse">
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
                        <div id="email-value">{{ $email }}</div>
                    </div>
                    <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0"
                                                                                  href="#email-collapse"
                                                                                  data-bs-toggle="collapse"><i
                                class="fi-edit"></i></a></div>
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
            @can('technician')
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="ps-2">
                            <label class="form-label fw-bold">تحصیلات</label>
                            <div id="education-value">
                                <div>
                                    {{ $education ?? 'مشخص نشده' }}
                                </div>

                            </div>
                        </div>
                        <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش">
                            <a class="nav-link py-0" href="#education-collapse" data-bs-toggle="collapse"><i
                                    class="fi-edit"></i></a></div>
                    </div>
                    <div class="collapse" id="education-collapse" data-bs-parent="#personal-info">
                        <select class="form-select" wire:model="education">
                            <option value="" disabled selected>انتخاب مقطع تحصیلی</option>
                            <option value="دیپلم">دیپلم</option>
                            <option value="کاردانی">کاردانی</option>
                            <option value="کارشناسی">کارشناسی</option>
                            <option value="کارشناسی ارشد">کارشناسی ارشد</option>
                            <option value="دکتری">دکتری</option>
                        </select>
                    </div>
                </div>
            @endcan


            <div class="d-flex align-items-center justify-content-center mt-4 pt-4 pb-1">
                <button class="btn btn-primary px-3 px-sm-4" type="submit">
                    <i class="fi-checkbox-checked-alt me-2"></i>
                    ذخیره پروفایل
                </button>

            </div>

        </div>

    </form>

    <!-- skills-->
    @can('technician')
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
            </div>

            <div class="container mt-3">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-12 col-md-10 mb-3 mb-md-0 d-flex justify-content-center justify-content-md-start">

                        <select wire:model="skill" class="form-select">
                            @foreach(\App\Models\Skill::all() as $skill_list)

                                <option value="{{ $skill_list->id }}"
                                        wire:key="{{ $skill_list->id }}">{{ $skill_list->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-12 col-md-2 text-center">
                        <div class="mamad mt-3 mt-md-0">
                            <button class="btn btn-success btn-xs" wire:click="saveSkill">
                                <i class="fi-plus-circle me-1 fs-sm"></i>
                                افزودن
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row container mt-3 collapse" id="showMoreSkill">


                <!-- List group with icons and badges -->
                <ul class="list-group">
                    @foreach(auth()->user()->skills as $index =>$skill)
                        <li wire:key="{{$skill->id}}"
                            class="list-group-item d-flex justify-content-between align-items-center  ">
        <span>
        <i class="fi-star-filled text-success me-2"></i>
        <span>  {{ $index + 1 }} <i class="fi-minus fw-normal fs-sm"></i> </span>
        {{ $skill->name }}
        </span>
                            <a href="javascript:void(0)" class="" wire:click="skillDelete({{$skill->id}})">
                                <i class=" btn-xs fi fi-trash"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
            @if(auth()->user()->skills->count() > 0 )
                <div class="container mt-2">
                    <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start">

                        <a class="collapse-label collapsed d-inline-block fs-md fw-bold text-success text-decoration-none  pt-2 pb-3 mx-auto mx-md-0 ms-md-2"
                           href="#showMoreSkill" data-bs-toggle="collapse"
                           data-bs-label-collapsed="مشاهده مهارت‌ها"
                           data-bs-label-expanded="" role="button"
                           aria-expanded="false" aria-controls="showMoreSkill">

                        </a>
                    </div>
                </div>
            @endif
        </div>
    @endcan

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            $wire.on('showCollapse', () => {

                document.getElementById('showMoreSkill').classList.add('show');
                document.getElementById('showMoreSkill').classList.remove('collapse');
            });
        });
    </script>

</div>



