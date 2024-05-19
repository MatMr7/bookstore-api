<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->merge(['id' => request()->store]);

        return [
            'id' => ['required', 'integer', 'exists:stores,id'],
            'name' => ['sometimes', 'string', 'max:154'],
            'address' => ['sometimes', 'string', 'max:254'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
