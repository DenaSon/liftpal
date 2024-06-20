<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateRequest;
use App\Models\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;


class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::all();
        return view('admin.setting.index',compact('setting'));

    }

    public function clearCache()
    {
        Cache::flush();

        return redirect()->back();
    }



    public function update(UpdateRequest $request)
    {
        if ($request->hasFile('sm_logo_url')) {

            $request->validate(['sm_logo_url' => 'nullable|image']);

            $this->uploadImage($request, 'sm_logo_url', 'max_image_size');
        }

        if ($request->hasFile('lg_logo_url')) {
            $request->validate(['lg_logo_url' => 'nullable|image']);
            $this->uploadImage($request, 'lg_logo_url', 'max_image_size');
        }

        try {

        $settings = [
            //Global Website Setting
            'system_admin_email'     => $request->input('system_admin_email'),
            'system_debugger_email' => $request->input('system_debugger_email'),
            'stock_manager_email'   => $request->input('stock_manager_email'),
            'support_manager_email' => $request->input('support_manager_email'),
            'system_admin_phone' => $request->input('system_admin_phone'),
            'stock_manager_phone' => $request->input('stock_manager_phone'),
            'system_debugger_phone' => $request->input('system_debugger_phone'),
            'support_manager_phone' => $request->input('support_manager_phone'),
            'verify_sms_template' => $request->input('verify_sms_template'),
            'order_verify_template' => $request->input('order_verify_template',0),
            'notify_sms_template' => $request->input('notify_sms_template'),
            'quantity_sms_template' => $request->input('quantity_sms_template'),
            'max_image_size' => $request->input('max_image_size'),
            'default_pagination_number' => $request->post('default_pagination_number'),
            'log_on_off' => $request->input('log_on_off'),
            'delete_log_period' => $request->input('delete_log_period'),
            // Website Seo Setting
            'website_title' => $request->input('website_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'),
            //Shop Setting
            'template_color' => $request->input('template_color'),
            'fixed_shipping_cost' => $request->input('fixed_shipping_cost',0),
            'fixed_tax_rate' => $request->input('fixed_tax_rate',0),


        ];

        foreach ($settings as $key => $value) {
            Cache::forget('settings_' . $key);

            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        }
        catch (Throwable $e)
        {
            setLog('Update-Setting',$e->getMessage(),'danger');
            return redirect()->route('log-system');

        }

        Alert::success('تنظیمات جدید ثبت شدند');
        return redirect()->back();



    }

    private function uploadImage($request, $imageKey, $maxSizeSettingKey)
    {
        try {

        $logo = $request->file($imageKey);
            if (app()->isLocal())
            {
                $directory = public_path('/media/');
            }
            else
            {
                $directory = ('media');
            }
        $fileSize = $logo->getSize() / 1000;

        $maxSize = getSetting($maxSizeSettingKey);

        if ($fileSize > $maxSize) {
            Alert::warning('حجم تصویر لوگو مجاز نیست.');
            return redirect()->back();
        }

        $imageName = Str::random(10) . $logo->getClientOriginalName();
        $fileName = Str::limit($request->input('name'), 18, '...');
        $fileName = Str::replace(' ', '_', $fileName);
        $logo->move($directory, $imageName);

        $setting = Setting::where('key', $imageKey)->first();
        $setting->value = 'media/' . $imageName;
        $setting->save();
    }
    catch (Throwable $e)
        {
            setLog('Upload-SettingLogo',$e->getMessage(),'danger');
            return redirect()->route('log-system');

        }
    }


}
