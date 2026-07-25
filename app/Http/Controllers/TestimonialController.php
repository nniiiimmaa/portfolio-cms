<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials = Testimonial::with(['translations'])
            ->orderby('order')
            ->get();
        return Inertia::render('Testimonial/TestimonialIndex', ['testimonials' => $testimonials]);
    }
}
