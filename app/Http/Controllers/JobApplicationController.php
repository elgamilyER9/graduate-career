<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Job;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Show all applications for a job
     */
    public function index(Request $request)
    {
        $query = JobApplication::with(['user', 'job', 'mentor'])->latest();

        // Only admins and mentors can view all applications
        if (auth()->user()->role === 'admin') {
            // No extra filtering needed for admin by default
        } elseif (auth()->user()->role === 'mentor') {
            $query->where('mentor_id', auth()->id());
        } else {
            abort(403, 'غير مصرح لك بعرض هذه الصفحة.');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->get();

        return view('job_applications.index', compact('applications'));
    }

    /**
     * Store a new job application
     */
    public function store(Request $request, Job $job)
    {
        // Only authenticated users can apply
        if (!auth()->check() || auth()->user()->role === 'admin') {
            abort(403, 'غير مصرح لك بالتقديم على وظائف.');
        }

        // Get the mentor who posted this job
        $mentorId = $job->mentor_id;

        // Check if user already applied for this job
        $existingApplication = JobApplication::where('user_id', auth()->id())
            ->where('job_id', $job->id)
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'لقد تقدمت بالفعل على هذه الوظيفة.');
        }

        try {
            $application = JobApplication::create([
                'user_id' => auth()->id(),
                'job_id' => $job->id,
                'mentor_id' => $mentorId,
                'status' => 'pending',
            ]);

            // Send notification to mentor
            if ($mentorId) {
                $mentor = $job->mentor;
                NotificationService::send(
                    $mentor,
                    'job_application_received',
                    __('New Job Application'),
                    __(':name applied for :job', ['name' => auth()->user()->name, 'job' => $job->title]),
                    ['job_id' => $job->id, 'application_id' => $application->id],
                    $application
                );
            }

            $message = $mentorId
                ? 'تم تقديم طلبك بنجاح. سيتم مراجعته من قبل صاحب الوظيفة.'
                : 'تم تقديم طلبك بنجاح. سيتم مراجعته من قبل المسؤولين.';

            return back()->with('success', $message);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Job Application Error: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء التقديم. حاول مجددا.');
        }
    }

    /**
     * Show application details
     */
    public function show(JobApplication $jobApplication)
    {
        // Check authorization
        if (
            auth()->user()->role === 'admin' ||
            (auth()->user()->role === 'mentor' && auth()->user()->id === $jobApplication->mentor_id) ||
            (auth()->user()->role === 'user' && auth()->user()->id === $jobApplication->user_id)
        ) {
            $jobApplication->load(['user', 'job', 'mentor']);
            return view('job_applications.show', compact('jobApplication'));
        }

        abort(403, 'غير مصرح لك بعرض هذا الطلب.');
    }

    /**
     * Update application status (for mentors/admins)
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        // Only the assigned mentor or admin can update
        if (
            auth()->user()->role !== 'admin' &&
            (auth()->user()->role !== 'mentor' || auth()->user()->id !== $jobApplication->mentor_id)
        ) {
            abort(403, 'غير مصرح لك بتحديث هذا الطلب.');
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:500',
        ]);

        $oldStatus = $jobApplication->status;
        $jobApplication->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        // Send notification to applicant
        $statusMessages = [
            'approved' => [
                'title' => __('Application Approved'),
                'description' => __('Your application for :job has been approved!', ['job' => $jobApplication->job->title]),
                'type' => 'job_application_approved'
            ],
            'rejected' => [
                'title' => __('Application Rejected'),
                'description' => __('Your application for :job has been rejected.', ['job' => $jobApplication->job->title]),
                'type' => 'job_application_rejected'
            ]
        ];

        if ($oldStatus !== $request->status && isset($statusMessages[$request->status])) {
            $msg = $statusMessages[$request->status];
            NotificationService::send(
                $jobApplication->user,
                $msg['type'],
                $msg['title'],
                $msg['description'],
                ['job_id' => $jobApplication->job_id, 'application_id' => $jobApplication->id],
                $jobApplication
            );
        }

        $statusText = [
            'pending' => 'قيد الانتظار',
            'approved' => 'تمت الموافقة',
            'rejected' => 'تم الرفض',
        ];

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الطلب. الحالة الحالية: ' . $statusText[$request->status],
                'status' => $request->status
            ]);
        }

        return back()->with('success', 'تم تحديث الطلب. الحالة الحالية: ' . $statusText[$request->status]);
    }

    /**
     * Delete an application
     */
    public function destroy(JobApplication $jobApplication)
    {
        // Only the user who applied, the assigned mentor, or admin can delete
        if (
            auth()->user()->role !== 'admin' &&
            auth()->user()->id !== $jobApplication->user_id &&
            (auth()->user()->role !== 'mentor' || auth()->user()->id !== $jobApplication->mentor_id)
        ) {
            abort(403, 'غير مصرح لك بحذف هذا الطلب.');
        }

        $jobApplication->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الطلب بنجاح.'
            ]);
        }

        return back()->with('success', 'تم حذف الطلب بنجاح.');
    }
}
