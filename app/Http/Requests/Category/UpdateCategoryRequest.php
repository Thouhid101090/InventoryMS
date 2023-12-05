<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class UpdateCategoryRequest extends FormRequest
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
    public function rules(Request $r): array
    {
        $id=encryptor('decrypt',$r->uptoken);
        return [
            // 'name' => [
            //     'required',
            //     Rule::unique('categories')->ignore($this->category)
            // ],
            // 'slug' => [
            //     'required',
            //     'alpha_dash',
            //     Rule::unique('categories')->ignore($this->category)
            // ]

            'name'=>'required|max:30|alpha:ascii|unique:categories,name,'.$id,
            'slug'=>'required|max:30|unique:categories,slug,'.$id
        ];
    }
}
