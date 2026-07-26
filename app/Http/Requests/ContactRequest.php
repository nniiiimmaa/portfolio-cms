<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:50',
            ],

            'google_maps_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'available' => [
                'required',
                'boolean',
            ],

            'translations' => [
                'required',
                'array',
                'min:1',
            ],

            'translations.*.description' => [
                'nullable',
                'string',
            ],

            'translations.*.address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.city' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.state' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.country' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.postal_code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'translations.*.working_hours' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*' => [
                function ($attribute, $value, $fail) {

                    $languageId = last(explode('.', $attribute));

                    if (
                        is_numeric($languageId) &&
                        ! Language::whereKey($languageId)->exists()
                    ) {
                        $fail('The selected language is invalid.');
                    }

                },
            ],

        ];
    }
}
