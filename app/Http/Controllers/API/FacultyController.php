<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::with('university')->get();
        return response()->json([
            'count' => $faculties->count(),
            'data' => $faculties
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'university_id' => 'required|exists:universities,id',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'اسم الكلية',
            'university_id' => 'الجامعة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $faculty = Faculty::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $faculty
        ], 201);
    }

    public function show($id)
    {
        $faculty = Faculty::find($id);
        if (!$faculty) {
            return response()->json(['message' => 'Faculty not found'], 404);
        }
        return response()->json($faculty->load('university'));
    }

    public function update(Request $request)
    {
        $facultyId = $request->input('old_id');
        $faculty = Faculty::find($facultyId);

        if (!$faculty) {
            return response()->json(['message' => 'Faculty not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'university_id' => 'sometimes|required|exists:universities,id',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'اسم الكلية',
            'university_id' => 'الجامعة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $faculty->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $faculty
        ]);
    }

    public function destroy($id)
    {
        $faculty = Faculty::find($id);
        if (!$faculty) {
            return response()->json(['message' => 'Faculty not found'], 404);
        }

        $faculty->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
