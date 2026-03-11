<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'receiver'])->get();
        return response()->json([
            'count' => $messages->count(),
            'data' => $messages
        ]);
    }

    public function show($id)
    {
        $message = Message::find($id);
        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }
        return response()->json($message->load(['sender', 'receiver']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
        ]);

        $validator->setAttributeNames([
            'sender_id' => 'المرسل',
            'receiver_id' => 'المستقبل',
            'content' => 'المحتوى',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $message = Message::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $message
        ], 201);
    }

    public function update(Request $request)
    {
        $messageId = $request->input('old_id');
        $message = Message::find($messageId);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'sender_id' => 'sometimes|required|exists:users,id',
            'receiver_id' => 'sometimes|required|exists:users,id',
            'content' => 'sometimes|required|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
        ]);

        $validator->setAttributeNames([
            'sender_id' => 'المرسل',
            'receiver_id' => 'المستقبل',
            'content' => 'المحتوى',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $message->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $message
        ]);
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $message->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
