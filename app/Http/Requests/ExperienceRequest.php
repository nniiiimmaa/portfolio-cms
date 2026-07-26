<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'company' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'string', 'max:255'],

            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],

            'current' => ['required', 'boolean'],

            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['string', 'max:100'],

            'order' => ['required', 'integer', 'min:0'],

            'translations' => ['required', 'array', 'min:1'],
            'translations.*.position' => ['required', 'string', 'max:255'],
            'translations.*.description' => ['required', 'string'],

            'translations.*' => [
                function ($attribute, $value, $fail) {
                    $languageId = last(explode('.', $attribute));

                    if (is_numeric($languageId) && ! Language::whereKey($languageId)->exists()) {
                        $fail('The selected language is invalid.');
                    }
                },
            ],
        ];
    }
}
