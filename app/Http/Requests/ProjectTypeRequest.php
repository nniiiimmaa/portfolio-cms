<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectTypeRequest extends FormRequest
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
                Rule::unique('project_types', 'slug')
                    ->ignore($this->route('projectType')),
            ],

            'color' => [
                'nullable',
                'string',
                'size:7',
                'regex:/^#[0-9A-Fa-f]{6}$/',
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
