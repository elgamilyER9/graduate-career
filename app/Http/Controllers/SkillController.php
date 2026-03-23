<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\CareerPath;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::with('careerPath')->latest()->get();
        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        $careerPaths = CareerPath::all();
        return view('skills.create', compact('careerPaths'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'career_path_id' => 'required|exists:career_paths,id',
        ]);

        Skill::create($request->all());

        return redirect()->route('skills.index')->with('success', 'Skill created successfully.');
    }

    public function show(Skill $skill)
    {
        $skill->load('careerPath');
        return view('skills.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        $careerPaths = CareerPath::all();
        return view('skills.edit', compact('skill', 'careerPaths'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'career_path_id' => 'required|exists:career_paths,id',
        ]);

        $skill->update($request->all());

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        // Only admins can delete skills
        if (auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك بحذف هذه المهارة. فقط الـ Admin يمكنه الحذف.');
        }

        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }
}
