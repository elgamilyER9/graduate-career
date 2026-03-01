<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingEnrollment;
use Illuminate\Http\Request;

class TrainingEnrollmentController extends Controller
{
    public function store(Request $request, Training $training)
    {
        if (!auth()->check() || auth()->user()->role === 'admin') {
            abort(403, 'غير مصرح لك بالتسجيل في التدريب.');
        }

        $user = auth()->user();

        // prevent duplicate (except when a prior enrollment was dropped)
        $exists = TrainingEnrollment::where('user_id', $user->id)
            ->where('training_id', $training->id)
            ->where('status', '!=', 'dropped')
            ->exists();

        if ($exists) {
            return back()->with('error', 'لقد قمت بالفعل بطلب الالتحاق بهذا التدريب.');
        }

        TrainingEnrollment::updateOrCreate(
            ['user_id' => $user->id, 'training_id' => $training->id],
            ['status' => 'pending']
        );

        return back()->with('success', 'تم إرسال طلب الالتحاق، سينظر فيه المرشد.');
    }

    /**
     * Update the status of an enrollment (approve/decline/drop).
     */
    public function update(Request $request, TrainingEnrollment $enrollment)
    {
        $user = auth()->user();

        // only admin or mentor of the training may modify, 
        // OR the user who created the enrollment can 'drop' it if it's pending (cancel)
        $isOwner = $enrollment->user_id === $user->id;
        $canCancel = $isOwner && $request->status === 'dropped';

        if ($user->role !== 'admin' && $enrollment->training->mentor_id !== $user->id && !$canCancel) {
            abort(403, 'غير مصرح لك بتعديل حالة التسجيل.');
        }

        $request->validate([
            'status' => 'required|in:pending,enrolled,completed,dropped',
        ]);

        $enrollment->status = $request->status;
        $enrollment->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث حالة التسجيل.',
                'status' => $request->status
            ]);
        }

        return back()->with('success', 'تم تحديث حالة التسجيل.');
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy(TrainingEnrollment $enrollment)
    {
        $user = auth()->user();

        // Only admin, the training's mentor, or the student themselves can delete
        if (
            $user->role !== 'admin' &&
            $enrollment->training->mentor_id !== $user->id &&
            $enrollment->user_id !== $user->id
        ) {
            abort(403, 'غير مصرح لك بحذف هذا التسجيل.');
        }

        $enrollment->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حذف طلب الالتحاق بنجاح.'
            ]);
        }

        return back()->with('success', 'تم حذف طلب الالتحاق بنجاح.');
    }
}
