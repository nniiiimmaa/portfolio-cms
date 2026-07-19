<?php

namespace App\Services;

use App\Models\About;
use App\Models\Certification;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Testimonial;

class HomePageService
{
    public function get(): array
    {
        return [
            'about' => About::with('translations')->first(),
            'experiences' => Experience::with('translations')->orderBy('order')->get(),
            'projects' => Project::with([
                'translations',
                'type.translations',
                'status.translations',
                'images',
            ])
                ->orderBy('order')
                ->get(),
            'education' => Education::orderBy('order')->get(),
            'skillCategories' => SkillCategory::with([
                'skills' => fn ($query) => $query->orderBy('order'),
            ])
                ->orderBy('order')
                ->get(),
            'certifications' => Certification::orderBy('order')->get(),
            'socialLinks' => SocialLink::where('active', true)
                ->orderBy('order')
                ->get(),
            'testimonials' => Testimonial::where('approved', true)
                ->orderBy('order')
                ->get(),
            'contact' => Contact::first(),
        ];
    }
}
