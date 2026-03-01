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

        $messages = Message::where(function($q) use ($me, $user) {
            $q->where('sender_id', $me->id)->where('receiver_id', $user->id);
        })->orWhere(function($q) use ($me, $user) {
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
            'body' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => $me->id,
            'receiver_id' => $user->id,
            'body' => $request->body,
            'read' => false,
        ]);

        // if receiver is mentor, we may flash a notification for them
        if ($user->role === 'mentor') {
            session()->flash('success', __('New message from :name', ['name' => $me->name]));
        }

        return back();
    }
}
