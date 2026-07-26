<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillCategoryRequest;
use App\Models\SkillCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SkillCategoryController extends Controller
{
    public function store(SkillCategoryRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $defaultTranslation = collect($request->translations)->first();

                $skillCategory = SkillCategory::create([
                    'slug' => \Illuminate\Support\Str::slug($defaultTranslation['name']),
                    'icon' => $request->icon,
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $skillCategory->translations()->create([
                        'language_id' => $languageId,
                        'name' => $translation['name'],
                    ]);

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Skill category created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create skill category.', [
                'user_id' => $request->user()?->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'skill_category' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the skill category.',
                ]);
        }
    }

    public function update(SkillCategoryRequest $request, SkillCategory $skillCategory)
    {
        try {

            DB::transaction(function () use ($request, $skillCategory) {

                $defaultTranslation = collect($request->translations)->first();

                $skillCategory->update([
                    'slug' => Str::slug($defaultTranslation['name']),
                    'icon' => $request->icon,
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $skillCategory->translations()->updateOrCreate(
                        [
                            'language_id' => $languageId,
                        ],
                        [
                            'name' => $translation['name'],
                        ]
                    );

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Skill category updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update skill category.', [
                'user_id' => $request->user()?->id,
                'skill_category_id' => $skillCategory->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'skill_category' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the skill category.',
                ]);
        }
    }

    public function destroy(SkillCategory $skillCategory)
    {
        try {

            DB::transaction(function () use ($skillCategory) {

                $skillCategory->delete();

            });

            return redirect()
                ->back()
                ->with('success', 'Skill category deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete skill category.', [
                'user_id' => auth()->id(),
                'skill_category_id' => $skillCategory->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'skill_category' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the skill category.',
                ]);
        }
    }
}
