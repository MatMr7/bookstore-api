<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:154'],
            'email' => ['required', 'string', 'email:rfc', 'max:154', 'unique:users,email'],
            'password' => ['required', 'string'],
        ];
    }
}
