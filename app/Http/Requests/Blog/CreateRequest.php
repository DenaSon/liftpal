<?php

namespace App\Http\Requests\Blog;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'      => 'required|min:4|string|max:255' ,
            'description'    => 'string|min:10|max:160' ,
            'categories'     => 'required|exists:categories,id|max:100' ,
            'tags'  => 'required' ,
            'note' => 'nullable|max:255|string',
            'image' => 'image'
        ];
    }
}
