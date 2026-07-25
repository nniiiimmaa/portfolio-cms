<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EducationController extends Controller
{
    public function index(){
        $educations = Education::with([ 'translations' ])
            ->orderBy('order')
            ->get();

        return Inertia::render('Education/EducationIndex', ['educations' => $educations]);
    }
}
