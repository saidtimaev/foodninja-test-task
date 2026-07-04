<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Пожалуйста, введите ваш email.',
            'email.email'       => 'Введите корректный адрес электронной почты.',
            'password.required' => 'Пожалуйста, введите пароль.',
        ];
    }
}