<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\University;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::with('university')->latest()->get();
        return view('faculties.index', compact('faculties'));
    }

    public function create()
    {
        $universities = University::all();
        return view('faculties.create', compact('universities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'university_id' => 'required|exists:universities,id',
        ]);

        Faculty::create($request->all());

        return redirect()->route('faculties.index')->with('success', 'Faculty created successfully.');
    }

    public function show(Faculty $faculty)
    {
        $faculty->load('university');
        return view('faculties.show', compact('faculty'));
    }

    public function edit(Faculty $faculty)
    {
        $universities = University::all();
        return view('faculties.edit', compact('faculty', 'universities'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'university_id' => 'required|exists:universities,id',
        ]);

        $faculty->update($request->all());

        return redirect()->route('faculties.index')->with('success', 'Faculty updated successfully.');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', 'Faculty deleted successfully.');
    }
}
