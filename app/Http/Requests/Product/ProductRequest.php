<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('products')->ignore($this->product),
            ],
            'category_id' => [
                'required',
                'integer',
                'min:1',
                Rule::exists('categories', 'id')
            ],
        ];
    }
}
