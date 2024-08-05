<div wire:ignore class="modal fade" id="signup-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered p-2 my-0 mx-auto" style="max-width: 950px;">
        <div class="modal-content">
            <div class="modal-body px-0 py-2 py-sm-0">
                <button class="btn-close position-absolute top-0 end-0 mt-3 me-3" type="button"
                        data-bs-dismiss="modal"></button>
                <div class="row mx-0 align-items-center">
                    <div class="d-none d-md-block col-md-6 border-end-md p-4 p-sm-5">
                        <h2 class="h3 mb-4 mb-sm-5">در سایت ما با اطمینان ثبت نام کنید.</h2>
                        <ul class="list-unstyled mb-4 mb-sm-5">
                            <li class="d-flex mb-2"><i class="fi-check-circle text-primary mt-1 me-2"></i><span>مدیریت پروژه های آسانسوری</span>
                            </li>
                            <li class="d-flex mb-2"><i class="fi-check-circle text-primary mt-1 me-2"></i><span>پیدا کردن مجری های متخصص</span>
                            </li>
                            <li class="d-flex mb-0"><i
                                    class="fi-check-circle text-primary mt-1 me-2"></i><span>خرید قطعات آسانسور</span></li>
                        </ul>
                        <img class="d-block mx-auto" src="{{ asset('assets/img/signin-modal/signup.svg') }}" width="344"
                             alt="Illustartion">

                    </div>
                    <div class="col-md-6 px-4 pt-1 pb-4 px-sm-5 pb-sm-5 pt-md-2">

                        <form wire:submit="register" class="needs-validation" novalidate>


                            <div class="mb-4">
                                <label class="form-label" for="signup-name"> نام </label>
                                <input wire:model="name" class="form-control" type="text" id="signup-name" placeholder="نام" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="signup-last_name"> نام خانوادگی </label>
                                <input wire:model="last_name" class="form-control" type="text" id="signup-last_name" placeholder="نام خانوادگی" required>
                            </div>


                            <div class="mb-4">
                                <label class="form-label" for="signup-email">شماره تلفن </label>
                                <input wire:model="phone" class="form-control" type="number" id="signup-phone" placeholder="شماره تلفن همراه" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="signup-password">رمز عبور <span class='fs-sm text-muted'>حداقل 8 کاراکتر</span></label>
                                <div class="password-toggle">
                                    <input wire:model="password" class="form-control" type="password" id="signup-password" minlength="8"
                                           required>
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input  class="password-toggle-check" type="checkbox"><span
                                            class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input wire:model="agreement" class="form-check-input" type="checkbox" id="agree-to-terms" required>
                                <label class="form-check-label" for="agree-to-terms"> با ثبت نام در این سایت <a
                                        href='#'> شرایط</a> و <a href='#'>قوانین </a> سایت را قبول دارم.</label>
                            </div>
                            <button onclick="removeDisable()" class="btn btn-primary btn-lg w-100" type="submit">ثبت نام</button>
                        </form>

                        <div class=" mt-4">
                            <label CLASS="form-label">کد یکبار مصرف</label>
                            <input disabled wire:model.live.debounce.1550ms="tempcode" id ="tmp_code" class="form-control border-primary" type="number" placeholder="کد ارسال شده به تلفن همراه" maxlength="4">

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<script>
   function removeDisable()
   {
       var inputElement = document.getElementById('tmp_code');
       var sendSmsBtn = document.getElementById('sendSmsBtn');

       inputElement.removeAttribute('disabled');
       //sendSmsBtn.setAttribute('disabled', ''
   }
</script>





