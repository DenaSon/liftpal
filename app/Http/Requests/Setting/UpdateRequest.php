<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'system_admin_email' => 'nullable|email|max:100',
            'system_debugger_email' => 'nullable|email|max:100',
            'stock_manager_email' => 'nullable|email|max:100',
            'support_manager_email' => 'nullable|email|max:100',
            'system_admin_phone' => 'nullable|numeric|digits:11',
            'stock_manager_phone' => 'nullable|numeric|digits:11',
            'system_debugger_phone' => 'nullable|numeric|digits:11',
            'verify_sms_template' => 'nullable|numeric',
            'notify_sms_template' => 'nullable|numeric',
            'quantity_sms_template' => 'nullable|numeric',
            'max_image_size' => 'nullable|numeric|max:4096',
            'default_pagination_number' => 'nullable|numeric|max:50',
            'log_on_off' => 'nullable|in:on,off',
            'delete_log_period' => 'nullable|',


        ];
    }
}
