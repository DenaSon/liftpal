<div class="row">

<div class="account-title">
<h4>آدرس ارسال</h4>
    @if($addresses->count() >  0 )
<a href="{{ route('checkout/cart',['level' => 'add_address']) }}" >افزودن آدرس جدید</a>
    @endif
</div>


       @if(request()->query('level') === 'add_address' || count($addresses) == 0)
        <div class="container mt-2">
            <form action = "{{ route('registerAddress') }}" method="post">
         @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="province">استان</label> <span class="text-danger">*</span>
                    <select required class="form-control form-select" id="province" name="province">
                        <option value="" disabled selected>انتخاب استان</option>

                 @include('front.shop.checkout.inc._province')
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="city">شهر</label> <span class="text-danger">*</span>
                    <input required class="form-control" name="city" id="city" placeholder="نام شهر">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="postal_address">آدرس پستی</label> <span class="text-danger">*</span>
                   <textarea   required cols="10" name="postal_address" id="postal_address" class="form-control" placeholder="آدرس پستی گیرنده"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="postal_code">کد پستی</label>
                    <input type="number" class="form-control" name="postal_code" id="postal_code" placeholder="کد پستی">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="building_number">پلاک </label>
                    <input type="number" class="form-control" name="building_number" id="building_number" placeholder="پلاک ساختمان">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="unit_number">واحد </label>
                    <input type="number" class="form-control" name="unit_number" id="unit_number" placeholder="شماره واحد آپارتمان">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="recipient_name">نام گیرنده </label>
                    <input value="{{ auth()->user()->profile->name ?? '' }} {{ auth()->user()->profile->last_name ?? '' }}" type="text" class="form-control" name="recipient_name" id="recipient_name">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="recipient_phone">شماره تلفن گیرنده</label>
                    <input value="{{ auth()->user()->phone ?? '' }}" type="text" class="form-control" name="recipient_phone" id="recipient_phone">
                </div>

                <button type="submit" class="mt-5 btn btn-outline order-register-button"> ثبت آدرس </button>

            </div>
            </form>
        </div>
    @endif

        </div>


<div class="row">
    @if( request()->query('level') ==='shipping' )
    @foreach($addresses as $address)

        <div class="col-md-6 col-lg-6 alert fade show">

            <div class="profile-card address selected-address @if($address->is_default == 1) active @endif" data-id="{{$address->id}}">

                <h6>{{ $address->province }} - {{ $address->city }}   </h6>
                <p>

                    {{ $address->postal_address }} - پلاک {{ $address->building_number }}- واحد {{ $address->unit_number }}


                </p>
                <small>     کد پستی :  {{ $address->postal_code }}</small>
            </div>
        </div>

        @endforeach
        @if($addresses->count() >  0 )
            <div class="col-12"></div>

            <a href="{{ route('checkout/cart',['level'=>'payment']) }}" class="mt-5 btn btn-outline order-register-button"> <span class="fas fa-check"></span>  &nbsp; تسویه حساب </a>

        @endif
@endif

</div>




