<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'available' => ['required', 'boolean'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:2048',
            ],

            'translations' => ['required', 'array', 'min:1'],

            'translations.*.language_id' => [
                'required',
                'integer',
                'exists:languages,id',
            ],

            'translations.*.name' => [
                'required',
                'string',
                'max:255',
            ],

            'translations.*.title' => [
                'required',
                'string',
                'max:255',
            ],

            'translations.*.description' => [
                'required',
                'string',
            ],

            'translations.*.availability_text' => [
                'nullable',
                'string',
            ],
        ];
    }
}
