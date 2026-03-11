<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\TrainingController;
use App\Http\Controllers\API\FacultyController;
use App\Http\Controllers\API\UniversityController;
use App\Http\Controllers\API\JobApplicationController;
use App\Http\Controllers\API\TrainingEnrollmentController;
use App\Http\Controllers\API\MentorshipRequestController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\CareerPathController;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\ActivityLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User Routes
Route::get('getusers', [UserController::class, 'index']);
Route::post('storeusers', [UserController::class, 'store']);
Route::get('showuser/{user}', [UserController::class, 'show']);
Route::post('updateuser', [UserController::class, 'update']);
Route::post('deleteuser/{user}', [UserController::class, 'destroy']);

// Job Routes
Route::get('getjobs', [JobController::class, 'index']);
Route::post('storejobs', [JobController::class, 'store']);
Route::get('showjob/{job}', [JobController::class, 'show']);
Route::post('updatejob', [JobController::class, 'update']);
Route::post('deletejob/{job}', [JobController::class, 'destroy']);

// Training Routes
Route::get('gettrainings', [TrainingController::class, 'index']);
Route::post('storetrainings', [TrainingController::class, 'store']);
Route::get('showtraining/{training}', [TrainingController::class, 'show']);
Route::post('updatetraining', [TrainingController::class, 'update']);
Route::post('deletetraining/{training}', [TrainingController::class, 'destroy']);

// Faculty Routes
Route::get('getfaculties', [FacultyController::class, 'index']);
Route::post('storefaculties', [FacultyController::class, 'store']);
Route::get('showfaculty/{faculty}', [FacultyController::class, 'show']);
Route::post('updatefaculty', [FacultyController::class, 'update']);
Route::post('deletefaculty/{faculty}', [FacultyController::class, 'destroy']);

// University Routes
Route::get('getuniversities', [UniversityController::class, 'index']);
Route::post('storeuniversities', [UniversityController::class, 'store']);
Route::get('showuniversity/{university}', [UniversityController::class, 'show']);
Route::post('updateuniversity', [UniversityController::class, 'update']);
Route::post('deleteuniversity/{university}', [UniversityController::class, 'destroy']);

// Job Application Routes
Route::get('getjobapplications', [JobApplicationController::class, 'index']);
Route::post('storejobapplications', [JobApplicationController::class, 'store']);
Route::get('showjobapplication/{job_application}', [JobApplicationController::class, 'show']);
Route::post('updatejobapplication', [JobApplicationController::class, 'update']);
Route::post('deletejobapplication/{job_application}', [JobApplicationController::class, 'destroy']);

// Training Enrollment Routes
Route::get('gettrainingenrollments', [TrainingEnrollmentController::class, 'index']);
Route::post('storetrainingenrollments', [TrainingEnrollmentController::class, 'store']);
Route::get('showtrainingenrollment/{training_enrollment}', [TrainingEnrollmentController::class, 'show']);
Route::post('deletetrainingenrollment/{training_enrollment}', [TrainingEnrollmentController::class, 'destroy']);

// Mentorship Request Routes
Route::get('getmentorshiprequests', [MentorshipRequestController::class, 'index']);
Route::post('storementorshiprequests', [MentorshipRequestController::class, 'store']);
Route::get('showmentorshiprequest/{mentorship_request}', [MentorshipRequestController::class, 'show']);
Route::post('updatementorshiprequest', [MentorshipRequestController::class, 'update']);
Route::post('deletementorshiprequest/{mentorship_request}', [MentorshipRequestController::class, 'destroy']);

// Message Routes
Route::get('getmessages', [MessageController::class, 'index']);
Route::post('storemessages', [MessageController::class, 'store']);
Route::get('showmessage/{message}', [MessageController::class, 'show']);
Route::post('deletemessage/{message}', [MessageController::class, 'destroy']);

// Notification Routes
Route::get('getnotifications', [NotificationController::class, 'index']);
Route::get('shownotification/{notification}', [NotificationController::class, 'show']);
Route::post('updatenotification', [NotificationController::class, 'update']);
Route::post('deletenotification/{notification}', [NotificationController::class, 'destroy']);

// Skill Routes
Route::get('getskills', [SkillController::class, 'index']);
Route::post('storeskills', [SkillController::class, 'store']);
Route::get('showskill/{skill}', [SkillController::class, 'show']);
Route::post('updateskill', [SkillController::class, 'update']);
Route::post('deleteskill/{skill}', [SkillController::class, 'destroy']);

// Career Path Routes
Route::get('getcareerpaths', [CareerPathController::class, 'index']);
Route::post('storecareerpaths', [CareerPathController::class, 'store']);
Route::get('showcareerpath/{career_path}', [CareerPathController::class, 'show']);
Route::post('updatecareerpath', [CareerPathController::class, 'update']);
Route::post('deletecareerpath/{career_path}', [CareerPathController::class, 'destroy']);

// File Routes
Route::get('getfiles', [FileController::class, 'index']);
Route::get('showfile/{file}', [FileController::class, 'show']);
Route::post('deletefile/{file}', [FileController::class, 'destroy']);

// Activity Log Routes
Route::get('getactivitylogs', [ActivityLogController::class, 'index']);
Route::get('showactivitylog/{activity_log}', [ActivityLogController::class, 'show']);
