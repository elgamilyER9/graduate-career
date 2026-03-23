<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TrainingEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingEnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = TrainingEnrollment::with(['user', 'training'])->get();
        return response()->json([
            'count' => $enrollments->count(),
            'data' => $enrollments
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'training_id' => 'required|exists:trainings,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string|in:pending,approved,rejected',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'in' => 'القيمة المدخلة في :attribute غير صالحة',
        ]);

        $validator->setAttributeNames([
            'training_id' => 'التدريب',
            'user_id' => 'المستخدم',
            'status' => 'الحالة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $enrollment = TrainingEnrollment::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $enrollment
        ], 201);
    }

    public function update(Request $request)
    {
        $enrollmentId = $request->input('old_id');
        $trainingEnrollment = TrainingEnrollment::find($enrollmentId);

        if (!$trainingEnrollment) {
            return response()->json(['message' => 'Training Enrollment not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'training_id' => 'sometimes|required|exists:trainings,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'status' => 'sometimes|required|string|in:pending,approved,rejected',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'in' => 'القيمة المدخلة في :attribute غير صالحة',
        ]);

        $validator->setAttributeNames([
            'training_id' => 'التدريب',
            'user_id' => 'المستخدم',
            'status' => 'الحالة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $trainingEnrollment->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $trainingEnrollment
        ]);
    }

    public function show($id)
    {
        $trainingEnrollment = TrainingEnrollment::find($id);
        if (!$trainingEnrollment) {
            return response()->json(['message' => 'Training Enrollment not found'], 404);
        }
        return response()->json($trainingEnrollment->load(['user', 'training']));
    }

    public function destroy($id)
    {
        $trainingEnrollment = TrainingEnrollment::find($id);
        if (!$trainingEnrollment) {
            return response()->json(['message' => 'Training Enrollment not found'], 404);
        }

        $trainingEnrollment->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
