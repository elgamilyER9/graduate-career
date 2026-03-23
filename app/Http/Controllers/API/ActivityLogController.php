<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->get();
        return response()->json([
            'count' => $logs->count(),
            'data' => $logs
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'user_id' => 'المستخدم',
            'action' => 'الأجراء',
            'description' => 'الوصف',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $log = ActivityLog::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $log
        ], 201);
    }

    public function update(Request $request)
    {
        $logId = $request->input('old_id');
        $activityLog = ActivityLog::find($logId);

        if (!$activityLog) {
            return response()->json(['message' => 'Activity Log not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'action' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'user_id' => 'المستخدم',
            'action' => 'الأجراء',
            'description' => 'الوصف',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $activityLog->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $activityLog
        ]);
    }

    public function show($id)
    {
        $activityLog = ActivityLog::find($id);
        if (!$activityLog) {
            return response()->json(['message' => 'Activity Log not found'], 404);
        }
        return response()->json($activityLog->load('user'));
    }
}
