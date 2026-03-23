<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'count' => $users->count(),
            'data' => $users
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,mentor,user',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'unique' => 'قيمة :attribute موجودة من قبل',
            'email' => 'يجب إدخال بريد إلكتروني صحيح في :attribute',
            'in' => 'القيمة المدخلة في :attribute غير صالحة',
            'min' => 'يجب أن يكون حقل :attribute على الأقل :min حروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'role' => 'الدور',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $userId = $request->input('old_id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'sometimes|required|string|in:admin,mentor,user',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'university_id' => 'nullable|exists:universities,id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'career_path_id' => 'nullable|exists:career_paths,id',
            'cv' => 'nullable|string',
            'job_title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer',
            'linkedin_url' => 'nullable|string|url',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'unique' => 'قيمة :attribute موجودة من قبل',
            'email' => 'يجب إدخال بريد إلكتروني صحيح في :attribute',
            'in' => 'القيمة المدخلة في :attribute غير صالحة',
            'exists' => 'عنصر :attribute المختار غير موجود',
        ]);

        $validator->setAttributeNames([
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'role' => 'الدور',
            'phone' => 'رقم الهاتف',
            'bio' => 'السيرة الذاتية',
            'university_id' => 'الجامعة',
            'faculty_id' => 'الكلية',
            'career_path_id' => 'مسار المهنة',
            'cv' => 'السيرة الذاتية (الملف)',
            'job_title' => 'المسمى الوظيفي',
            'company' => 'الشركة',
            'years_experience' => 'سنوات الخبرة',
            'linkedin_url' => 'رابط لينكد إن',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
