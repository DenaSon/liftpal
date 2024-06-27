<div>
    @include('livewire.front.home-inc.header')


    <!-- Page content-->
    <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
        <!-- Breadcrumb-->
        <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('panel') }}">حساب کاربری</a></li>
                <li class="breadcrumb-item active" aria-current="page">اطلاعات حساب کاربری</li>
            </ol>
        </nav>
        <!-- Page content-->
        <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
                <!-- Account nav-->
                <div class="card card-body border-0 shadow-sm pb-1 me-lg-1">
                    <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4"><img class="rounded-circle" src="img/avatars/03.jpg" width="48" alt="">
                        <div class="pt-md-2 pt-lg-0 ps-3 ps-md-0 ps-lg-3">
                            <h2 class="fs-lg mb-0">آنت بلک</h2><span class="star-rating"><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i
                                    class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i></span>
                            <ul class="list-unstyled fs-sm mt-3 mb-0">
                                <li><a class="nav-link fw-normal p-0" href="tel:3025550107"><i class="fi-phone opacity-60 me-2"></i>(302) 555-0107</a></li>
                                <li><a class="nav-link fw-normal p-0" href="mailto:annette_black@email.com"><i class="fi-mail opacity-60 me-2"></i>annette_black@email.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <a class="btn btn-primary btn-lg w-100 mb-3" href="real-estate-add-property.html"><i class="fi-plus me-2"></i> ثبت ملک</a><a class="btn btn-outline-secondary d-block d-md-none w-100 mb-3" href="#account-nav"
                                                                                                                                                 data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>منو</a>
                    <div class="collapse d-md-block mt-3" id="account-nav">
                        <div class="card-nav"><a class="card-nav-link active" href="real-estate-account-info.html"><i class="fi-user opacity-60 me-2"></i>اطلاعات حساب کاربری</a><a class="card-nav-link" href="real-estate-account-security.html"><i
                                    class="fi-lock opacity-60 me-2"></i>گذرواژه و امنیتی</a><a class="card-nav-link" href="real-estate-account-properties.html"><i class="fi-home opacity-60 me-2"></i>املاک من</a><a class="card-nav-link"
                                                                                                                                                                                                                      href="real-estate-account-wishlist.html"><i
                                    class="fi-heart opacity-60 me-2"></i>موردعلاقه ها</a><a class="card-nav-link" href="real-estate-account-reviews.html"><i class="fi-star opacity-60 me-2"></i>نظرات</a><a class="card-nav-link"
                                                                                                                                                                                                             href="real-estate-account-notifications.html"><i
                                    class="fi-bell opacity-60 me-2"></i>اطلاعیه ها</a><a class="card-nav-link" href="real-estate-help-center.html"><i class="fi-help opacity-60 me-2"></i>پشتیبانی</a><a class="card-nav-link" href="#"><i
                                    class="fi-logout opacity-60 me-2"></i>خروج</a></div>
                    </div>
                </div>
            </aside>
            <!-- Content-->
            <div class="col-lg-8 col-md-7 mb-5 account">
                <h1 class="h2">اطلاعات حساب کاربری</h1>
                <div class="mb-2 pt-1">50% از اطلاعات حساب کاربری شما تکمیل شده است.</div>
                <div class="progress mb-4" style="height: .25rem;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <label class="form-label pt-2" for="account-bio">توضیح مختصر</label>
                <div class="row pb-2">
                    <div class="col-lg-9 col-sm-8 mb-4">
                        <textarea class="form-control" id="account-bio" rows="6" placeholder="بیوگرافی خود را اینجا بنویسید"></textarea>
                    </div>
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <input class="file-uploader bg-secondary" type="file" accept="image/png, image/jpeg"
                               data-label-idle="&lt;i class=&quot;d-inline-block fi-camera-plus fs-2 text-muted mb-2&quot;&gt;&lt;/i&gt;&lt;br&gt;&lt;span class=&quot;fw-bold&quot;&gt; تغییر تصویر پروفایل&lt;/span&gt;"
                               data-style-panel-layout="compact" data-image-preview-height="160" data-image-crop-aspect-ratio="1:1" data-image-resize-target-width="200" data-image-resize-target-height="200">
                    </div>
                </div>
                <div class="border rounded-3 p-3 mb-4" id="personal-info">
                    <!-- Name-->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="ps-2">
                                <label class="form-label fw-bold">نام کامل</label>
                                <div id="name-value">آنت بلک</div>
                            </div>
                            <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0" href="#name-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
                        </div>
                        <div class="collapse" id="name-collapse" data-bs-parent="#personal-info">
                            <input class="form-control mt-3" type="text" data-bs-binded-element="#name-value" data-bs-unset-value="Not specified" value="Annette Black">
                        </div>
                    </div>
                    <!-- Email-->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="ps-2">
                                <label class="form-label fw-bold">پست الکترونیکی</label>
                                <div id="email-value">annette_black@email.com</div>
                            </div>
                            <div class="me-n3" data-bs-toggle="tooltip" title="ویرایش"><a class="nav-link py-0" href="#email-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
                        </div>
                        <div class="collapse" id="email-collapse" data-bs-parent="#personal-info">
                            <input class="form-control mt-3" type="email" data-bs-binded-element="#email-value" data-bs-unset-value="Not specified" value="annette_black@email.com">
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
                            <input class="form-control mt-3" type="text" data-bs-binded-element="#phone-value" data-bs-unset-value="Not specified" value="(302) 555-0107">
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
                            <input class="form-control mt-3" type="text" data-bs-binded-element="#company-value" data-bs-unset-value="Not specified" placeholder="Enter company name">
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
                            <input class="form-control mt-3" type="text" data-bs-binded-element="#address-value" data-bs-unset-value="Not specified" placeholder="Enter address">
                        </div>
                    </div>
                </div>
                <!-- Socials-->
                <div class="pt-2">
                    <label class="form-label fw-bold mb-3">شبکه های اجتماعی</label>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-facebook text-body"></i></div>
                    <input class="form-control" type="text" placeholder="اکانت فیسبوک">
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-linkedin text-body"></i></div>
                    <input class="form-control" type="text" placeholder="اکانت لینکدین">
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
                <a class="collapse-label collapsed d-inline-block fs-sm fw-bold text-decoration-none pt-2 pb-3" href="#showMoreSocials" data-bs-toggle="collapse" data-bs-label-collapsed="مشاهده بیشتر" data-bs-label-expanded="بستن" role="button"
                   aria-expanded="false" aria-controls="showMoreSocials"><i class="fi-arrow-down me-2"></i></a>
                <div class="d-flex align-items-center justify-content-between border-top mt-4 pt-4 pb-1">
                    <button class="btn btn-primary px-3 px-sm-4" type="button">ذخیره تغییرات</button>
                    <button class="btn btn-link btn-sm px-0" type="button"><i class="fi-trash me-2"></i>حذف اکانت</button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <!-- ============================ map End ================================== -->


    @include('livewire.front.home-inc.footer')


    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts/>
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script data-navigate-once
                src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once
                src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
        <!-- Main theme script-->
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>

    @endsection


</div>
