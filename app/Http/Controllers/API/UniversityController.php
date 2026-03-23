<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::all();
        return response()->json([
            'count' => $universities->count(),
            'data' => $universities
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:universities',
            'location' => 'nullable|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'unique' => 'قيمة :attribute موجودة من قبل',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'اسم الجامعة',
            'location' => 'الموقع',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $university = University::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $university
        ], 201);
    }

    public function show($id)
    {
        $university = University::find($id);
        if (!$university) {
            return response()->json(['message' => 'University not found'], 404);
        }
        return response()->json($university);
    }

    public function update(Request $request)
    {
        $universityId = $request->input('old_id');
        $university = University::find($universityId);

        if (!$university) {
            return response()->json(['message' => 'University not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:universities,name,' . $university->id,
        ], [
            'required' => 'حقل :attribute مطلوب',
            'unique' => 'قيمة :attribute موجودة من قبل',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'اسم الجامعة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $university->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $university
        ]);
    }

    public function destroy($id)
    {
        $university = University::find($id);
        if (!$university) {
            return response()->json(['message' => 'University not found'], 404);
        }

        $university->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
