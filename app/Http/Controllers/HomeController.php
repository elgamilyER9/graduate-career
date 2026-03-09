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
use App\Models\JobApplication;
use App\Models\File;
use App\Models\Notification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function front()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $data = [
                'usersCount' => User::count(),
                'jobsCount' => Job::count(),
                'mentorsCount' => User::where('role', 'mentor')->count(),
            ];
            return view('pages.front', $data);
        } elseif ($user->role === 'mentor') {
            $data = [
                'activeJobsCount' => Job::where('mentor_id', $user->id)->count(),
                'activeTrainingsCount' => Training::where('mentor_id', $user->id)->count(),
                'menteesCount' => MentorshipRequest::where('mentor_id', $user->id)->where('status', 'approved')->count(),
                'recentApplications' => JobApplication::where('mentor_id', $user->id)
                    ->where('status', 'pending')
                    ->latest()
                    ->take(3)
                    ->get(),
            ];
            return view('pages.front', $data);
        } else {
            // User role
            $data = [
                'featuredJobs' => Job::latest()->take(4)->get(),
                'featuredTrainings' => Training::latest()->take(3)->with('mentor')->get(),
                'topMentors' => User::where('role', 'mentor')->latest()->take(4)->with(['university', 'faculty'])->get(),
            ];
            return view('pages.front', $data);
        }
    }

    public function index()
    {
        $user = auth()->user();

        // compute unread messages for any user
        $unreadMessagesCount = \App\Models\Message::where('receiver_id', $user->id)->where('read', false)->count();

        // Proactive check for table existence to help user debug
        $mentorshipTableExists = \Illuminate\Support\Facades\Schema::hasTable('mentorship_requests');
        if (!$mentorshipTableExists) {
            session()->flash('error', 'Database requires migration. Please run: php artisan migrate');
        }

        if ($user->role === 'admin') {
            $stats = [
                // Core counts
                'usersCount' => User::count(),
                'mentorsCount' => User::where('role', 'mentor')->count(),
                'studentsCount' => User::where('role', 'user')->count(),
                'jobsCount' => Job::count(),
                'skillsCount' => Skill::count(),
                'trainingsCount' => Training::count(),
                'careerPathsCount' => CareerPath::count(),
                'facultiesCount' => Faculty::count(),
                'universitiesCount' => University::count(),
                // Application stats
                'applicationsCount' => JobApplication::count(),
                'pendingAppsCount' => JobApplication::where('status', 'pending')->count(),
                'approvedAppsCount' => JobApplication::where('status', 'approved')->count(),
                'mentorshipCount' => MentorshipRequest::count(),
                'pendingMentorshipCount' => MentorshipRequest::where('status', 'pending')->count(),
                // Recent data for tables
                'recentUsers' => User::latest()->take(8)->with(['university', 'faculty'])->get(),
                'recentJobs' => Job::latest()->take(6)->with('mentor')->get(),
                'recentApplications' => JobApplication::latest()->take(8)->with(['user', 'job'])->get(),
                'recentMentorship' => MentorshipRequest::latest()->take(6)->with(['student', 'mentor'])->get(),
                'unreadMessagesCount' => $unreadMessagesCount,
                // Notifications for admin
                'allNotifications' => Notification::with('user')->latest()->take(10)->get(),
                'unreadAdminNotifications' => Notification::where('user_id', $user->id)->where('read', false)->count(),
                'totalNotificationsCount' => Notification::count(),
                // Files for admin
                'allFiles' => File::with('user')->latest()->take(10)->get(),
                'filesCount' => File::count(),
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
                'myTrainings' => Training::where('mentor_id', $user->id)
                    ->withCount('enrollments')
                    ->withCount([
                        'enrollments as pending_enrollments_count' => function ($q) {
                            $q->where('status', 'pending');
                        }
                    ])->latest()->get(),
                'pendingEnrollmentsCount' => \App\Models\TrainingEnrollment::whereHas('training', function ($q) use ($user) {
                    $q->where('mentor_id', $user->id);
                })->where('status', 'pending')->count(),
                'pendingEnrollments' => \App\Models\TrainingEnrollment::whereHas('training', function ($q) use ($user) {
                    $q->where('mentor_id', $user->id);
                })->where('status', 'pending')
                    ->with(['user', 'training'])
                    ->latest()
                    ->get(),
                'pendingJobApplicationsCount' => JobApplication::where('mentor_id', $user->id)->where('status', 'pending')->count(),
                'pendingJobApplications' => JobApplication::where('mentor_id', $user->id)
                    ->where('status', 'pending')
                    ->with(['user', 'job'])
                    ->latest()
                    ->get(),
                'myJobApplications' => $this->getMentorAppsFromAdmin($user->id),
                'myJobs' => Job::where('mentor_id', $user->id)->latest()->get(),
                'jobsCount' => Job::count(),
                'trainingsCount' => Training::count(),
                'unreadMessagesCount' => $unreadMessagesCount,
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
                'availableTrainings' => Training::latest()->take(5)->with('mentor')->get(),
                'recentJobs' => Job::latest()->take(5)->get(),
                'myApplications' => JobApplication::where('user_id', $user->id)
                    ->get()
                    ->keyBy('job_id'),
                'myTrainings' => \App\Models\TrainingEnrollment::where('user_id', $user->id)
                    ->with(['training.mentor'])
                    ->latest()
                    ->get(),
                'unreadMessagesCount' => $unreadMessagesCount,
            ];
            return view('dashboards.user', $data);
        }
    }

    public function mentors()
    {
        $user = auth()->user();
        $mentors = User::where('role', 'mentor')->with(['university', 'faculty'])->get();

        // load any requests the current user has already sent so we can disable/hide the button
        $myRequests = [];
        if ($user) {
            $myRequests = MentorshipRequest::where('user_id', $user->id)
                ->get()
                ->keyBy('mentor_id');
        }

        return view('pages.mentors', compact('mentors', 'myRequests'));
    }


    public function connections()
    {
        $user = auth()->user();

        // 1. Get approved mentorship connections
        if ($user->role === 'mentor') {
            $mentorConnections = MentorshipRequest::where('mentor_id', $user->id)
                ->where('status', 'approved')
                ->with('student')
                ->get()
                ->pluck('student_id')
                ->toArray();
        } else {
            $mentorConnections = MentorshipRequest::where('user_id', $user->id)
                ->where('status', 'approved')
                ->with('mentor')
                ->get()
                ->pluck('mentor_id')
                ->toArray();
        }

        // 2. Get users you've messaged or who messaged you
        $messagedUsers = \App\Models\Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->get()
            ->map(function ($msg) use ($user) {
                return $msg->sender_id === $user->id ? $msg->receiver_id : $msg->sender_id;
            })
            ->unique()
            ->toArray();

        // 3. Combine and fetch users
        $allConnectionIds = array_unique(array_merge($mentorConnections, $messagedUsers));

        $connections = User::whereIn('id', $allConnectionIds)
            ->with(['university', 'faculty'])
            ->get();

        return view('pages.connections', compact('connections'));
    }

    public function community()
    {
        $users = User::latest()->take(20)->get();
        return view('pages.community', compact('users'));
    }

    /**
     * Get job applications for mentor from admin-curated list
     * This method fetches applications that the admin has assigned or approved for the mentor to review
     * 
     * @param int $mentorId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMentorAppsFromAdmin($mentorId)
    {
        // Fetch job applications where this mentor is responsible for reviewing/managing
        // These are applications where mentor_id is set (admin assigned this mentor to review these apps)
        return JobApplication::where('mentor_id', $mentorId)
            ->with(['job', 'mentor', 'user'])
            ->latest()
            ->get();
    }
}
