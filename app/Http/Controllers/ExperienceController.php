<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::with('translations')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Experience/ExperienceIndex', [
            'experiences' => $experiences,
        ]);
    }
}
