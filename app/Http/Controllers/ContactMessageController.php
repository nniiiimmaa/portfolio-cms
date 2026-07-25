<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Throwable;

class ContactMessageController extends Controller
{
    public function index(){
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();

        return Inertia::render('Message/MessageIndex', ['messages' => $messages]);
    }

    public function store(StoreContactMessageRequest $request)
    {
        try {

            ContactMessage::create([
                ...$request->validated(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referrer' => $request->headers->get('referer'),
                'status' => 'new',
            ]);

            return back()->with(
                'success',
                __('contact.success')
            );

        } catch (Throwable $exception) {

            Log::error('Failed to store contact message.', [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);

            throw ValidationException::withMessages([
                'general' => __('contact.error'),
            ]);
        }
    }
}
