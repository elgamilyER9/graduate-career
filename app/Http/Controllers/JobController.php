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

    public function index()
    {
        $jobs = Job::with('careerPath')->latest()->get();
        return view('jobs.index', compact('jobs'));
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

        Job::create($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function show(Job $job)
    {
        $job->load('careerPath');
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        $careerPaths = CareerPath::all();
        $jobTitles = $this->jobTitles;
        return view('jobs.edit', compact('job', 'careerPaths', 'jobTitles'));
    }

    public function update(Request $request, Job $job)
    {
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
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
