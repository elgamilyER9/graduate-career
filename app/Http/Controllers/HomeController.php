<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Skill;
use App\Models\Training;
use App\Models\CareerPath;
use App\Models\Faculty;
use App\Models\University;
use App\Models\MentorshipRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        // Proactive check for table existence to help user debug
        $mentorshipTableExists = \Illuminate\Support\Facades\Schema::hasTable('mentorship_requests');
        if (!$mentorshipTableExists) {
            session()->flash('error', 'Database requires migration. Please run: php artisan migrate');
        }

        if ($user->role === 'admin') {
            $stats = [
                'usersCount' => User::count(),
                'jobsCount' => Job::count(),
                'skillsCount' => Skill::count(),
                'trainingsCount' => Training::count(),
                'careerPathsCount' => CareerPath::count(),
                'facultiesCount' => Faculty::count(),
                'universitiesCount' => University::count(),
            ];
            return view('dashboards.admin', $stats);
        } elseif ($user->role === 'mentor') {
            $data = [
                'totalStudents' => User::where('role', 'user')->count(),
                'myMenteesCount' => $mentorshipTableExists ? MentorshipRequest::where('mentor_id', $user->id)->where('status', 'approved')->count() : 0,
                'pendingRequestsCount' => $mentorshipTableExists ? MentorshipRequest::where('mentor_id', $user->id)->where('status', 'pending')->count() : 0,
                'latestGraduates' => User::where('role', 'user')->latest()->take(5)->get(),
                'pendingRequests' => $mentorshipTableExists ? MentorshipRequest::where('mentor_id', $user->id)
                    ->where('status', 'pending')
                    ->with('student')
                    ->latest()
                    ->get() : collect(),
                'jobsCount' => Job::count(),
                'trainingsCount' => Training::count(),
            ];
            return view('dashboards.mentor', $data);
        } else {
            $data = [
                'jobsCount' => Job::count(),
                'trainingsCount' => Training::count(),
                'skillsCount' => Skill::count(),
                'careerPathsCount' => CareerPath::count(),
                'mentors' => User::where('role', 'mentor')->get(),
                'myRequests' => $mentorshipTableExists ? MentorshipRequest::where('user_id', $user->id)
                    ->with('mentor')
                    ->latest()
                    ->get() : collect(),
                'pendingRequestsCount' => $mentorshipTableExists ? MentorshipRequest::where('user_id', $user->id)->where('status', 'pending')->count() : 0,
            ];
            return view('dashboards.user', $data);
        }
    }

    public function mentors()
    {
        $mentors = User::where('role', 'mentor')->with(['university', 'faculty'])->get();
        return view('pages.mentors', compact('mentors'));
    }

    public function connections()
    {
        $user = auth()->user();
        if ($user->role === 'mentor') {
            $connections = MentorshipRequest::where('mentor_id', $user->id)
                ->where('status', 'approved')
                ->with('student')
                ->get();
        } else {
            $connections = MentorshipRequest::where('user_id', $user->id)
                ->where('status', 'approved')
                ->with('mentor')
                ->get();
        }
        return view('pages.connections', compact('connections'));
    }

    public function community()
    {
        $users = User::latest()->take(20)->get();
        return view('pages.community', compact('users'));
    }
}
