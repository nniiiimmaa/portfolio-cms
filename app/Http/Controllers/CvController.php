<?php

namespace App\Http\Controllers;

use App\Services\CvPdfService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class CvController extends Controller
{
    public function generate(Request $request, CvPdfService $cvPdfService)
    {
        $validated = $request->validate([
            'sections' => ['required', 'array', 'min:1'],
            'sections.*' => ['string', Rule::in(CvPdfService::AVAILABLE_SECTIONS)],
        ]);
 
        $data = $cvPdfService->build($validated['sections']);
 
        // Bail out cleanly if every requested section resolved to nothing
        // (e.g. only "about" was picked but there's no About row yet).
        abort_if(collect($data)->except('sections')->every(fn ($v) => blank($v)), 422, 'Nothing to generate.');
 
        $ownerName = optional($data['about'])->name
            ?? config('app.name', 'cv');
 
        $pdf = Pdf::loadView('pdf.cv', $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isRemoteEnabled', true); // needed if avatar/project images are remote URLs
 
        $fileName = Str::slug($ownerName) . '-cv-' . now()->format('Y-m-d') . '.pdf';
 
        return $pdf->download($fileName);
    }
}
