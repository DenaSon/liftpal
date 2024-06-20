
<div class="col-lg-5 col-md-5">
    <div class="footer_widget">
        <img src="{{ asset('assets/img/logo-light.png') }}" class="img-footer small mb-2" alt="">
        <h4 class="extream mb-3 font-2">از جدیدترین آموزش ها<br>مطلع شوید</h4>
        <p>هر ماه با عضویت در خبرنامه ما از به‌روزرسانی‌ها، معاملات جدید، آموزش‌ها و تخفیف‌ها باخبر شوید.</p>
        <div class="foot-news-last">
            <div class="input-group">
                <input wire:model="email" type="email" class="form-control" placeholder="ایمیل">

                <div class="input-group-append">
                    <button  wire:click="save"  wire:confirm="میخواهید در خبرنامه تایم پال عضو شوید؟" type="submit" class="input-group-text theme-bg b-0 text-light">عضویت</button>
                </div>

            </div>
            <div class="small text-danger">@error('email') {{ $message }} @enderror</div>
            <div wire:loading class="small text-info">درحال ثبت...</div>

        </div>
    </div>
</div>

