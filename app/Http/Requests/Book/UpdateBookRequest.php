<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->merge(['id' => request()->book]);

        return [
            'id' => ['required', 'exists:books,id'],
            'name' => ['sometimes', 'string', 'max:154'],
            'isbn' => ['sometimes', 'integer'],
            'value' => ['sometimes', 'numeric'],
            'store_ids' => ['sometimes', 'array'],
            'store_ids.*' => ['required', 'integer', 'exists:stores,id'],
        ];
    }
}
