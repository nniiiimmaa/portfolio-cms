<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'score' => [
                'nullable',
                'numeric',
                'min:0',
                'max:999.99',
            ],

            'logo' => [
                'nullable',
                'file',
                'mimes:svg,jpg,jpeg,png,webp,avif',
                'max:2048',
            ],

            'verification_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'current' => [
                'required',
                'boolean',
            ],

            'order' => [
                'required',
                'integer',
                'min:0',
            ],

            'translations' => [
                'required',
                'array',
                'min:1',
            ],

            'translations.*.institution' => [
                'required',
                'string',
                'max:255',
            ],

            'translations.*.degree' => [
                'required',
                'string',
                'max:255',
            ],

            'translations.*.field' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.description' => [
                'nullable',
                'string',
            ],
        ];
    }
}
