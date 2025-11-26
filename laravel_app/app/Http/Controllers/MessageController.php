<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = \App\Models\Message::where('recipient_id', auth()->id())
            ->orWhere('sender_id', auth()->id())
            ->with(['sender', 'recipient'])
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $validated['recipient_id'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
}
