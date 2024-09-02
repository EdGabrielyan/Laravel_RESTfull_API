<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                'exists:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:4',
                'max:24',
            ]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw ValidationException::withMessages([
            'login' => $validator->errors()->first(),
        ]);
     }
}
