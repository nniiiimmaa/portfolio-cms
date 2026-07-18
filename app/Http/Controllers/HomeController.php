<?php

namespace App\Http\Controllers;

use App\Services\HomePageService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(HomePageService $homePageService){
        return Inertia::render('Home/HomeIndex', $homePageService->get());
    }
}
