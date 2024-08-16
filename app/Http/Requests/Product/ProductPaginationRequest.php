<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductPaginationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'offset' => [
                'required',
                'integer',
                'min:0',
            ],
            'limit' => [
                'required',
                'integer',
                'min:1',
                'max:10',
            ],
            'type' => [
                'integer',
                'min:0',
                'max:2',
            ]
        ];
    }
}
