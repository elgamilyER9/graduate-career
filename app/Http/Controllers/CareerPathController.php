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

    public function show(CareerPath $careerPath)
    {
        $careerPath->load(['jobs', 'skills', 'trainings']);
        return view('career_paths.show', compact('careerPath'));
    }

    public function edit(CareerPath $careerPath)
    {
        return view('career_paths.edit', compact('careerPath'));
    }

    public function update(Request $request, CareerPath $careerPath)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:career_paths,name,' . $careerPath->id,
            'description' => 'nullable|string',
        ]);

        $careerPath->update($request->all());

        return redirect()->route('career_paths.index')->with('success', 'Career Path updated successfully.');
    }

    public function destroy(CareerPath $careerPath)
    {
        // Only admins can delete career paths
        if (auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك بحذف هذا مسار الوظيفة. فقط الـ Admin يمكنه الحذف.');
        }

        $careerPath->delete();
        return redirect()->route('career_paths.index')->with('success', 'Career Path deleted successfully.');
    }
}
