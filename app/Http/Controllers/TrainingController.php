<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\CareerPath;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::with('careerPath')->latest()->get();
        return view('trainings.index', compact('trainings'));
    }

    public function create()
    {
        $careerPaths = CareerPath::all();
        return view('trainings.create', compact('careerPaths'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'career_path_id' => 'required|exists:career_paths,id',
        ]);

        Training::create($request->all());

        return redirect()->route('trainings.index')->with('success', 'Training created successfully.');
    }

    public function show(Training $training)
    {
        $training->load('careerPath');
        return view('trainings.show', compact('training'));
    }

    public function edit(Training $training)
    {
        $careerPaths = CareerPath::all();
        return view('trainings.edit', compact('training', 'careerPaths'));
    }

    public function update(Request $request, Training $training)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'career_path_id' => 'required|exists:career_paths,id',
        ]);

        $training->update($request->all());

        return redirect()->route('trainings.index')->with('success', 'Training updated successfully.');
    }

    public function destroy(Training $training)
    {
        $training->delete();
        return redirect()->route('trainings.index')->with('success', 'Training deleted successfully.');
    }
}
