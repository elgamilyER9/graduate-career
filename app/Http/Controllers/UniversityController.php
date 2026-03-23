<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::latest()->get();
        return view('universities.index', compact('universities'));
    }

    public function create()
    {
        return view('universities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:universities',
        ]);

        University::create($request->all());

        return redirect()->route('universities.index')->with('success', 'University created successfully.');
    }

    public function show(University $university)
    {
        return view('universities.show', compact('university'));
    }

    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }

    public function update(Request $request, University $university)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:universities,name,' . $university->id,
        ]);

        $university->update($request->all());

        return redirect()->route('universities.index')->with('success', 'University updated successfully.');
    }

    public function destroy(University $university)
    {
        // Only admins can delete universities
        if (auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك بحذف هذه الجامعة. فقط الـ Admin يمكنه الحذف.');
        }

        $university->delete();
        return redirect()->route('universities.index')->with('success', 'University deleted successfully.');
    }
}
