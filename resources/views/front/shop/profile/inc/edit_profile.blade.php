<div class="col-lg-9">
    <div class="account-card">
        <div class="account-title">
            <h4> ویرایش پروفایل</h4>
        </div>
        <div class="account-content">
            <div class="invoice-received">


                <div class="account-content">
                    <form action="{{ route('updateProfile') }}" method="post">
                        @csrf
                    <div class="row">

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label">نام</label>
                                <input name="name" class="form-control" type="text" value="{{ $profile->name }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label">نام خانوادگی</label>
                                <input name="last_name" class="form-control" type="text" value="{{ $profile->last_name }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label">ایمیل</label>
                                <input name="email" class="form-control" type="email" value="{{ $profile->user->email }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label">تخصص</label>
                                <select name="expertise" class="form-control">
                                    <option value="پزشک"> پزشک </option>
                                    <option value=" دندان پزشک"> دندان پزشک </option>
                                    <option value="سایر"> سایر </option>
                                </select>

                            </div>
                        </div>

                        <div class="center">
                            <button type="submit" class="btn btn-outline update-btn" > ثبت تغییرات </button>
                        </div>


                    </div>
                    </form>



                </div>



                </div>



                <!-- list here -->



            </div>
        </div>
    </div>
</div>