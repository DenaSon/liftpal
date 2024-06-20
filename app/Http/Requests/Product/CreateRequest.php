<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'bail|required|min:4|string|max:255' ,
            'brand'     => 'required|exists:brands,id' ,
            'description'    => 'string|min:10|max:160' ,
            'categories'     => 'required|exists:categories,id|max:100' ,
            'subcategories'  => 'nullable|exists:subcategories,id|max:100' ,
            'tags'  => 'required|max:100' ,
            'discount' => 'bail|numeric|min:0|max:100' ,
            'unit' => 'bail|required|string|min:1|max:35' ,
            'attributeName.*' => 'bail|required|min:1|max:100' ,
            'attributeValue.*' => 'bail|required|min:1|max:100' ,
            'attributeName' => 'bail|required|min:1|max:100' ,
            'attributeValue' => 'bail|required|min:1|max:100' ,
            'note' => 'nullable|max:255|string'

        ];
    }
}
