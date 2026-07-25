<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SocialMediaController extends Controller
{
    public function index(){
        $links = SocialLink::orderBy('order')->get();

        return Inertia::render('SocialMedia/SocialMediaIndex', [
            'links' => $links,
        ]);
    }
}
