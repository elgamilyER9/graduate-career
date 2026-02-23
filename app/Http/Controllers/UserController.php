<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\University;
use App\Models\Faculty;
use App\Models\CareerPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['university', 'faculty', 'careerPath'])->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $universities = University::all();
        $faculties = Faculty::all();
        $careerPaths = CareerPath::all();
        return view('users.create', compact('universities', 'faculties', 'careerPaths'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'university_id' => 'nullable|exists:universities,id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'career_path_id' => 'nullable|exists:career_paths,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'university_id' => $request->university_id,
            'faculty_id' => $request->faculty_id,
            'career_path_id' => $request->career_path_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->load(['university', 'faculty', 'careerPath']);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $universities = University::all();
        $faculties = Faculty::all();
        $careerPaths = CareerPath::all();
        return view('users.edit', compact('user', 'universities', 'faculties', 'careerPaths'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string',
            'university_id' => 'nullable|exists:universities,id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'career_path_id' => 'nullable|exists:career_paths,id',
        ]);

        $data = $request->only(['name', 'email', 'role', 'university_id', 'faculty_id', 'career_path_id']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
