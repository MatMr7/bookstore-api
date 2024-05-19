<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:154'],
            'isbn' => ['required', 'integer'],
            'value' => ['required', 'numeric'],
            'store_ids' => ['nullable', 'array'],
            'store_ids.*' => ['required', 'integer', 'exists:stores,id'],
        ];
    }
}
