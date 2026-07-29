<?php

namespace App\Services;

use App\Models\About;
use App\Models\Certification;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hobby;
use App\Models\Project;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Support\Collection;

class CvPdfService
{
    /**
     * Keep this in sync with the `sections` array in the Vue component
     * and with the checkbox keys (publicCv.sections.*).
     */
    public const AVAILABLE_SECTIONS = [
        'about',
        'experience',
        'projects',
        'education',
        'certificates',
        'skills',
        'hobbies',
        // 'testimonials',
        'contact',
    ];

    /**
     * Build the data array for the CV view, only querying what was
     * actually requested so unchecked sections don't cost a query.
     *
     * @param  array<int, string>  $requestedSections
     */
    public function build(array $requestedSections): array
    {
        $sections = array_values(array_intersect(self::AVAILABLE_SECTIONS, $requestedSections));

        $wants = fn (string $key): bool => in_array($key, $sections, true);

        return [
            'sections' => $sections,

            'about' => $wants('about')
                ? About::with('translations')->first()
                : null,

            'experiences' => $wants('experience')
                ? Experience::with('translations')->orderBy('order', 'desc')->get()
                : collect(),

            'projects' => $wants('projects')
                ? Project::with(['translations', 'type.translations', 'status.translations', 'images'])
                    ->orderBy('order')
                    ->get()
                : collect(),

            'education' => $wants('education')
                ? Education::with('translations')->orderBy('order', 'desc')->get()
                : collect(),

            'skillCategories' => $wants('skills')
                ? SkillCategory::with([
                    'translations',
                    'skills' => fn ($q) => $q->with('translations')->orderBy('order'),
                ])->orderBy('order')->get()
                : collect(),

            'certifications' => $wants('certificates')
                ? Certification::with('translations')->orderBy('order', 'desc')->get()
                : collect(),

            'hobbies' => $wants('hobbies')
                ? Hobby::with(['translations', 'images'])->orderBy('order')->get()
                : collect(),

            'testimonials' => $wants('testimonials')
                ? Testimonial::where('approved', true)->with('translations')->orderBy('order')->get()
                : collect(),

            'contact' => $wants('contact')
                ? Contact::with('translations')->first()
                : null,

            'socialLinks' => $wants('contact')
                ? SocialLink::where('active', true)->orderBy('order')->get()
                : collect(),
        ];
    }

    /**
     * Filter helper the AVAILABLE_SECTIONS constant is reused for
     * request validation in the controller (Rule::in).
     */
    public static function isValidSection(string $section): bool
    {
        return in_array($section, self::AVAILABLE_SECTIONS, true);
    }
}