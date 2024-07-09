<div class="col-lg-9">
    <div class="account-card">
        <div class="account-title">
            <h4>افزودن حساب بانکی</h4>
        </div>
        <div class="account-content">
            <div class="invoice-received">


                <div class="account-content">
                    <form action="{{ route('updateProfile') }}" method="post">
                        @csrf
                        <div class="row">


                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">نام بانک</label>
                                    <input placeholder="مثال : کشاورزی" required name="bank_name" class="form-control" type="text" value="{{ old('bank_name') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">شماره کارت</label>
                                    <input placeholder="شماره کارت" required name="number" class="form-control" type="text" value="{{  old('cart_number') }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">شماره حساب</label>
                                    <input placeholder="شماره حساب " required name="account_number" class="form-control" type="number" value="{{ old('account_number') }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">شماره شبا</label>
                                    <input placeholder="شماره 24 رقمی شبا بدون IR" required name="sheba_number" class="form-control" type="number" value="{{ old('sheba_number') }}">
                                </div>
                                <input name="account_holder_name" type="hidden" value="{{ \Illuminate\Support\Facades\Auth::user()->profile->name . ' ' . \Illuminate\Support\Facades\Auth::user()->profile->last_name }}">
                            </div>


                            <div class="center">
                                <button type="submit" class="btn btn-outline update-btn" >ذخیره اطلاعات</button>
                            </div>
                            

                        </div>



                    </form>



                </div>



            </div>



            <!-- list here -->



        </div>
        <div class="center">

        </div>
    </div>
</div>
