<div class="modal fade show" id="custom-modal" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    <span class="fe-user-plus text-primary"></span>

                    &nbsp;

                    افزودن خطا  </h4>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('eed.store') }}" method="post" id="eedForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">کد خطا</label>
                        <input value="{{ old('code') }}" type="text" class="form-control" id="code" placeholder="کد خطا" name='code'>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">نوع تابلو</label>

                       <input name="type" id="type" class="form-control">

                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">توضیحات</label> <span class="text-danger">*</span>
                        <textarea rows="4" name="description" dir="rtl" required class="form-control" id="description" placeholder="توضیحات خطا">{{ old('description')
                        }}</textarea>

                    </div>



                    <div class="text-end">
                        <button id="sendForm" type="submit" class="btn btn-success waves-effect waves-light">ثبت </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
