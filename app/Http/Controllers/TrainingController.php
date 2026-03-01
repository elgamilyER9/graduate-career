<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\CareerPath;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $trainings = Training::with(['careerPath', 'mentor'])
            ->when($query, function ($q) use ($query) {
                return $q->where('name', 'like', "%{$query}%")
                    ->orWhere('title', 'like', "%{$query}%")
                    ->orWhere('provider', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhereHas('careerPath', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    });
            })
            ->latest()
            ->get();

        return view('trainings.index', compact('trainings'));
    }

    public function create()
    {
        if (auth()->user()->role === 'user') {
            abort(403, 'Unauthorized');
        }

        $careerPaths = CareerPath::all();
        return view('trainings.create', compact('careerPaths'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role === 'user') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'provider' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'career_path_id' => 'required|exists:career_paths,id',
        ]);

        $data = $request->all();
        // If name is not provided, use title
        if (empty($data['name'])) {
            $data['name'] = $data['title'];
        }
        // Set mentor_id if user is a mentor
        if (auth()->user()->role === 'mentor') {
            $data['mentor_id'] = auth()->id();
        }

        Training::create($data);

        return redirect()->route('trainings.index')->with('success', 'Training created successfully.');
    }

    public function show(Training $training)
    {
        $training->load(['careerPath', 'mentor', 'students']);
        // remove any dropped enrollments from the student list to keep UI clean
        $training->students = $training->students->filter(function ($s) {
            return $s->pivot->status !== 'dropped';
        });
        return view('trainings.show', compact('training'));
    }

    public function edit(Training $training)
    {
        // Only mentors can edit their own trainings
        if (auth()->user()->role === 'mentor' && $training->mentor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $careerPaths = CareerPath::all();
        return view('trainings.edit', compact('training', 'careerPaths'));
    }

    public function update(Request $request, Training $training)
    {
        // Only mentors can update their own trainings
        if (auth()->user()->role === 'mentor' && $training->mentor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'provider' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'career_path_id' => 'required|exists:career_paths,id',
        ]);

        $data = $request->all();
        if (empty($data['name'])) {
            $data['name'] = $data['title'];
        }

        $training->update($data);

        return redirect()->route('trainings.index')->with('success', 'Training updated successfully.');
    }

    public function destroy(Training $training)
    {
        // Only admins or the mentor who created it can delete trainings
        if (auth()->user()->role === 'admin') {
            // Admin can delete any training
        } elseif (auth()->user()->role === 'mentor' && $training->mentor_id === auth()->id()) {
            // Mentor can delete only their own training
        } else {
            abort(403, 'غير مصرح لك بحذف هذا التدريب. فقط الـ Admin أو المنشئ يمكنه الحذف.');
        }

        $training->delete();
        return redirect()->route('trainings.index')->with('success', 'Training deleted successfully.');
    }
}