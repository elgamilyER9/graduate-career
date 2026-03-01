<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Training;
use App\Models\User;
use App\Models\Skill;
use App\Models\CareerPath;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Perform global search
     */
    public function index(Request $request)
    {
        $query = $request->input('q', '');
        $type = $request->input('type', 'all');
        $results = [];
        $total = 0;

        if (strlen($query) < 2) {
            return response()->json([
                'status' => false,
                'message' => __('Search query must be at least 2 characters.'),
                'results' => [],
                'total' => 0
            ]);
        }

        // Search jobs
        if ($type === 'all' || $type === 'jobs') {
            $jobs = Job::where('title', 'LIKE', "%{$query}%")
                ->orWhere('company', 'LIKE', "%{$query}%")
                ->with('mentor')
                ->limit(5)
                ->get();

            $results['jobs'] = $jobs->map(function ($job) {
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'company' => $job->company,
                    'mentor' => $job->mentor->name,
                    'url' => route('jobs.show', $job),
                    'type' => 'job'
                ];
            });
            $total += $jobs->count();
        }

        // Search trainings
        if ($type === 'all' || $type === 'trainings') {
            $trainings = Training::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->with('mentor')
                ->limit(5)
                ->get();

            $results['trainings'] = $trainings->map(function ($training) {
                return [
                    'id' => $training->id,
                    'title' => $training->title,
                    'mentor' => $training->mentor->name,
                    'url' => route('trainings.show', $training),
                    'type' => 'training'
                ];
            });
            $total += $trainings->count();
        }

        // Search mentors
        if ($type === 'all' || $type === 'mentors') {
            $mentors = User::where('role', 'mentor')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%");
                })
                ->limit(5)
                ->get();

            $results['mentors'] = $mentors->map(function ($mentor) {
                return [
                    'id' => $mentor->id,
                    'name' => $mentor->name,
                    'email' => $mentor->email,
                    'url' => route('users.show', $mentor),
                    'type' => 'mentor'
                ];
            });
            $total += $mentors->count();
        }

        // Search skills
        if ($type === 'all' || $type === 'skills') {
            $skills = Skill::where('name', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get();

            $results['skills'] = $skills->map(function ($skill) {
                return [
                    'id' => $skill->id,
                    'name' => $skill->name,
                    'url' => route('skills.show', $skill),
                    'type' => 'skill'
                ];
            });
            $total += $skills->count();
        }

        return response()->json([
            'status' => true,
            'query' => $query,
            'results' => $results,
            'total' => $total
        ]);
    }

    /**
     * Advanced search page
     */
    public function advanced(Request $request)
    {
        $query = $request->input('q', '');
        $type = $request->input('type', 'all');
        $results = [];

        if ($query) {
            $results = $this->performSearch($query, $type);
        }

        return view('search.index', compact('query', 'type', 'results'));
    }

    /**
     * Perform search across multiple models
     */
    private function performSearch($query, $type)
    {
        $results = [];

        if ($type === 'all' || $type === 'jobs') {
            $results['jobs'] = Job::where('title', 'LIKE', "%{$query}%")
                ->orWhere('company', 'LIKE', "%{$query}%")
                ->with('mentor')
                ->paginate(10);
        }

        if ($type === 'all' || $type === 'trainings') {
            $results['trainings'] = Training::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->with('mentor')
                ->paginate(10);
        }

        if ($type === 'all' || $type === 'mentors') {
            $results['mentors'] = User::where('role', 'mentor')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%");
                })
                ->paginate(10);
        }

        return $results;
    }
}
