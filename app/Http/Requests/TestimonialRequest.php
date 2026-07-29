<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:2048',
            ],

            'company_logo' => [
                'nullable',
                'file',
                'mimes:svg,jpg,jpeg,png,webp,avif',
                'max:2048',
            ],

            'remove_photo' => [
                'required',
                'boolean',
            ],

            'remove_company_logo' => [
                'required',
                'boolean',
            ],

            'rating' => [
                'nullable',
                'integer',
                'between:1,5',
            ],

            'approved' => [
                'required',
                'boolean',
            ],

            'featured' => [
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

            'translations.*.name' => [
                'required',
                'string',
                'max:255',
            ],

            'translations.*.position' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.company' => [
                'nullable',
                'string',
                'max:255',
            ],

            'translations.*.message' => [
                'required',
                'string',
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
