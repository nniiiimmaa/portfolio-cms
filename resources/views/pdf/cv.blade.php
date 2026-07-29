@php
    $currentLanguageId = $languageId ?? optional($language ?? null)->id;

    $t = function ($model) use ($currentLanguageId) {
        if (!$model || !isset($model->translations)) {
            return $model;
        }

        return $model->translations->firstWhere('language_id', $currentLanguageId) ?? $model->translations->first();
    };
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <title>{{ optional($t($about))->name ?? config('app.name') }} — CV</title>
    <style>
    /* ==========================================================
       PAGE / RESET
    ========================================================== */

        @page {
            margin: 26px 0;
        }

        @page :first {
            margin-top: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.6;
            color: #0f172a;
            background: #ffffff;
        }

        h1,
        h2,
        h3,
        h4,
        p {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
        }

        a {
            color: #4338ca;
            text-decoration: none;
        }

        /* ==========================================================
       PAGE BODY WRAPPER
    ========================================================== */

        .cv-body {
            padding: 0 34px;
        }

        /* ==========================================================
       HEADER
    ========================================================== */

        .cv-header-accent {
            height: 5px;
            background: #4338ca;
        }

        .cv-header {
            background: #0f172a;
            color: #ffffff;
            padding: 24px 34px 26px;
            margin-bottom: 22px;
        }

        .cv-header table td {
            vertical-align: middle;
        }

        .cv-avatar {
            width: 100px;
            text-align: right;
        }

        .cv-avatar img {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.15);
        }

        .cv-name {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.2px;
            color: #ffffff;
        }

        .cv-role {
            margin-top: 3px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.6px;
            color: #818cf8;
        }

        .cv-badge {
            display: inline-block;
            margin-top: 10px;
            padding: 3px 10px 3px 8px;
            border-radius: 20px;
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .cv-badge-dot {
            display: inline-block;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .cv-badge.available {
            background: rgba(52, 211, 153, 0.16);
            color: #34d399;
        }

        .cv-badge.available .cv-badge-dot {
            background: #34d399;
        }

        .cv-badge.unavailable {
            background: rgba(148, 163, 184, 0.16);
            color: #94a3b8;
        }

        .cv-badge.unavailable .cv-badge-dot {
            background: #94a3b8;
        }

        .cv-bio {
            margin-top: 11px;
            font-size: 9.5px;
            line-height: 1.65;
            color: #cbd5e1;
            text-align: justify;
        }

        /* ==========================================================
       CONTACT + SOCIAL INFO BAR
    ========================================================== */

        .info-bar {
            margin-bottom: 24px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.1);
        }

        .info-group-label {
            font-size: 7.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .info-group-label:not(:first-child) {
            margin-top: 14px;
        }

        .info-chip {
            display: inline-block;
            margin: 0 10px 8px 0;
            padding: 5px 10px;
            border-radius: 7px;
            background: #f8fafc;
            border: 1px solid rgba(15, 23, 42, 0.06);
            font-size: 8.8px;
        }

        .info-chip strong {
            display: block;
            font-size: 7.2px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #94a3b8;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .social-chip strong {
            color: inherit;
        }

        .social-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            margin-right: 4px;
        }

        /* ==========================================================
       SECTIONS
    ========================================================== */

        .cv-section {
            margin-bottom: 24px;
        }

        .cv-section:last-child {
            margin-bottom: 0;
        }

        .cv-section-title {
            margin-bottom: 13px;
            padding-bottom: 7px;
            border-bottom: 2px solid #4338ca;
            color: #0f172a;
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .cv-section-title-mark {
            display: inline-block;
            width: 7px;
            height: 7px;
            margin-right: 7px;
            background: #4338ca;
            border-radius: 2px;
        }

        /* ==========================================================
       EXPERIENCE / EDUCATION / PROJECTS
    ========================================================== */

        .entry {
            margin-bottom: 15px;
            padding: 10px 0 10px 13px;
            border-left: 3px solid #e0e7ff;
            page-break-inside: avoid;
        }

        .entry:last-child {
            margin-bottom: 0;
        }

        .entry-header {
            width: 100%;
        }

        .entry-title {
            font-size: 11px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .entry-dates {
            text-align: right;
            white-space: nowrap;
            font-size: 8px;
            font-weight: 700;
            color: #4338ca;
            padding: 2px 8px;
            border-radius: 10px;
        }

        .entry-subtitle {
            margin-top: 3px;
            font-size: 9.5px;
            font-weight: 600;
            color: #475569;
        }

        .entry-meta {
            margin-top: 1px;
            font-size: 8.5px;
            color: #94a3b8;
        }

        .entry-description {
            margin-top: 7px;
            color: #475569;
            font-size: 9.5px;
            text-align: justify;
        }

        .entry-score {
            display: inline-block;
            margin-top: 5px;
            padding: 2px 8px;
            border-radius: 8px;
            background: rgba(67, 56, 202, 0.08);
            color: #4338ca;
            font-size: 8px;
            font-weight: 700;
        }

        /* ==========================================================
       PROJECT CARDS
    ========================================================== */

        .project-badge {
            display: inline-block;
            margin: 0 5px 0 0;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 7.5px;
            font-weight: 700;
            color: #ffffff;
        }

        .project-links {
            margin-top: 6px;
            font-size: 8.5px;
        }

        .project-links a {
            margin-right: 12px;
            font-weight: 600;
        }

        /* ==========================================================
       TAGS / TECHNOLOGIES
    ========================================================== */

        .tag {
            display: inline-block;
            margin: 3px 5px 0 0;
            padding: 3px 9px;
            border-radius: 6px;
            background: rgba(67, 56, 202, 0.08);
            color: #4338ca;
            font-size: 8px;
            font-weight: 600;
        }

        /* ==========================================================
       SKILLS — each category is its own block, and the skills
       inside are flowing chips (name + percentage) that wrap
       left-to-right, moving to the next row once a line fills —
       same flow behavior as the social links row, rather than a
       fixed column grid.
    ========================================================== */

        .skill-category {
            margin-bottom: 14px;
            page-break-inside: avoid;
        }

        .skill-category:last-child {
            margin-bottom: 0;
        }

        .skill-category-name {
            margin-bottom: 8px;
            font-size: 9.5px;
            font-weight: 700;
            color: #0f172a;
        }

        .skill-chip {
            display: inline-block;
            margin: 0 6px 6px 0;
            padding: 4px 6px 4px 10px;
            border-radius: 7px;
            background: #f8fafc;
            border: 1px solid rgba(15, 23, 42, 0.06);
            font-size: 8.5px;
            white-space: nowrap;
        }

        .skill-chip-name {
            display: inline-block;
            font-weight: 600;
            color: #0f172a;
        }

        .skill-years {
            display: inline-block;
            font-weight: 400;
            color: #94a3b8;
            font-size: 7.5px;
        }

        .skill-percent {
            display: inline-block;
            margin-left: 6px;
            min-width: 24px;
            text-align: center;
            /* padding: 1px 5px; */
            border-radius: 8px;
            background: rgba(67, 56, 202, 0.1);
            color: #4338ca;
            font-size: 7.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ==========================================================
       CERTIFICATIONS
    ========================================================== */

        .certificate {
            display: inline-block;
            width: 47%;
            vertical-align: top;
            margin: 0 3% 12px 0;
            page-break-inside: avoid;
        }

        .certificate-title {
            font-weight: 700;
            font-size: 9px;
            color: #0f172a;
        }

        .certificate-issuer {
            font-size: 8.5px;
            color: #475569;
        }

        .certificate-date {
            font-size: 8px;
            color: #94a3b8;
        }

        /* ==========================================================
       HELPERS
    ========================================================== */

        .text-muted {
            color: #475569;
        }

        .small {
            font-size: 9px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <div class="cv-header-accent"></div>

    {{-- =========================================
         HEADER / ABOUT
         ========================================= --}}
    @if (in_array('about', $sections) && $about)
        @php $aboutT = $t($about); @endphp
        <div class="cv-header">
            <table>
                <tr>
                    <td>
                        <div class="cv-name">{{ $aboutT->name }}</div>
                        <div class="cv-role">{{ $aboutT->title }}</div>

                        <div>
                            <span class="cv-badge {{ $about->available ? 'available' : 'unavailable' }}">
                                <span
                                    class="cv-badge-dot"></span>{{ $aboutT->availability_text ?? ($about->available ? __('publicCv.available') : __('publicCv.unavailable')) }}
                            </span>
                        </div>

                        @if ($aboutT->description ?? null)
                            <div class="cv-bio">{{ $aboutT->description }}</div>
                        @endif
                    </td>
                    @if ($about->image ?? null)
                        <td class="cv-avatar">
                            <img src="{{ $about->image }}" alt="">
                        </td>
                    @endif
                </tr>
            </table>
        </div>
    @endif

    <div class="cv-body">

        {{-- =========================================
             CONTACT + SOCIAL INFO BAR
             Contact details and social links are grouped separately,
             and each social chip is labeled with its platform name
             (e.g. "LinkedIn", "GitHub") above the handle, so it's
             clear what each link is for.
             ========================================= --}}
        @if (in_array('contact', $sections) && ($contact || $socialLinks->isNotEmpty()))
            @php $contactT = $contact ? $t($contact) : null; @endphp
            <div class="info-bar">
                @if ($contact)
                    <div class="info-group-label">{{ __('publicCv.sections.contact') ?? 'Contact' }}</div>

                    @if ($contact->email ?? null)
                        <span class="info-chip">
                            <strong>{{ __('publicCv.email') }}</strong>{{ $contact->email }}
                        </span>
                    @endif
                    @if ($contact->whatsapp ?? null)
                        <span class="info-chip">
                            <strong>{{ __('publicCv.whatsapp') }}</strong>{{ $contact->whatsapp }}
                        </span>
                    @endif
                    @if (($contactT->city ?? null) || ($contactT->country ?? null))
                        <span class="info-chip">
                            <strong>{{ __('publicCv.location') }}</strong>
                            {{ collect([$contactT->city ?? null, $contactT->state ?? null, $contactT->country ?? null])->filter()->implode(', ') }}
                        </span>
                    @endif
                    @if ($contactT->working_hours ?? null)
                        <span class="info-chip">
                            <strong>{{ __('publicCv.working_hours') }}</strong>{{ $contactT->working_hours }}
                        </span>
                    @endif
                @endif

                @if ($socialLinks->isNotEmpty())
                    <div class="info-group-label">{{ __('publicCv.sections.social') ?? 'Social' }}</div>

                    @foreach ($socialLinks as $link)
                        @if ($link->active ?? true)
                            <span class="info-chip social-chip" style="color: {{ $link->color ?? '#4338ca' }};">
                                <strong>
                                    <span class="social-dot"
                                        style="background: {{ $link->color ?? '#4338ca' }};"></span>{{ $link->name }}
                                </strong>
                                <a href="{{ $link->url }}"
                                    style="color: {{ $link->color ?? '#4338ca' }};">{{ $link->username ?? $link->url }}</a>
                            </span>
                        @endif
                    @endforeach
                @endif
            </div>
        @endif

        {{-- =========================================
             SKILLS
             ========================================= --}}
        @if (in_array('skills', $sections) && $skillCategories->isNotEmpty())
            <div class="cv-section">
                <div class="cv-section-title"><span
                        class="cv-section-title-mark"></span>{{ __('publicCv.sections.skills') }}</div>
                @foreach ($skillCategories as $category)
                    <div class="skill-category">
                        <div class="skill-category-name">{{ $t($category)->name }}</div>
                        @foreach ($category->skills as $skill)
                            @php $skillT = $t($skill); @endphp
                            <span class="skill-chip">
                                <span class="skill-chip-name">{{ $skillT->name }}</span>
                                @if ($skill->years_experience ?? null)
                                    <span class="skill-years">— {{ $skill->years_experience }}y</span>
                                @endif
                                @if (!is_null($skill->level))
                                    <span class="skill-percent">{{ min(100, $skill->level) }}%</span>
                                @endif
                            </span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif

        {{-- =========================================
             EXPERIENCE
             ========================================= --}}
        @if (in_array('experience', $sections) && $experiences->isNotEmpty())
            <div class="cv-section">
                <div class="cv-section-title"><span
                        class="cv-section-title-mark"></span>{{ __('publicCv.sections.experience') }}</div>
                @foreach ($experiences as $experience)
                    @php $expT = $t($experience); @endphp
                    <div class="entry">
                        <table class="entry-header">
                            <tr>
                                <td>
                                    <div class="entry-title">{{ $expT->position }}</div>
                                    <div class="entry-subtitle">{{ $experience->company }}</div>
                                    @if ($experience->location ?? null)
                                        <div class="entry-meta">{{ $experience->location }}</div>
                                    @endif
                                </td>
                                <td class="entry-dates" style="width: 110px;">
                                    {{ optional($experience->start_date)->format('M Y') }}
                                    –
                                    {{ $experience->current ? __('publicCv.present') : optional($experience->end_date)->format('M Y') }}
                                </td>
                            </tr>
                        </table>
                        @if ($expT->description ?? null)
                            <div class="entry-description">{{ $expT->description }}</div>
                        @endif
                        @if (($experience->technologies ?? null) && count($experience->technologies))
                            <div style="margin-top: 5px;">
                                @foreach ($experience->technologies as $tech)
                                    <span class="tag">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- =========================================
             EDUCATION
             ========================================= --}}
        @if (in_array('education', $sections) && $education->isNotEmpty())
            <div class="cv-section">
                <div class="cv-section-title"><span
                        class="cv-section-title-mark"></span>{{ __('publicCv.sections.education') }}</div>
                @foreach ($education as $edu)
                    @php $eduT = $t($edu); @endphp
                    <div class="entry">
                        <table class="entry-header">
                            <tr>
                                <td>
                                    <div class="entry-title">
                                        {{ $eduT->degree }}{{ $eduT->field ?? null ? ', ' . $eduT->field : '' }}
                                    </div>
                                    <div class="entry-subtitle">{{ $eduT->institution }}</div>
                                    @if ($eduT->location ?? null)
                                        <div class="entry-meta">{{ $eduT->location }}</div>
                                    @endif
                                </td>
                                <td class="entry-dates" style="width: 110px;">
                                    {{ optional($edu->start_date)->format('Y') }}
                                    –
                                    {{ $edu->current ? __('publicCv.present') : optional($edu->end_date)->format('Y') }}
                                </td>
                            </tr>
                        </table>
                        @if ($eduT->description ?? null)
                            <div class="entry-description">{{ $eduT->description }}</div>
                        @endif
                        @if (!is_null($edu->score ?? null))
                            <div class="entry-score">{{ __('publicCv.score') }}: {{ $edu->score }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- =========================================
             PROJECTS
             ========================================= --}}
        @if (in_array('projects', $sections) && $projects->isNotEmpty())
            <div class="cv-section">
                <div class="cv-section-title"><span
                        class="cv-section-title-mark"></span>{{ __('publicCv.sections.projects') }}</div>
                @foreach ($projects as $project)
                    @php $projectT = $t($project); @endphp
                    <div class="entry">
                        <table class="entry-header">
                            <tr>
                                <td>
                                    <div class="entry-title">{{ $projectT->title }}</div>
                                    <div>
                                        @if ($project->type ?? null)
                                            <span class="project-badge"
                                                style="background: {{ $project->type->color ?? '#4338ca' }};">
                                                {{ $t($project->type)->name }}
                                            </span>
                                        @endif
                                        @if ($project->status ?? null)
                                            <span class="project-badge"
                                                style="background: {{ $project->status->color ?? '#475569' }};">
                                                {{ $t($project->status)->name }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                        @if ($projectT->description ?? null)
                            <div class="entry-description">{{ $projectT->description }}</div>
                        @endif
                        @if (($project->technologies ?? null) && count($project->technologies))
                            <div style="margin-top: 5px;">
                                @foreach ($project->technologies as $tech)
                                    <span class="tag">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif
                        @if (($project->github_url ?? null) || ($project->live_url ?? null))
                            <div class="project-links">
                                @if ($project->live_url ?? null)
                                    <a href="{{ $project->live_url }}">{{ __('publicCv.live_url') }}</a>
                                @endif
                                @if ($project->github_url ?? null)
                                    <a href="{{ $project->github_url }}">{{ __('publicCv.github_url') }}</a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- =========================================
             CERTIFICATES
             ========================================= --}}
        @if (in_array('certificates', $sections) && $certifications->isNotEmpty())
            <div class="cv-section">
                <div class="cv-section-title"><span
                        class="cv-section-title-mark"></span>{{ __('publicCv.sections.certificates') }}</div>
                @foreach ($certifications as $cert)
                    @php $certT = $t($cert); @endphp
                    <div class="certificate">
                        <div class="certificate-title">{{ $certT->title }}</div>
                        <div class="certificate-issuer">
                            {{ $certT->issuer_name }}{{ $certT->issuer_country ?? null ? ' — ' . $certT->issuer_country : '' }}
                        </div>
                        <div class="certificate-date">
                            {{ optional($cert->issue_date)->format('M Y') }}
                            @if ($cert->expiration_date ?? null)
                                – {{ optional($cert->expiration_date)->format('M Y') }}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</body>

</html>
