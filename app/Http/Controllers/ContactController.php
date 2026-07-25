<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function edit(){
        $contact = Contact::with('translations')
            ->first();

        return Inertia::render('Contact/ContactEdit', ['contact' => $contact]);
    }
}
