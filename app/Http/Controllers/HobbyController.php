<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HobbyController extends Controller
{
    public function index(){
        $hobbies = Hobby::with(['translations', 'images'])
            ->orderby('order')
            ->get();

        return Inertia::render('Hobby/HobbyIndex', ['hobbies' => $hobbies]);
    }
}
