<?php

namespace App\Http\Controllers;

use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorshipRequestController extends Controller
{
    /**
     * Store a new mentorship request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'message' => 'nullable|string|max:500',
        ]);

        // Check if a request already exists
        $exists = MentorshipRequest::where('user_id', Auth::id())
            ->where('mentor_id', $request->mentor_id)
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already have a pending request for this mentor.');
        }

        MentorshipRequest::create([
            'user_id' => Auth::id(),
            'mentor_id' => $request->mentor_id,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Mentorship request sent successfully!');
    }

    /**
     * Update the status of a mentorship request (Approve/Reject).
     */
    public function update(Request $request, MentorshipRequest $mentorshipRequest)
    {
        // Ensure the current user is the mentor for this request
        if ($mentorshipRequest->mentor_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $mentorshipRequest->update([
            'status' => $request->status,
        ]);

        $message = $request->status === 'approved'
            ? 'Request approved successfully!'
            : 'Request rejected.';

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $request->status
            ]);
        }

        return back()->with('success', $message);
    }

    /**
     * Remove the specified mentorship request from storage.
     */
    public function destroy(MentorshipRequest $mentorshipRequest)
    {
        // Ensure the current user is either the student or the mentor
        if ($mentorshipRequest->user_id !== Auth::id() && $mentorshipRequest->mentor_id !== Auth::id()) {
            abort(403);
        }

        $mentorshipRequest->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم إلغاء الطلب بنجاح.'
            ]);
        }

        return back()->with('success', 'Request cancelled successfully.');
    }
}
