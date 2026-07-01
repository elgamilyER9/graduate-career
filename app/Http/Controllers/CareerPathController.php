<?php

namespace App\Http\Controllers;

use App\Models\CareerPath;
use Illuminate\Http\Request;

class CareerPathController extends Controller
{
    public function index()
    {
        $careerPaths = CareerPath::latest()->get();
        return view('career_paths.index', compact('careerPaths'));
    }

    public function create()
    {
        return view('career_paths.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:career_paths',
            'description' => 'nullable|string',
        ]);

        CareerPath::create($request->all());

        return redirect()->route('career_paths.index')->with('success', 'Career Path created successfully.');
    }

    public function show(CareerPath $career_path)
    {
        $career_path->load(['jobs', 'skills', 'trainings']);
        return view('career_paths.show', ['careerPath' => $career_path]);
    }

    public function edit(CareerPath $career_path)
    {
        return view('career_paths.edit', ['careerPath' => $career_path]);
    }

    public function update(Request $request, CareerPath $career_path)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:career_paths,name,' . $career_path->id,
            'description' => 'nullable|string',
        ]);

        $career_path->update($request->all());

        return redirect()->route('career_paths.index')->with('success', 'Career Path updated successfully.');
    }

    public function destroy(CareerPath $career_path)
    {
        // Only admins can delete career paths
        if (auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك بحذف هذا مسار الوظيفة. فقط الـ Admin يمكنه الحذف.');
        }

        $career_path->delete();
        return redirect()->route('career_paths.index')->with('success', 'Career Path deleted successfully.');
    }
}
