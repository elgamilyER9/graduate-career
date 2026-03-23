<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CareerPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CareerPathController extends Controller
{
    public function index()
    {
        $paths = CareerPath::all();
        return response()->json([
            'count' => $paths->count(),
            'data' => $paths
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:career_paths',
            'description' => 'required|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'unique' => 'قيمة :attribute موجودة من قبل',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'اسم المسار المهني',
            'description' => 'وصف المسار المهني',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $path = CareerPath::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $path
        ], 201);
    }

    public function show($id)
    {
        $careerPath = CareerPath::find($id);
        if (!$careerPath) {
            return response()->json(['message' => 'Career Path not found'], 404);
        }
        return response()->json($careerPath);
    }

    public function update(Request $request)
    {
        $pathId = $request->input('old_id');
        $careerPath = CareerPath::find($pathId);

        if (!$careerPath) {
            return response()->json(['message' => 'Career Path not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:career_paths,name,' . $careerPath->id,
            'description' => 'sometimes|required|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'unique' => 'قيمة :attribute موجودة من قبل',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'اسم المسار المهني',
            'description' => 'وصف المسار المهني',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $careerPath->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $careerPath
        ]);
    }

    public function destroy($id)
    {
        $careerPath = CareerPath::find($id);
        if (!$careerPath) {
            return response()->json(['message' => 'Career Path not found'], 404);
        }

        $careerPath->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
