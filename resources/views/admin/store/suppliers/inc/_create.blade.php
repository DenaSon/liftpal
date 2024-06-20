<!-- Top modal content -->
<div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-top">
        <div class="modal-content modal-scrollbar-measure">
            <div class="modal-header">
                <h4 class="modal-title" id="topModalLabel"> افزودن تامین کننده جدید </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('supplier.store') }}">

            <div class="modal-body">


                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="name"> عنوان </label>
                        <input maxlength="100"  type="text" class="form-control" id="name" name="name" placeholder="عنوان یا برند تامین کننده">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="person_name"> نام شخص </label>
                        <input maxlength="100" type="text" class="form-control" id="person_name" name="person_name" placeholder="نام شخصی تامین کننده">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone"> شماره تلفن </label>
                        <input maxlength="11"   type="text" class="form-control" id="phone" name="phone" placeholder="شماره تماس تامین کننده">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email"> ایمیل </label>
                        <input maxlength="100"  type="email" class="form-control" id="email" name="email" placeholder="ایمیل">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="website"> وبسایت </label>
                        <input maxlength="100"  type="url" class="form-control" id="website" name="website" placeholder="آدرس سایت">
                    </div>

                <div class="mb-3">
                    <label class="form-label" for="address"> آدرس </label>
                    <input maxlength="200"   type="text" class="form-control" id="address" name="address" placeholder=" آدرس تامین کننده">
                </div>

                    <div class="mb-3">
                        <label class="form-label" for="license_number"> شماره مجوز </label>
                        <input maxlength="150"  type="text" class="form-control" id="license_number" name="license_number" placeholder="شماره مجوز ">
                    </div>

                <div class="mb-3">
                    <label class="form-label" for="rating"> امتیاز </label>
                    <input maxlength="2"  type="text" class="form-control" id="rating" name="rating" placeholder="امتیاز از 0 تا 20 ">
                </div>



                    <div class="mb-3">
                        <label class="form-label" for="description"> توضیحات  </label>
                        <input maxlength="255" type="text" class="form-control" id="description" name="description" placeholder="جزئیات و توضیحات">
                    </div>






            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">لغو</button>
                <button type="submit" class="btn btn-primary"> ذخیره </button>
            </div>
            </form>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
