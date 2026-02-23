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
use Illuminate\Support\Facades\Route;
require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
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

    // New Navigation Pages
    Route::get('/mentors', [HomeController::class, 'mentors'])->name('mentors.index');
    Route::get('/connections', [HomeController::class, 'connections'])->name('connections.index');
    Route::get('/community', [HomeController::class, 'community'])->name('community.index');
});