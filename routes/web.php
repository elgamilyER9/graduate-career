<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\CareerPathController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\MentorshipRequestController;
use App\Http\Controllers\TrainingEnrollmentController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/auth.php';

// Socialite Routes
Route::get('/auth/linkedin', [\App\Http\Controllers\Auth\SocialiteController::class, 'redirectToLinkedIn'])->name('auth.linkedin');
Route::get('/auth/linkedin/callback', [\App\Http\Controllers\Auth\SocialiteController::class, 'handleLinkedInCallback']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/front', [HomeController::class, 'front'])->name('front');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('trainings', TrainingController::class);
    Route::resource('career_paths', CareerPathController::class);
    Route::resource('faculties', FacultyController::class);
    Route::resource('universities', UniversityController::class);

    // Mentorship Requests
    Route::post('/mentorship-requests', [MentorshipRequestController::class, 'store'])->name('mentorship_requests.store');
    Route::patch('/mentorship-requests/{mentorshipRequest}', [MentorshipRequestController::class, 'update'])->name('mentorship_requests.update');
    Route::delete('/mentorship-requests/{mentorshipRequest}', [MentorshipRequestController::class, 'destroy'])->name('mentorship_requests.destroy');

    // Job Applications
    Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job_applications.index');
    Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('job_applications.store');
    Route::get('/job-applications/{jobApplication}', [JobApplicationController::class, 'show'])->name('job_applications.show');
    Route::patch('/job-applications/{jobApplication}', [JobApplicationController::class, 'update'])->name('job_applications.update');
    Route::delete('/job-applications/{jobApplication}', [JobApplicationController::class, 'destroy'])->name('job_applications.destroy');

    // Training Enrollment
    Route::post('/trainings/{training}/enroll', [TrainingEnrollmentController::class, 'store'])->name('training_enrollments.store');
    Route::patch('/training-enrollments/{enrollment}', [TrainingEnrollmentController::class, 'update'])->name('training_enrollments.update');
    Route::delete('/training-enrollments/{enrollment}', [TrainingEnrollmentController::class, 'destroy'])->name('training_enrollments.destroy');

    // Messaging
    Route::get('/messages/{user}', [\App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

    // New Navigation Pages
    Route::get('/mentors', [HomeController::class, 'mentors'])->name('mentors.index');
    Route::get('/connections', [HomeController::class, 'connections'])->name('connections.index');
    Route::get('/community', [HomeController::class, 'community'])->name('community.index');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread.count');
    Route::get('/notifications/recent', [NotificationController::class, 'recent'])->name('notifications.recent');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read.all');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'clear'])->name('notifications.clear');

    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/search/api', [SearchController::class, 'index'])->name('search.api');
    Route::get('/search/advanced', [SearchController::class, 'advanced'])->name('search.advanced');

    // Files
    Route::post('/files/upload', [FileController::class, 'store'])->name('files.store');
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
    Route::get('/files/{file}/show', [FileController::class, 'show'])->name('files.show');
});

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');