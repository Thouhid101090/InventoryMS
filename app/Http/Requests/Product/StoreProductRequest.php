<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_image' => 'required',
            'proName' => 'required|max:255|unique:products,product_name,id',
            'categoryId' => 'required',
            'sellingPrice' => 'required',
            'productCode' => 'required',
            'brand' => 'required'
        ];
    }
}
