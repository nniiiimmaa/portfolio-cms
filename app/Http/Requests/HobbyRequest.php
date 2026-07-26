<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HobbyRequest extends FormRequest
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

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('hobbies', 'slug')
                    ->ignore($this->route('hobby')?->id),
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
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

            'translations.*.description' => [
                'nullable',
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
