<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CertificationRequest extends FormRequest
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
            'issue_date' => [
                'required',
                'date',
            ],

            'expiration_date' => [
                'nullable',
                'date',
                'after_or_equal:issue_date',
            ],

            'no_expiration' => [
                'required',
                'boolean',
            ],

            'credential_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'credential_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'image' => [
                'nullable',
                'string',
                'max:255',
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

            'translations.*.title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.issuer_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.issuer_country' => [
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
