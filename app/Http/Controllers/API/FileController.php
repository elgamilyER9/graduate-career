<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return response()->json([
            'count' => $files->count(),
            'data' => $files
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'file_path' => 'required|string',
            'file_type' => 'required|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
        ]);

        $validator->setAttributeNames([
            'user_id' => 'المستخدم',
            'file_path' => 'مسار الملف',
            'file_type' => 'نوع الملف',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $file = File::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $file
        ], 201);
    }

    public function update(Request $request)
    {
        $fileId = $request->input('old_id');
        $file = File::find($fileId);

        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'file_path' => 'sometimes|required|string',
            'file_type' => 'sometimes|required|string',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
        ]);

        $validator->setAttributeNames([
            'user_id' => 'المستخدم',
            'file_path' => 'مسار الملف',
            'file_type' => 'نوع الملف',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $file->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $file
        ]);
    }

    public function show($id)
    {
        $file = File::find($id);
        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }
        return response()->json($file);
    }

    public function destroy($id)
    {
        $file = File::find($id);
        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $file->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
