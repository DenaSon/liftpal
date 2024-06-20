<div class="row">
<div class="col-md-6 col-xl-4">
<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-12">
        <span class="mdi mdi-email-outline ms-1 me-1 text-primary"></span>
        <label class="form-label" for="system_admin_email"> ایمیل مدیر </label>
        <input type="email" value="{{ getSetting('system_admin_email') }}" id="system_admin_email" name="system_admin_email" class="form-control">
     </div>
    </div>
</div>
</div>
</div> <!-- end card-->


<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-email-outline ms-1 me-1 text-primary"></span>
                <label class="form-label" for="system_debugger_email"> ایمیل متخصص </label>
                <input type="email" value="{{ getSetting('system_debugger_email') }}" id="system_debugger_email" name="system_debugger_email" class="form-control">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->



<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-email-outline ms-1 me-1 text-primary "></span>
                <label class="form-label" for="stock_manager_email"> ایمیل مدیر انبار </label>
                <input type="email" value="{{ getSetting('stock_manager_email') }}" id="stock_manager_email" name="stock_manager_email" class="form-control">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->


<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-email-outline ms-1 me-1 text-primary"></span>
                <label class="form-label" for="support_manager_email"> ایمیل مدیر پشتیبانی </label>
                <input type="email" maxlength="100"  value="{{ getSetting('support_manager_email') }}" id="support_manager_email" name="support_manager_email" class="form-control">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->



    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <span class="mdi mdi-phone-outline ms-1 me-1 text-warning"></span>
                        <label class="form-label" for="system_admin_phone"> شماره تلفن مدیر سیستم</label>
                        <input type="number" maxlength="11" value="{{ getSetting('system_admin_phone') }}" id="system_admin_phone" name="system_admin_phone" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-->



    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <span class="mdi mdi-phone-outline ms-1 me-1 text-warning"></span>
                        <label class="form-label" for="support_manager_phone"> شماره تلفن پشتیبانی</label>
                        <input type="number" maxlength="11" value="{{ getSetting('support_manager_phone') }}" id="support_manager_phone" name="support_manager_phone" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-->






<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-phone-outline ms-1 me-1 text-warning"></span>
                <label class="form-label" for="stock_manager_phone"> شماره تلفن مدیر انبار</label>
                <input type="number" maxlength="11" value="{{ getSetting('stock_manager_phone') }}" id="stock_manager_phone" name="stock_manager_phone" class="form-control">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->


<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-phone-outline ms-1 me-1 text-warning"></span>
                <label class="form-label" for="system_debugger_phone"> شماره تلفن متخصص سیستم </label>
                <input type="number" maxlength="11"  value="{{ getSetting('system_debugger_phone') }}" id="system_debugger_phone" name="system_debugger_phone" class="form-control">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->





<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-message-outline ms-1 me-1 text-pink"></span>
                <label class="form-label" for="verify_sms_template"> شماره قالب پیامک تاییدیه </label>
                <input type="number" maxlength="11"  value="{{ getSetting('verify_sms_template') }}" id="verify_sms_template" name="verify_sms_template" class="form-control text-pink">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->



    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <span class="mdi mdi-message-outline ms-1 me-1 text-pink"></span>
                        <label class="form-label" for="order_verify_template"> شماره قالب پیامک تایید سفارش </label>
                        <input type="number" maxlength="11"  value="{{ getSetting('order_verify_template') }}" id="order_verify_template" name="order_verify_template" class="form-control text-pink">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-->




<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-message-outline ms-1 me-1 text-pink"></span>
                <label class="form-label" for="notify_sms_template"> شماره قالب پیامک اعلان </label>
                <input type="number" maxlength="11"  value="{{ getSetting('notify_sms_template') }}" id="notify_sms_template" name="notify_sms_template" class="form-control text-pink">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->


<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-message-outline ms-1 me-1 text-pink"></span>
                <label class="form-label" for="quantity_sms_template"> شماره قالب پیامک موجودی کالا </label>
                <input value="{{ getSetting('quantity_sms_template') }}" type="number" maxlength="11"  id="quantity_sms_template" name="quantity_sms_template" class="form-control text-pink">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->




<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-upload-outline ms-1 me-1 text-info"></span>
                <label class="form-label" for="lg_logo_url"> تصویر لوگو بزرگ </label>
                <a target="_blank" href="{{ asset(getSetting('lg_logo_url')) }}" class="link-info">نمایش</a>
                <input type="file"  id="lg_logo_url" name="lg_logo_url" class="form-control text-info">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->



<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-upload-outline ms-1 me-1 text-info"></span>
                <label class="form-label" for="sm_logo_url"> تصویر لوگو کوچک </label>
                <a target="_blank" href="{{ asset(getSetting('sm_logo_url')) }}" class="link-info">نمایش</a>
                <input type="file"   value="{{ getSetting('sm_logo_url') }}" id="sm_logo_url" name="sm_logo_url" class="form-control text-info">
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->



<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-book-settings-outline ms-1 me-1 text-info"></span>
                <label class="form-label" for="max_image_size"> حداکثر حجم آپلود فایل  </label>

                <select name="max_image_size" class="form-select form-select-sm" id="max_image_size">
                    <option value="512"  @if(getSetting('max_image_size') ==  '512') selected @endif> 0.5 مگابایت </option>
                    <option value="1024" @if(getSetting('max_image_size') == '1024') selected @endif> 1 مگابایت </option>
                    <option value="1536" @if(getSetting('max_image_size') == '1536') selected @endif> 1.5 مگابایت </option>
                    <option value="2048" @if(getSetting('max_image_size') == '2048') selected @endif> 2 مگابایت </option>


                </select>
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->



<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-view-list-outline ms-1 me-1 text-danger"></span>
                <label class="form-label" for="default_pagination_number"> تعداد صفحه بندی پیشفرض  </label>

                <select name="default_pagination_number" class="form-select form-select-sm" id="default_pagination_number">

                    <option value="5"  @if(getSetting('default_pagination_number') == '5') selected @endif> 5 ردیف </option>
                    <option value="10" @if(getSetting('default_pagination_number') == '10') selected @endif> 10 ردیف </option>
                    <option value="15" @if(getSetting('default_pagination_number') == '15') selected @endif>15 ردیف </option>
                    <option value="20" @if(getSetting('default_pagination_number') == '20') selected @endif> 20 ردیف</option>
                    <option value="30" @if(getSetting('default_pagination_number') == '30') selected @endif> 30 ردیف</option>

                </select>
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->



<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-math-log ms-1 me-1 text-danger"></span>
                <label class="form-label" for="log_on_off"> سیستم گزارش گیری  </label>

                <select name="log_on_off" class="form-select form-select-sm" id="log_on_off">
                    <option value="on"  @if(getSetting('log_on_off') == 'on') selected @endif> فعال </option>
                    <option value="off" @if(getSetting('log_on_off') == 'off') selected @endif> غیرفعال </option>
                </select>
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->


<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-timer-outline ms-1 me-1 text-danger"></span>
                <label class="form-label" for="delete_log_period"> زمانبندی حذف گزارشات  </label>

                <select name="delete_log_period" class="form-select form-select-sm" id="delete_log_period">

                    <option value="daily"   @if(getSetting('delete_log_period') == 'daily') selected @endif> روزانه </option>
                    <option value="weekly"  @if(getSetting('delete_log_period') == 'weekly') selected @endif> هفتگی </option>
                    <option value="monthly" @if(getSetting('delete_log_period') == 'monthly') selected @endif> ماهانه </option>

                </select>
            </div>
        </div>
    </div>
</div>
</div>
    <!-- end card-->

</div> <!-- end row -->


