<div wire:ignore class="modal fade" id="signin-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered p-2 my-0 mx-auto" style="max-width: 950px;">
        <div class="modal-content">

            <div class="modal-body px-0 py-2 py-sm-0">
                <button class="btn-close position-absolute top-0 end-0 mt-2 me-3" type="button"
                        data-bs-dismiss="modal"></button>
                <div class="row mx-0 align-items-center">
                    <div class="col-md-6 border-end-md p-4 p-sm-5">
                        <h2 class="d-none d-md-block h3 mb-4 mb-sm-5"><br>ورود به حساب کاربری {{ getSetting('website_title') }}</h2>

                        <img class="d-none d-md-block mx-auto rotate-img" src="{{ asset('assets/img/signin-modal/signin.svg') }}"
                            width="344" alt="Illustartion">

                        <div class="mt-4 mt-sm-5">هنوز ثبت نام نکرده اید؟ <a href="#signup-modal" data-bs-toggle="modal"
                                                                             data-bs-dismiss="modal">ثبت نام</a></div>
                    </div>
                    <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">


                        <form wire:submit="login" class="needs-validation" novalidate>
                            <div class="mb-4">
                                <label class="form-label mb-2" for="signin-email">شماره تلفن </label>
                                <input wire:model="phone" class="form-control" type="number" id="signin-email" min="8"
                                       placeholder="شماره تلفن" required>
                                @error('phone') {{ $message }} @enderror
                            </div>
                            <div class="mb-4">
{{--                                --}}
{{--                                <div class="d-flex align-items-center justify-content-between mb-2">--}}
{{--                                    <label class="form-label mb-0" for="signin-password">کلمه عبور</label><a--}}
{{--                                        class="fs-sm" href="#">کلمه عبور را فراموش کرده اید؟</a>--}}
{{--                                </div>--}}


                                <div class="password-toggle">
                                    <input wire:model="password" class="form-control" type="password"
                                           id="signin-password" placeholder="کلمه عبور خود را وارد کنید" required>
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox"><span
                                            class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-lg w-100" type="submit">ورود به حساب کاربری</button>
                        </form>

                        <div class="d-flex align-items-center py-3 mb-3">
                            <hr class="w-100">
                            <div class="px-3">یـا</div>
                            <hr class="w-100">
                        </div>


                        <button wire:click.throttle.4500ms="verifyPhoneNumber" class="btn btn-outline-info w-100 mb-3"
                                href="#" id="sendSmsBtn">

                            <i class="fi-messenger fs-lg me-1">

                            </i>
                            ورود با کد یکبار مصرف
                        </button>


                        <div class="input-group">

                            <input wire:model.live.debounce.1550ms="tempcode" id="tempcode"
                                   class="form-control border-primary" type="number"
                                   placeholder="کد ارسال شده به تلفن همراه" maxlength="4" hidden="true">

                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <span wire:loading="" class="badge bg-primary">درحال بررسی...</span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('showConfirm', (event) => {
            var inputElement = document.getElementById('tempcode');
            var sendSmsBtn = document.getElementById('sendSmsBtn');

            inputElement.removeAttribute('hidden');

        });

    });
</script>


