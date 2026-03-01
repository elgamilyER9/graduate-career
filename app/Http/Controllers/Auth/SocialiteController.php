<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedInCallback()
    {
        try {
            $linkedinUser = Socialite::driver('linkedin')->user();

            $user = User::where('linkedin_id', $linkedinUser->id)
                ->orWhere('email', $linkedinUser->email)
                ->first();

            if ($user) {
                $user->update([
                    'linkedin_id' => $linkedinUser->id,
                    'linkedin_avatar' => $linkedinUser->avatar,
                ]);
            } else {
                $user = User::create([
                    'name' => $linkedinUser->name,
                    'email' => $linkedinUser->email,
                    'linkedin_id' => $linkedinUser->id,
                    'linkedin_avatar' => $linkedinUser->avatar,
                    'password' => bcrypt(Str::random(24)),
                    'role' => 'student', // Default role
                ]);
            }

            Auth::login($user);

            return redirect()->intended('home');
        } catch (\Exception $e) {
            return redirect('login')->with('error', 'Something went wrong while logging in with LinkedIn.');
        }
    }
}
