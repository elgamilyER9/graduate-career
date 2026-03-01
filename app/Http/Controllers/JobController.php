<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\CareerPath;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $jobTitles = [
        'Backend Developer',
        'Frontend Developer',
        'Full Stack Developer',
        'Mobile Developer',
        'UI/UX Designer',
        'Data Scientist',
        'DevOps Engineer',
        'Quality Assurance (QA)',
        'Digital Marketer',
        'Project Manager',
        'Graphic Designer',
        'HR Specialist'
    ];

    public function index(Request $request)
    {
        $search = $request->query('search');

        $jobs = Job::with('careerPath')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        $myApplications = [];
        if (auth()->check()) {
            $myApplications = \App\Models\JobApplication::where('user_id', auth()->id())
                ->pluck('status', 'job_id')
                ->toArray();
        }

        return view('jobs.index', compact('jobs', 'search', 'myApplications'));
    }

    public function create()
    {
        $careerPaths = CareerPath::all();
        $jobTitles = $this->jobTitles;
        return view('jobs.create', compact('careerPaths', 'jobTitles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'career_path_id' => 'required|exists:career_paths,id',
        ]);

        $data = $request->all();
        if (auth()->user()->role === 'mentor') {
            $data['mentor_id'] = auth()->id();
        }

        Job::create($data);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function show(Job $job)
    {
        $job->load('careerPath');
        $applicationStatus = null;
        if (auth()->check()) {
            $applicationStatus = \App\Models\JobApplication::where('user_id', auth()->id())
                ->where('job_id', $job->id)
                ->value('status');
        }
        return view('jobs.show', compact('job', 'applicationStatus'));
    }

    public function edit(Job $job)
    {
        // Only admins or the mentor who created it can edit
        if (auth()->user()->role !== 'admin' && (auth()->user()->role !== 'mentor' || auth()->user()->id !== $job->mentor_id)) {
            abort(403, 'Unauthorized');
        }

        $careerPaths = CareerPath::all();
        $jobTitles = $this->jobTitles;
        return view('jobs.edit', compact('job', 'careerPaths', $jobTitles));
    }

    public function update(Request $request, Job $job)
    {
        // Only admins or the mentor who created it can update
        if (auth()->user()->role !== 'admin' && (auth()->user()->role !== 'mentor' || auth()->user()->id !== $job->mentor_id)) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'career_path_id' => 'required|exists:career_paths,id',
        ]);

        $job->update($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        // Only admins and the owner mentor can delete jobs
        if (auth()->user()->role !== 'admin' && (auth()->user()->role !== 'mentor' || auth()->user()->id !== $job->mentor_id)) {
            abort(403, 'غير مصرح لك بحذف هذه الوظيفة. فقط الـ Admin أو صاحب الوظيفة يمكنه الحذف.');
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
