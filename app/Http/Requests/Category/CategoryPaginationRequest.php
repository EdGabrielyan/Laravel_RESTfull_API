<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryPaginationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
        ];
    }
}
