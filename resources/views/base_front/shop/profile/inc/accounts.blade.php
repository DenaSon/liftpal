<div class="col-lg-9">




    <div class="account-card mb-0">
        <div class="account-title">
            <h4>حساب های بانکی</h4>

            <a href="{{ route('customerProfile',['action'=>'accounts_add']) }}"> افزودن حساب </a>







        </div>
        <div class="account-content">
            <div class="row">
                @if($bank_accounts->count() < 1)
                    <h6>هنوز حساب بانکی ثبت نکرده اید</h6>
                @else

                @foreach($bank_accounts as $account )
                <div class="col-md-6 col-lg-4 alert fade show">
                    <div class="payment-card payment active">

                        <h4> <i class="fas fa-credit-card"> </i> شماره کارت</h4>
                        <p>

                            <sup>{{ $account->card_number }}</sup>
                            <small> {{ $account->sheba_number }}</small>
                        </p>

                        <button class="trash icofont-ui-delete" title="حذف" data-bs-dismiss="alert"></button>
                    </div>

                </div>

                @endforeach

                @endif

                    <small class="text-dark text-sm">شماره حساب های ثبت شده باید حتما به نام شخص دارنده حساب کاربری : {{ auth()->user()->profile->name ?? '' }} {{ auth()->user()->profile->last_name ?? '' }} در {{ request()->getHost() }}  باشند.

                    </small>
                <br>
            </div>
        </div>
    </div>
</div>

