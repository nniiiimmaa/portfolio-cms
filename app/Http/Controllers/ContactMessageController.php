<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
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

    public function updateRead(ContactMessage $message)
    {
        try {

            if ($message->status === 'new') {

                $message->update([
                    'status' => 'read',
                    'read_at' => now(),
                ]);

            }

            return redirect()
                ->back()
                ->with('success', 'Message marked as read successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to mark message as read.', [
                'user_id' => auth()->id(),
                'message_id' => $message->id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'message' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update message status.',
                ]);
        }
    }

    public function updateReply(ContactMessage $message)
    {
        try {

            $message->update([
                'status' => 'replied',
                'replied_at' => now(),
                'read_at' => now()
            ]);

            return redirect()
                ->back()
                ->with('success', 'Message marked as replied successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to mark message as replied.', [
                'user_id' => auth()->id(),
                'message_id' => $message->id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'message' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update message status.',
                ]);
        }
    }
}
