<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MentorshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MentorshipRequestController extends Controller
{
    public function index()
    {
        $requests = MentorshipRequest::all();
        return response()->json([
            'count' => $requests->count(),
            'data' => $requests
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'mentor_id' => 'required|exists:users,id',
            'status' => 'required|string|in:pending,approved,rejected',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'in' => 'القيمة المدخلة في :attribute غير صالحة',
        ]);

        $validator->setAttributeNames([
            'user_id' => 'المستخدم',
            'mentor_id' => 'المرشد',
            'status' => 'الحالة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $request_obj = MentorshipRequest::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $request_obj
        ], 201);
    }

    public function show($id)
    {
        $mentorshipRequest = MentorshipRequest::find($id);
        if (!$mentorshipRequest) {
            return response()->json(['message' => 'Mentorship Request not found'], 404);
        }
        return response()->json($mentorshipRequest);
    }

    public function update(Request $request)
    {
        $requestId = $request->input('old_id');
        $mentorshipRequest = MentorshipRequest::find($requestId);

        if (!$mentorshipRequest) {
            return response()->json(['message' => 'Mentorship Request not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'mentor_id' => 'sometimes|required|exists:users,id',
            'status' => 'sometimes|required|string|in:pending,approved,rejected',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'in' => 'القيمة المدخلة في :attribute غير صالحة',
        ]);

        $validator->setAttributeNames([
            'user_id' => 'المستخدم',
            'mentor_id' => 'المرشد',
            'status' => 'الحالة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $mentorshipRequest->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $mentorshipRequest
        ]);
    }

    public function destroy($id)
    {
        $mentorshipRequest = MentorshipRequest::find($id);
        if (!$mentorshipRequest) {
            return response()->json(['message' => 'Mentorship Request not found'], 404);
        }

        $mentorshipRequest->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
