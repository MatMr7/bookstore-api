<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class CreateStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:154'],
            'address' => ['required', 'string', 'max:254'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
