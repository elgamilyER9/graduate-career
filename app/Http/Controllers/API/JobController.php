<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();
        return response()->json([
            'count' => $jobs->count(),
            'data' => $jobs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'type' => 'required|string',
            'career_path_id' => 'nullable|exists:career_paths,id',
            'mentor_id' => 'nullable|exists:users,id',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'title' => 'عنوان الوظيفة',
            'description' => 'وصف الوظيفة',
            'company' => 'الشركة',
            'location' => 'الموقع',
            'salary_range' => 'نطاق الراتب',
            'type' => 'نوع الوظيفة',
            'career_path_id' => 'مسار المهنة',
            'mentor_id' => 'المرشد',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $job = Job::create($validator->validated());

        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $job
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = Job::find($id);
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }
        return response()->json($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $jobId = $request->input('old_id');
        $job = Job::find($jobId);

        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'company' => 'sometimes|required|string|max:255',
            'location' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'type' => 'sometimes|required|string',
            'career_path_id' => 'nullable|exists:career_paths,id',
            'mentor_id' => 'nullable|exists:users,id',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'title' => 'عنوان الوظيفة',
            'description' => 'وصف الوظيفة',
            'company' => 'الشركة',
            'location' => 'الموقع',
            'salary_range' => 'نطاق الراتب',
            'type' => 'نوع الوظيفة',
            'career_path_id' => 'مسار المهنة',
            'mentor_id' => 'المرشد',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $job->update($validator->validated());

        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $job
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        $job->delete();

        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
