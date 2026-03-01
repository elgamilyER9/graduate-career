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
    public function index(Request $request)
    {
        $role = $request->get('role');   // 'admin', 'mentor', 'user', or null (all)
        $search = $request->get('search'); // name or email search

        $query = User::with(['university', 'faculty', 'careerPath']);

        if ($role) {
            $query->where('role', $role);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->get();

        // Counts for filter tabs
        $counts = [
            'all' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'mentor' => User::where('role', 'mentor')->count(),
            'user' => User::where('role', 'user')->count(),
        ];

        return view('users.index', compact('users', 'counts', 'role', 'search'));
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
            // role comes from hidden input -> always mentor
            'role' => 'required|string|in:mentor',
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
        // Only admins or the user themselves can edit
        if (auth()->user()->role !== 'admin' && auth()->user()->id !== $user->id) {
            abort(403, 'غير مصرح لك بتعديل بيانات مستخدم آخر.');
        }

        $universities = University::all();
        $faculties = Faculty::all();
        $careerPaths = CareerPath::all();
        return view('users.edit', compact('user', 'universities', 'faculties', 'careerPaths'));
    }

    public function update(Request $request, User $user)
    {
        // Only admins or the user themselves can update
        if (auth()->user()->role !== 'admin' && auth()->user()->id !== $user->id) {
            abort(403, 'غير مصرح لك بتعديل بيانات مستخدم آخر.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:user,mentor,admin',
            'university_id' => 'nullable|exists:universities,id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'career_path_id' => 'nullable|exists:career_paths,id',
        ]);

        $data = $request->only(['name', 'email', 'university_id', 'faculty_id', 'career_path_id']);

        // Only admins can change role. Users can only edit their own profile
        if (auth()->user()->role === 'admin') {
            $data['role'] = $request->role;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Only admins can delete users
        if (auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك بحذف هذا المستخدم. فقط الـ Admin يمكنه الحذف.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
