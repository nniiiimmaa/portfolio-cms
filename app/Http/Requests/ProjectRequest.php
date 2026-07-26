<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
                Rule::unique('projects', 'slug')->ignore($this->route('project')),
            ],

            'logo' => [
                'nullable',
                'string',
                'max:255',
            ],

            'github_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'live_url' => [
                'nullable',
                'url',
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

            'project_type_id' => [
                'nullable',
                'exists:project_types,id',
            ],

            'project_status_id' => [
                'nullable',
                'exists:project_statuses,id',
            ],

            'technologies' => [
                'nullable',
                'array',
            ],

            'technologies.*' => [
                'string',
                'max:100',
            ],

            'translations' => [
                'required',
                'array',
                'min:1',
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

            'translations.*' => [
                function ($attribute, $value, $fail) {
                    $languageId = last(explode('.', $attribute));

                    if (
                        is_numeric($languageId) &&
                        ! Language::whereKey($languageId)->exists()
                    ) {
                        $fail("The selected language is invalid.");
                    }
                },
            ],
        ];
    }
}
