<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificationController extends Controller
{
    public function index(){
        $certifications = Certification::with([ 'translations' ])
            ->orderBy('order')
            ->get();

        return Inertia::render('Certification/CertificationIndex', ['certifications' => $certifications]);
    }
}
