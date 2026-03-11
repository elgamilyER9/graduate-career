<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return response()->json([
            'count' => $skills->count(),
            'data' => $skills
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:skills',
            'career_path_id' => 'required|exists:career_paths,id',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'unique' => 'قيمة :attribute موجودة من قبل',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'اسم المهارة',
            'career_path_id' => 'مسار المهنة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $skill = Skill::create($validator->validated());
        return response()->json([
            'message' => 'تمت الإضافة بنجاح',
            'data' => $skill
        ], 201);
    }

    public function show($id)
    {
        $skill = Skill::find($id);
        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }
        return response()->json($skill);
    }

    public function update(Request $request)
    {
        $skillId = $request->input('old_id');
        $skill = Skill::find($skillId);

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:skills,name,' . $skill->id,
            'career_path_id' => 'sometimes|required|exists:career_paths,id',
        ], [
            'required' => 'حقل :attribute مطلوب',
            'unique' => 'قيمة :attribute موجودة من قبل',
            'exists' => 'عنصر :attribute المختار غير موجود',
            'string' => 'يجب أن يكون حقل :attribute نصاً',
            'max' => 'حقل :attribute وصل للحد الأقصى من الحروف',
        ]);

        $validator->setAttributeNames([
            'name' => 'اسم المهارة',
            'career_path_id' => 'مسار المهنة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $skill->update($validator->validated());
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'data' => $skill
        ]);
    }

    public function destroy($id)
    {
        $skill = Skill::find($id);
        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        $skill->delete();
        return response()->json([
            'message' => 'تم المسح بنجاح'
        ], 200);
    }
}
