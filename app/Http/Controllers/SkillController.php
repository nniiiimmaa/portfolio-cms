<?php

namespace App\Http\Controllers;

use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
}
