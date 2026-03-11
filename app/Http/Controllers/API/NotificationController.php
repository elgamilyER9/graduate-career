<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return response()->json([
            'count' => $notifications->count(),
            'data' => $notifications
        ]);
    }

    public function show($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
        return response()->json($notification);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'is_read' => 'boolean',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
            'boolean' => 'يجب أن يكون حقل :attribute نعم أو لا',
        ]);

        $validator->setAttributeNames([
            'user_id' => 'المستخدم',
            'title' => 'العنوان',
            'message' => 'الرسالة',
            'is_read' => 'تمت القراءة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $notification = Notification::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $notification
        ], 201);
    }

    public function update(Request $request)
    {
        $notificationId = $request->input('old_id');
        $notification = Notification::find($notificationId);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'title' => 'sometimes|required|string|max:255',
            'message' => 'sometimes|required|string',
            'is_read' => 'boolean',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
            'boolean' => 'يجب أن يكون حقل :attribute نعم أو لا',
        ]);

        $validator->setAttributeNames([
            'user_id' => 'المستخدم',
            'title' => 'العنوان',
            'message' => 'الرسالة',
            'is_read' => 'تمت القراءة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $notification->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $notification
        ]);
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
