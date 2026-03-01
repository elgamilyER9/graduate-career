<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\University;
use App\Models\Faculty;
use App\Models\CareerPath;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $universities = University::all();
        $faculties = Faculty::all();
        $careerPaths = CareerPath::all();

        return view('auth.register', compact('universities', 'faculties', 'careerPaths'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:user,mentor'],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'university_id' => [
                'nullable',
                'required_if:role,user',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $value !== 'other' && !University::where('id', $value)->exists()) {
                        $fail(__('The selected university is invalid.'));
                    }
                    if ($value === 'other' && empty($request->other_university)) {
                        $fail(__('Please enter your university name.'));
                    }
                }
            ],
            'faculty_id' => [
                'nullable',
                'required_if:role,user',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $value !== 'other' && !Faculty::where('id', $value)->exists()) {
                        $fail(__('The selected faculty is invalid.'));
                    }
                    if ($value === 'other' && empty($request->other_faculty)) {
                        $fail(__('Please enter your faculty name.'));
                    }
                }
            ],
            'career_path_id' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $value !== 'other' && !CareerPath::where('id', $value)->exists()) {
                        $fail(__('The selected career path is invalid.'));
                    }
                    if ($value === 'other' && empty($request->other_career_path)) {
                        $fail(__('Please enter your custom career path.'));
                    }
                }
            ],
            'other_university' => ['nullable', 'string', 'max:255'],
            'other_faculty' => ['nullable', 'string', 'max:255'],
            'other_career_path' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'years_experience' => ['nullable', 'integer', 'min:0'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
        ]);

        $universityId = $request->university_id === 'other' ? null : $request->university_id;
        $facultyId = $request->faculty_id === 'other' ? null : $request->faculty_id;
        $careerPathId = $request->career_path_id === 'other' ? null : $request->career_path_id;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'university_id' => $universityId,
            'faculty_id' => $facultyId,
            'career_path_id' => $careerPathId,
            'other_university' => $request->other_university,
            'other_faculty' => $request->other_faculty,
            'other_career_path' => $request->other_career_path,
            'job_title' => $request->job_title,
            'company' => $request->company,
            'years_experience' => $request->years_experience,
            'linkedin_url' => $request->linkedin_url,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
