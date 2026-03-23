<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with(['user', 'job'])->get();
        return response()->json([
            'count' => $applications->count(),
            'data' => $applications
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required|exists:job_listings,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string|in:pending,approved,rejected',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'in' => 'القيمة المدخلة في :attribute غير صالحة',
        ]);

        $validator->setAttributeNames([
            'job_id' => 'الوظيفة',
            'user_id' => 'المستخدم',
            'status' => 'الحالة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $application = JobApplication::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $application
        ], 201);
    }

    public function show($id)
    {
        $jobApplication = JobApplication::find($id);
        if (!$jobApplication) {
            return response()->json(['message' => 'Job Application not found'], 404);
        }
        return response()->json($jobApplication->load(['user', 'job']));
    }

    public function update(Request $request)
    {
        $applicationId = $request->input('old_id');
        $jobApplication = JobApplication::find($applicationId);

        if (!$jobApplication) {
            return response()->json(['message' => 'Job Application not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'job_id' => 'sometimes|required|exists:job_listings,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'status' => 'sometimes|required|string|in:pending,approved,rejected',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'in' => 'القيمة المدخلة في :attribute غير صالحة',
        ]);

        $validator->setAttributeNames([
            'job_id' => 'الوظيفة',
            'user_id' => 'المستخدم',
            'status' => 'الحالة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $jobApplication->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $jobApplication
        ]);
    }

    public function destroy($id)
    {
        $jobApplication = JobApplication::find($id);
        if (!$jobApplication) {
            return response()->json(['message' => 'Job Application not found'], 404);
        }

        $jobApplication->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
