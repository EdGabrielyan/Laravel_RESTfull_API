<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class UserPaginationRequest extends FormRequest
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
        ];
    }
}
