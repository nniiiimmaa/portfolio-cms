<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SkillRequest extends FormRequest
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
            'skill_category_id' => [
                'required',
                'exists:skill_categories,id',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('skills', 'slug')
                    ->ignore($this->route('skill')?->id),
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
            ],

            'level' => [
                'nullable',
                'integer',
                'between:0,100',
            ],

            'years_experience' => [
                'nullable',
                'integer',
                'min:0',
                'max:100',
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
        ];
    }
}
