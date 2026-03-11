<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::all();
        return response()->json([
            'count' => $trainings->count(),
            'data' => $trainings
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor' => 'required|string|max:255',
            'duration' => 'nullable|string',
            'price' => 'nullable|numeric',
            'career_path_id' => 'nullable|exists:career_paths,id',
            'mentor_id' => 'nullable|exists:users,id',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'numeric' => 'يجب أن تكون قيمة :attribute رقماً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'title' => 'عنوان التدريب',
            'description' => 'وصف التدريب',
            'instructor' => 'المدرب',
            'duration' => 'المدة',
            'price' => 'السعر',
            'career_path_id' => 'مسار المهنة',
            'mentor_id' => 'المرشد',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $training = Training::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $training
        ], 201);
    }

    public function show($id)
    {
        $training = Training::find($id);
        if (!$training) {
            return response()->json(['message' => 'Training not found'], 404);
        }
        return response()->json($training);
    }

    public function update(Request $request)
    {
        $trainingId = $request->input('old_id');
        $training = Training::find($trainingId);

        if (!$training) {
            return response()->json(['message' => 'Training not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'instructor' => 'sometimes|required|string|max:255',
            'duration' => 'nullable|string',
            'price' => 'nullable|numeric',
            'career_path_id' => 'nullable|exists:career_paths,id',
            'mentor_id' => 'nullable|exists:users,id',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'numeric' => 'يجب أن تكون قيمة :attribute رقماً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'title' => 'عنوان التدريب',
            'description' => 'وصف التدريب',
            'instructor' => 'المدرب',
            'duration' => 'المدة',
            'price' => 'السعر',
            'career_path_id' => 'مسار المهنة',
            'mentor_id' => 'المرشد',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $training->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $training
        ]);
    }

    public function destroy($id)
    {
        $training = Training::find($id);
        if (!$training) {
            return response()->json(['message' => 'Training not found'], 404);
        }

        $training->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
