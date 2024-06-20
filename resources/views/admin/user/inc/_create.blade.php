<div class="modal fade show" id="custom-modal" tabindex="-1" role="dialog" aria-modal="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    <span class="fe-user-plus text-primary"></span>

                    &nbsp;

                    ایجاد کاربر جدید</h4>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('customers.store') }}" method="post" id="userForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">نام</label>
                        <input value="{{ old('name') }}" type="text" class="form-control" id="name" placeholder="نام کاربر" name='name'>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">نام خانوادگی</label>
                        <input value="{{ old('last_name') }}" name="last_name" type="text" class="form-control" id="last_name" placeholder="نام خانوادگی کاربر">
                    </div>
                    <div class="mb-3">
                        <label for="phone_email" class="form-label">شماره تلفن یا ایمیل</label> <span class="text-danger">*</span>
                        <input value="{{ old('phone_email') }}" name="phone_email" dir="ltr"  required type="text" class="form-control" id="phone_email" placeholder="شماره تلفن یا ایمیل">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label"> کلمه عبور </label> <span class="text-danger">*</span>
                        <input value="{{ old('password') }}" dir="ltr" required name="password" type="text" class="form-control" id="password" placeholder="کلمه عبور (حداقل 8 حرف)" minlength="8">
                    </div>

                    <div class="form-check float-start">
                        <input type="checkbox" class="form-check-input" id="notify" name="notify" value="1">
                        <label class="form-check-label" for="notify">
                           ارسال اعلان به کاربر
                        </label>
                    </div>


                    <div class="text-end">
                        <button id="sendForm" type="submit" class="btn btn-success waves-effect waves-light">ثبت نام کاربر</button>

                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
