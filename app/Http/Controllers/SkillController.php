<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class SkillController extends Controller
{
    public function index(){
        $skillCategories = SkillCategory::with([
            'translations',
            'skills' => fn ($query) => $query
                ->with('translations')
                ->orderBy('order'),
        ])
            ->orderBy('order')
            ->get();

        return Inertia::render('Skill/SkillIndex', [
            'skillCategories' => $skillCategories,
        ]);
    }

    public function store(SkillRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $skill = Skill::create([
                    'skill_category_id' => $request->skill_category_id,
                    'slug' => $request->slug,
                    'icon' => $request->icon,
                    'level' => $request->level,
                    'years_experience' => $request->years_experience,
                    'featured' => $request->boolean('featured'),
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $skill->translations()->create([
                        'language_id' => $languageId,
                        'name' => $translation['name'],
                        'description' => $translation['description'] ?? null,
                    ]);

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Skill created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create skill.', [
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
                    'skill' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the skill.',
                ]);
        }
    }

    public function update(SkillRequest $request, Skill $skill)
    {
        try {

            DB::transaction(function () use ($request, $skill) {

                $skill->update([
                    'skill_category_id' => $request->skill_category_id,
                    'slug' => $request->slug,
                    'icon' => $request->icon,
                    'level' => $request->level,
                    'years_experience' => $request->years_experience,
                    'featured' => $request->boolean('featured'),
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $skill->translations()->updateOrCreate(
                        [
                            'language_id' => $languageId,
                        ],
                        [
                            'name' => $translation['name'],
                            'description' => $translation['description'] ?? null,
                        ]
                    );

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Skill updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update skill.', [
                'user_id' => $request->user()?->id,
                'skill_id' => $skill->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'skill' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the skill.',
                ]);
        }
    }

    public function destroy(Skill $skill)
    {
        try {

            DB::transaction(function () use ($skill) {

                $skill->delete();

            });

            return redirect()
                ->back()
                ->with('success', 'Skill deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete skill.', [
                'user_id' => auth()->id(),
                'skill_id' => $skill->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'skill' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the skill.',
                ]);
        }
    }
}
