<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\University;
use App\Models\Faculty;
use App\Models\CareerPath;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'universities' => University::all(),
            'faculties' => Faculty::all(),
            'careerPaths' => CareerPath::all(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        try {
            \Illuminate\Support\Facades\Log::info('User Deletion Started: ' . $user->id);

            Auth::logout();

            // Ensure we handle potential session-related issues
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/')->with('success', 'Your account has been deleted successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('User Deletion Failed: ' . $user->id . ' - Error: ' . $e->getMessage());
            return back()->with('error', 'Could not delete account. There might be related records preventing this action.');
        }
    }
}
