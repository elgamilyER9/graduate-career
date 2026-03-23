<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show conversation between auth user and other user.
     */
    public function show(User $user)
    {
        $me = auth()->user();

        // ensure they are connected (either student->mentor or mentor->student)
        // for simplicity, allow any two users for now

        $messages = Message::where(function ($q) use ($me, $user) {
            $q->where('sender_id', $me->id)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($me, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $me->id);
        })->orderBy('created_at')->get();

        // mark received messages as read
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $me->id)
            ->where('read', false)
            ->update(['read' => true]);

        return view('messages.show', compact('user', 'messages'));
    }

    /**
     * Store a new message to a particular user.
     */
    public function store(Request $request, User $user)
    {
        $me = auth()->user();

        $request->validate([
            'body' => 'nullable|string|max:1000',
            'file' => 'nullable|file|max:10240', // 10MB max
        ]);

        if (!$request->body && !$request->hasFile('file')) {
            return back()->with('error', __('Message or file is required.'));
        }

        $messageData = [
            'sender_id' => $me->id,
            'receiver_id' => $user->id,
            'body' => $request->body,
            'read' => false,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('chat_files', 'public');

            $messageData['file_path'] = $path;
            $messageData['file_name'] = $file->getClientOriginalName();
            $messageData['file_type'] = $file->getClientMimeType();
        }

        $message = Message::create($messageData);

        // if receiver is mentor, we may flash a notification for them
        if ($user->role === 'mentor') {
            // Optional: send real notification logic here if needed
        }

        return back();
    }

    /**
     * Download message attachment
     */
    public function download(Message $message)
    {
        if ($message->sender_id !== auth()->id() && $message->receiver_id !== auth()->id()) {
            abort(403);
        }

        if (!$message->file_path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($message->file_path)) {
            abort(404);
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->download($message->file_path, $message->file_name);
    }
}
