@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
            <script>
                document.addEventListener('DOMContentLoaded', func tion() {
                    var container = document.querySelector('.toast-container');
                    if(container) {
                        var html = `
                                                        <div class="toast align-items-center text-white bg-info border-0 shadow-lg rounded-4 animate__animated animate__fadeInDown" role="alert" aria-live="assertive" aria-atomic="true">
                                                            <div class="d-flex">
                                                                <div class="toast-body d-flex align-items-center">
                                                                    <i class="bi bi-chat-dots-fill fs-4 me-2"></i>
                                                                    <div>
                                                                        <div class="fw-bold">{{ __('New message') }}</div>
                                                                        <div class="small opacity-75">{{ __('You have :count new messages', ['count' => $unreadMessagesCount]) }}</div>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                            </div>
                                                        </div>`;
                        container.insertAdjacentHTML('beforeend', html);
                        var toastEl = container.querySelector('.toast:last-child');
                        new bootstrap.Toast(toastEl).show();
                    }
                });
            </script>
        @endif
        <!-- Advanced Hero Header -->
        <div class="rounded-4 p-5 position-relative overflow-hidden mb-5 animate__animated animate__fadeIn"
            style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
            <!-- Decorative blobs -->
            <div class="position-absolute"
                style="top: -50px; right: -50px; width: 250px; height: 250px; background: rgba(59, 130, 246, 0.1); filter: blur(80px); border-radius: 50%;">
            </div>
            <div class="position-absolute"
                style="bottom: -50px; left: -20px; width: 200px; height: 200px; background: rgba(16, 185, 129, 0.1); filter: blur(60px); border-radius: 50%;">
            </div>

            <div class="row align-items-center g-4 position-relative">
                <div class="col-md-8">
                    <span
                        class="badge rounded-pill bg-primary bg-opacity-20 text-primary px-3 py-2 mb-3 extra-small fw-bold text-uppercase tracking-wider border border-primary border-opacity-10">
                        {{ __('Mentor Dashboard v2.0') }}
                    </span>
                    <h2 class="display-5 fw-bolder mb-3 animate__animated animate__fadeInLeft">
                        <i
                            class="bi bi-stars me-2 text-warning"></i>{{ __('Welcome back, :name', ['name' => Auth::user()->name]) }}
                    </h2>
                    <p class="lead text-white-50 mb-4 fw-medium animate__animated animate__fadeInLeft animate__delay-1s">
                        {{ __('Your unified workspace for managing mentorships, jobs, and training programs.') }}
                    </p>
                    <div class="d-flex gap-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <a href="{{ route('trainings.create') }}"
                            class="btn btn-success btn-lg rounded-pill px-4 fw-bold shadow-lg hover-scale">
                            <i class="bi bi-plus-circle me-2"></i> {{ __('New Training') }}
                        </a>
                        <a href="{{ route('jobs.create') }}"
                            class="btn btn-outline-light btn-lg rounded-pill px-4 fw-bold hover-scale">
                            <i class="bi bi-briefcase me-2"></i> {{ __('Post a Job') }}
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center d-none d-md-block">
                    <div class="floating-icon">
                        <i class="bi bi-rocket-takeoff-fill text-primary opacity-75"
                            style="font-size: 8rem; filter: drop-shadow(0 0 20px rgba(59, 130, 246, 0.3));"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Statistics -->
        <div class="row g-4 mb-5 animate__animated animate__fadeInUp">
            <div class="col-md-3">
                <div class="card rounded-4 border-0 overflow-hidden shadow-sm h-100 stat-card"
                    style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1px solid rgba(59, 130, 246, 0.1) !important;">
                    <div class="card-body p-4 position-relative overflow-hidden">
                        <div class="position-absolute"
                            style="top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(59, 130, 246, 0.05); border-radius: 50%;">
                        </div>
                        <div class="d-flex justify-content-between align-items-start position-relative">
                            <div>
                                <p class="text-primary extra-small fw-bolder text-uppercase mb-1 tracking-wider">
                                    {{ __('Potential Mentees') }}
                                </p>
                                <h1 class="fw-bolder mb-0 text-dark" style="font-size: 2.5rem;">{{ $totalStudents }}</h1>
                            </div>
                            <div class="icon-stat-box text-primary">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 border-0 overflow-hidden shadow-sm h-100 stat-card"
                    style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid rgba(34, 197, 94, 0.1) !important;">
                    <div class="card-body p-4 position-relative overflow-hidden">
                        <div class="position-absolute"
                            style="top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(34, 197, 94, 0.05); border-radius: 50%;">
                        </div>
                        <div class="d-flex justify-content-between align-items-start position-relative">
                            <div>
                                <p class="text-success extra-small fw-bolder text-uppercase mb-1 tracking-wider">
                                    {{ __('Active Mentees') }}
                                </p>
                                <h1 class="fw-bolder mb-0 text-dark" id="active-mentees-stat" style="font-size: 2.5rem;">
                                    {{ $myMenteesCount }}</h1>
                            </div>
                            <div class="icon-stat-box text-success">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 border-0 overflow-hidden shadow-sm h-100 stat-card"
                    style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border: 1px solid rgba(245, 158, 11, 0.1) !important;">
                    <div class="card-body p-4 position-relative overflow-hidden">
                        <div class="position-absolute"
                            style="top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(245, 158, 11, 0.05); border-radius: 50%;">
                        </div>
                        <div class="d-flex justify-content-between align-items-start position-relative">
                            <div>
                                <p class="text-warning extra-small fw-bolder text-uppercase mb-1 tracking-wider">
                                    {{ __('Job Applications') }}
                                </p>
                                <h1 class="fw-bolder mb-0 text-dark" id="job-requests-stat" style="font-size: 2.5rem;">
                                    {{ $pendingJobApplicationsCount }}
                                </h1>
                            </div>
                            <div class="icon-stat-box text-warning">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 border-0 overflow-hidden shadow-sm h-100 stat-card"
                    style="background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); border: 1px solid rgba(239, 68, 68, 0.1) !important;">
                    <div class="card-body p-4 position-relative overflow-hidden">
                        <div class="position-absolute"
                            style="top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(239, 68, 68, 0.05); border-radius: 50%;">
                        </div>
                        <div class="d-flex justify-content-between align-items-start position-relative">
                            <div>
                                <p class="text-danger extra-small fw-bolder text-uppercase mb-1 tracking-wider">
                                    {{ __('New Enrollments') }}
                                </p>
                                <h1 class="fw-bolder mb-0 text-dark" id="enrollments-stat" style="font-size: 2.5rem;">
                                    {{ $pendingEnrollmentsCount }}
                                </h1>
                            </div>
                            <div class="icon-stat-box text-danger">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications Alert Row -->
        @php
            $unreadNotifications = Auth::user()->notifications()->where('read', false)->count();
            $recentNotifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->take(5)->get();
        @endphp
        @if($unreadNotifications > 0 || $recentNotifications->count() > 0)
            <div class="row g-4 mb-5 animate__animated animate__fadeInUp">
                <div class="col-12">
                    <div class="card rounded-4 border-0 shadow-sm overflow-hidden"
                        style="background: linear-gradient(135deg, #f8f9ff 0%, #eef2ff 100%); border-left: 5px solid #6366f1 !important;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-3 shadow-sm"
                                        style="width:45px;height:45px;background:linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);color:white;">
                                        <i class="bi bi-bell-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bolder text-dark">{{ __('Recent Notifications') }}</h6>
                                        <small class="text-muted">{{ __('You have :count unread notifications', ['count' => $unreadNotifications]) }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                    {{ __('View All') }} <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                            @if($recentNotifications->count() > 0)
                                <div class="notification-items" style="max-height: 300px; overflow-y: auto;">
                                    @foreach($recentNotifications as $notification)
                                        <div class="d-flex gap-3 p-3 mb-2 rounded-3 {{ !$notification->read ? 'bg-white shadow-sm' : '' }}" style="border-left: 3px solid {{ !$notification->read ? '#6366f1' : '#e5e7eb' }};">
                                            <div class="small fw-bold text-primary" style="min-width: 40px; text-align: center;">
                                                        <i class="bi {{ \App\Services\NotificationService::getIcon($notification->type) }} fs-5"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-1 {{ !$notification->read ? 'fw-bold text-dark' : 'text-muted' }}">{{ $notification->title }}</p>
                                                        <small class="text-muted d-block">{{ $notification->message }}</small>
                                                        <small class="text-muted d-block mt-1">{{ $notification->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    @if(!$notification->read)
                                                        <div class="d-flex align-items-center gap-2">
                                                            <form action="{{ route('notifications.read', $notification) }}" method="POST" class="m-0">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-2" title="{{ __('Mark as read') }}">
                                                                    <i class="bi bi-check2"></i>
                                                                </button>
                                                            </form>
                                                            <span class="badge rounded-pill bg-primary" style="width: 8px; height: 8px; padding: 0;"></span>
                                                        </div>
                                                    @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Advanced Status Tracking Row -->
        <div class="row g-4 mb-5 animate__animated animate__fadeInUp animate__delay-1s">
            <!-- Jobs I Applied For -->
            <div class="col-xl-3 col-md-6">
                <div class="card premium-request-card rounded-4 shadow-sm border-0 h-100 overflow-hidden position-relative"
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-top: 4px solid #6366f1 !important;">
                    <div class="px-4 pt-4 pb-3 position-relative overflow-hidden"
                        style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                        <div class="position-absolute"
                            style="top:-30px;right:-30px;width:100px;height:100px;background:rgba(255,255,255,0.08);border-radius:50%;">
                        </div>
                        <div class="d-flex justify-content-between align-items-center position-relative z-1">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded-3 shadow-sm"
                                    style="width:40px;height:40px;background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);">
                                    <i class="bi bi-send-fill text-white fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bolder text-white">{{ __('My Apps') }}</h6>
                                    <small class="text-white opacity-75"
                                        style="font-size:0.7rem;">{{ __('Job applications to review') }}</small>
                                </div>
                            </div>
                            <span class="badge rounded-pill fw-bold px-3 py-2 shadow-sm"
                                style="background:rgba(255,255,255,0.25);color:white;font-size:0.85rem;">
                                {{ $myJobApplications->count() }}
                            </span>
                        </div>
                        @php
                            $approvedCount = $myJobApplications->where('status', 'approved')->count();
                            $pendingCount = $myJobApplications->where('status', 'pending')->count();
                            $rejectedCount = $myJobApplications->where('status', 'rejected')->count();
                        @endphp
                        <div class="d-flex gap-2 mt-3 flex-wrap position-relative z-1">
                            <span class="badge rounded-pill fw-semibold px-2 py-1"
                                style="background:rgba(255,255,255,0.2);color:white;font-size:0.65rem;">
                                <i class="bi bi-check-circle-fill me-1" style="color:#86efac;"></i>{{ $approvedCount }}
                                {{ __('Accepted') }}
                            </span>
                            <span class="badge rounded-pill fw-semibold px-2 py-1"
                                style="background:rgba(255,255,255,0.2);color:white;font-size:0.65rem;">
                                <i class="bi bi-clock-fill me-1" style="color:#fde68a;"></i>{{ $pendingCount }}
                                {{ __('Pending') }}
                            </span>
                            <span class="badge rounded-pill fw-semibold px-2 py-1"
                                style="background:rgba(255,255,255,0.2);color:white;font-size:0.65rem;">
                                <i class="bi bi-x-circle-fill me-1" style="color:#fca5a5;"></i>{{ $rejectedCount }}
                                {{ __('Rejected') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-0 position-relative">
                        <!-- Fade overlays for scrolling -->
                        <div class="scroll-fade-top position-absolute top-0 w-100"
                            style="height: 15px; background: linear-gradient(to bottom, rgba(255,255,255,1), transparent); z-index: 10;">
                        </div>
                        <div class="custom-scrollbar px-2 pb-2" style="max-height: 400px; overflow-y: auto;">
                            @forelse($myJobApplications as $app)
                                @php
                                    $statusColor = $app->status === 'approved' ? '#059669' : ($app->status === 'rejected' ? '#dc2626' : '#d97706');
                                    $statusBg = $app->status === 'approved' ? '#d1fae5' : ($app->status === 'rejected' ? '#fee2e2' : '#fef3c7');
                                    $statusIcon = $app->status === 'approved' ? 'bi-check-circle-fill' : ($app->status === 'rejected' ? 'bi-x-circle-fill' : 'bi-clock-fill');
                                    $isPending = $app->status === 'pending';
                                @endphp
                                <div class="list-item rounded-4 mb-2 overflow-hidden hover-lift transition-all position-relative"
                                    style="background: #f8fafc; border: 1px solid rgba(99,102,241,0.1);">
                                    <div class="position-absolute top-0 start-0 h-100"
                                        style="width:3px;background:{{ $statusColor }};border-radius:4px 0 0 4px;"></div>
                                    <div class="ps-3 pe-2 py-3">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="fw-bold text-dark text-truncate"
                                                style="font-size:0.88rem;max-width:130px;">{{ $app->job->title }}</div>
                                            <form action="{{ route('job_applications.destroy', $app) }}" method="POST"
                                                class="ajax-form flex-shrink-0 ms-1" data-type="my-applications">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center rounded-circle p-0 border-0 transition-all hover-scale"
                                                    style="width:26px;height:26px;background:rgba(239,68,68,0.08);color:#dc2626;"
                                                    title="{{ __('Delete') }}">
                                                    <i class="bi bi-trash3-fill" style="font-size:0.68rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <small class="text-muted d-flex align-items-center gap-1"
                                                style="font-size:0.72rem;">
                                                <i class="bi bi-building"></i> {{ Str::limit($app->job->company, 16) }}
                                            </small>
                                            <span class="badge rounded-pill fw-bold d-flex align-items-center gap-1"
                                                style="background:{{ $statusBg }};color:{{ $statusColor }};font-size:0.62rem;padding:3px 7px;">
                                                <i class="bi {{ $statusIcon }}"></i>
                                                {{ __(ucfirst($app->status)) }}
                                                @if($isPending)
                                                    <span
                                                        style="width:5px;height:5px;background:{{ $statusColor }};border-radius:50%;display:inline-block;animation:pulse-ring 1.5s ease-in-out infinite;"></span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle"
                                        style="width:60px;height:60px;background:linear-gradient(135deg,#ede9fe,#ddd6fe);">
                                        <i class="bi bi-inbox-fill" style="font-size:1.5rem;color:#6366f1;"></i>
                                    </div>
                                    <div class="text-muted fw-medium empty-msg small">{{ __('No applications') }}</div>
                                    <small class="text-muted opacity-50"
                                        style="font-size:0.72rem;">{{ __('Applications from admin will appear here') }}</small>
                                </div>
                            @endforelse
                        </div>
                        <div class="scroll-fade-bottom position-absolute bottom-0 w-100"
                            style="height: 15px; background: linear-gradient(to top, rgba(255,255,255,1), transparent); z-index: 10;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Requests (Incoming) -->
            <div class="col-xl-3 col-md-6">
                <div class="card premium-request-card rounded-4 shadow-sm border-0 h-100 overflow-hidden position-relative"
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-top: 4px solid #ef4444 !important;">
                    <div
                        class="card-header bg-transparent py-4 px-4 border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bolder text-dark d-flex align-items-center">
                            <div class="icon-circle bg-danger-subtle text-danger me-3 d-flex align-items-center justify-content-center rounded-circle"
                                style="width: 36px; height: 36px;">
                                <i class="bi bi-briefcase-fill fs-6"></i>
                            </div>
                            {{ __('Job Requests') }}
                        </h6>
                        <span class="badge rounded-pill bg-danger text-white px-3 py-2 fw-bold shadow-sm"
                            id="job-requests-badge">{{ $pendingJobApplicationsCount }}</span>
                    </div>
                    <div class="card-body p-0 position-relative">
                        <div class="scroll-fade-top position-absolute top-0 w-100"
                            style="height: 15px; background: linear-gradient(to bottom, rgba(255,255,255,1), transparent); z-index: 10;">
                        </div>
                        <div class="custom-scrollbar px-2 pb-2" id="job-requests-list"
                            style="max-height: 400px; overflow-y: auto;">
                            @forelse($pendingJobApplications as $application)
                                <div
                                    class="list-item bg-white rounded-3 p-3 m-2 shadow-sm border border-opacity-10 hover-lift transition-all">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-circle bg-danger text-white fw-bold d-flex justify-content-center align-items-center rounded-circle me-3 shadow-sm"
                                            style="width: 40px; height: 40px; font-size: 1.1rem;">
                                            {{ strtoupper(substr($application->user->name, 0, 1)) }}
                                        </div>
                                        <div class="text-truncate flex-grow-1">
                                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">
                                                {{ $application->user->name }}</div>
                                            <small class="text-muted d-block text-truncate fw-medium"
                                                style="font-size: 0.75rem;"><i
                                                    class="bi bi-briefcase me-1"></i>{{ $application->job->title }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 mt-3 pt-2 border-top border-opacity-10">
                                        <form action="{{ route('job_applications.update', $application) }}" method="POST"
                                            class="ajax-form flex-grow-1" data-type="job-requests">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit"
                                                class="btn btn-success w-100 rounded-pill py-1 fw-bold shadow-sm hover-scale d-flex justify-content-center align-items-center gap-1"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-check-circle"></i> {{ __('Accept') }}
                                            </button>
                                        </form>
                                        <form action="{{ route('job_applications.update', $application) }}" method="POST"
                                            class="ajax-form flex-grow-1" data-type="job-requests">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit"
                                                class="btn btn-danger w-100 rounded-pill py-1 fw-bold shadow-sm hover-scale d-flex justify-content-center align-items-center gap-1"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-x-circle"></i> {{ __('Reject') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-briefcase text-danger opacity-25 mb-3" style="font-size: 3rem;"></i>
                                    <div class="text-muted fw-medium empty-msg">{{ __('No pending requests') }}</div>
                                </div>
                            @endforelse
                        </div>
                        <div class="scroll-fade-bottom position-absolute bottom-0 w-100"
                            style="height: 15px; background: linear-gradient(to top, rgba(255,255,255,1), transparent); z-index: 10;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mentorship Requests -->
            <div class="col-xl-3 col-md-6">
                <div class="card premium-request-card rounded-4 shadow-sm border-0 h-100 overflow-hidden position-relative"
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-top: 4px solid #f59e0b !important;">
                    <div
                        class="card-header bg-transparent py-4 px-4 border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bolder text-dark d-flex align-items-center">
                            <div class="icon-circle bg-warning-subtle text-warning me-3 d-flex align-items-center justify-content-center rounded-circle"
                                style="width: 36px; height: 36px;">
                                <i class="bi bi-person-heart-fill fs-6"></i>
                            </div>
                            {{ __('Mentorship') }}
                        </h6>
                        <span class="badge rounded-pill bg-warning text-white px-3 py-2 fw-bold shadow-sm"
                            id="mentorship-badge">{{ $pendingRequestsCount }}</span>
                    </div>
                    <div class="card-body p-0 position-relative">
                        <div class="scroll-fade-top position-absolute top-0 w-100"
                            style="height: 15px; background: linear-gradient(to bottom, rgba(255,255,255,1), transparent); z-index: 10;">
                        </div>
                        <div class="custom-scrollbar px-2 pb-2" id="mentorship-list"
                            style="max-height: 400px; overflow-y: auto;">
                            @forelse($pendingRequests as $request)
                                <div
                                    class="list-item bg-white rounded-3 p-3 m-2 shadow-sm border border-opacity-10 hover-lift transition-all">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-circle bg-warning text-white fw-bold d-flex justify-content-center align-items-center rounded-circle me-3 shadow-sm"
                                            style="width: 40px; height: 40px; font-size: 1.1rem;">
                                            {{ strtoupper(substr($request->student->name, 0, 1)) }}
                                        </div>
                                        <div class="text-truncate flex-grow-1">
                                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">
                                                {{ $request->student->name }}</div>
                                            <small class="text-muted d-block text-truncate fw-medium"
                                                style="font-size: 0.75rem;" title="{{ $request->message }}"><i
                                                    class="bi bi-chat-quote-fill me-1"></i>{{ $request->message ?: __('New mentorship request') }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 mt-3 pt-2 border-top border-opacity-10">
                                        <form action="{{ route('mentorship_requests.update', $request) }}" method="POST"
                                            class="ajax-form flex-grow-1" data-type="mentorship">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit"
                                                class="btn btn-success w-100 rounded-pill py-1 fw-bold shadow-sm hover-scale d-flex justify-content-center align-items-center gap-1"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-check-circle"></i> {{ __('Accept') }}
                                            </button>
                                        </form>
                                        <form action="{{ route('mentorship_requests.update', $request) }}" method="POST"
                                            class="ajax-form flex-grow-1" data-type="mentorship">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit"
                                                class="btn btn-danger w-100 rounded-pill py-1 fw-bold shadow-sm hover-scale d-flex justify-content-center align-items-center gap-1"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-x-circle"></i> {{ __('Reject') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-person-hearts text-warning opacity-25 mb-3" style="font-size: 3rem;"></i>
                                    <div class="text-muted fw-medium empty-msg">{{ __('No requests') }}</div>
                                </div>
                            @endforelse
                        </div>
                        <div class="scroll-fade-bottom position-absolute bottom-0 w-100"
                            style="height: 15px; background: linear-gradient(to top, rgba(255,255,255,1), transparent); z-index: 10;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Training Enrollments -->
            <div class="col-xl-3 col-md-6">
                <div class="card premium-request-card rounded-4 shadow-sm border-0 h-100 overflow-hidden position-relative"
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-top: 4px solid #06b6d4 !important;">
                    <div
                        class="card-header bg-transparent py-4 px-4 border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bolder text-dark d-flex align-items-center">
                            <div class="icon-circle bg-info-subtle text-info me-3 d-flex align-items-center justify-content-center rounded-circle"
                                style="width: 36px; height: 36px;">
                                <i class="bi bi-mortarboard-fill fs-6"></i>
                            </div>
                            {{ __('Enrollments') }}
                        </h6>
                        <span class="badge rounded-pill bg-info text-white px-3 py-2 fw-bold shadow-sm"
                            id="enrollments-badge">{{ $pendingEnrollmentsCount }}</span>
                    </div>
                    <div class="card-body p-0 position-relative">
                        <div class="scroll-fade-top position-absolute top-0 w-100"
                            style="height: 15px; background: linear-gradient(to bottom, rgba(255,255,255,1), transparent); z-index: 10;">
                        </div>
                        <div class="custom-scrollbar px-2 pb-2" id="enrollments-list"
                            style="max-height: 400px; overflow-y: auto;">
                            @forelse($pendingEnrollments as $enrollment)
                                <div
                                    class="list-item bg-white rounded-3 p-3 m-2 shadow-sm border border-opacity-10 hover-lift transition-all">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center rounded-circle me-3 shadow-sm"
                                            style="width: 40px; height: 40px; font-size: 1.1rem;">
                                            {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                                        </div>
                                        <div class="text-truncate flex-grow-1">
                                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">
                                                {{ $enrollment->user->name }}</div>
                                            <small class="text-muted d-block text-truncate fw-medium"
                                                style="font-size: 0.75rem;"><i
                                                    class="bi bi-book-half me-1"></i>{{ $enrollment->training->name }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 mt-3 pt-2 border-top border-opacity-10">
                                        <form action="{{ route('training_enrollments.update', $enrollment) }}" method="POST"
                                            class="ajax-form flex-grow-1" data-type="enrollments">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="enrolled">
                                            <button type="submit"
                                                class="btn btn-success w-100 rounded-pill py-1 fw-bold shadow-sm hover-scale d-flex justify-content-center align-items-center gap-1"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-check-circle"></i> {{ __('Accept') }}
                                            </button>
                                        </form>
                                        <form action="{{ route('training_enrollments.update', $enrollment) }}" method="POST"
                                            class="ajax-form flex-grow-1" data-type="enrollments">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="dropped">
                                            <button type="submit"
                                                class="btn btn-danger w-100 rounded-pill py-1 fw-bold shadow-sm hover-scale d-flex justify-content-center align-items-center gap-1"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-x-circle"></i> {{ __('Reject') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-journal-text text-info opacity-25 mb-3" style="font-size: 3rem;"></i>
                                    <div class="text-muted fw-medium empty-msg">{{ __('No enrollments') }}</div>
                                </div>
                            @endforelse
                        </div>
                        <div class="scroll-fade-bottom position-absolute bottom-0 w-100"
                            style="height: 15px; background: linear-gradient(to top, rgba(255,255,255,1), transparent); z-index: 10;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advanced Listings Row -->
        <div class="row g-4 mb-5">
            <!-- My Job Posts -->
            <div class="col-lg-6">
                <div class="card rounded-4 shadow border-0 h-100 overflow-hidden animate__animated animate__fadeInUp"
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(59, 130, 246, 0.1) !important;">
                    <div class="card-header border-0 py-4 px-4"
                        style="background: linear-gradient(to right, rgba(59, 130, 246, 0.05), transparent);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="icon-box rounded-3 bg-primary bg-opacity-10 p-2 me-3">
                                    <i class="bi bi-briefcase-fill fs-4 text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bolder text-dark">{{ __('My Job Listings') }}</h5>
                                    <p class="text-muted mb-0 extra-small fw-bold text-uppercase tracking-wider">
                                        {{ __('Active Opportunities') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('jobs.create') }}"
                                class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm hover-scale">
                                <i class="bi bi-plus-lg me-1"></i> {{ __('Post Job') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($myJobs) && $myJobs->count())
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 custom-table">
                                    <thead>
                                        <tr>
                                            <th class="ps-4 py-3 border-0 text-muted extra-small fw-bold">
                                                {{ __('JOB INFORMATION') }}</th>
                                            <th class="py-3 border-0 text-muted extra-small fw-bold text-center">
                                                {{ __('APPLICANTS') }}</th>
                                            <th class="pe-4 py-3 border-0 text-muted extra-small fw-bold text-end">
                                                {{ __('ACTIONS') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($myJobs as $job)
                                            <tr class="table-row-hover">
                                                <td class="ps-4 py-3 border-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                                            style="width: 32px; height: 32px;">
                                                            <i class="bi bi-building text-secondary" style="font-size: 0.9rem;"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold text-dark mb-0">{{ $job->title }}</div>
                                                            <div class="text-muted extra-small">{{ $job->company }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 border-0 text-center">
                                                    <div class="d-inline-flex align-items-center px-2 py-1 rounded-pill bg-blue-subtle text-blue fw-bold"
                                                        style="font-size: 0.75rem;">
                                                        <i class="bi bi-people-fill me-1"></i>
                                                        {{ \App\Models\JobApplication::where('job_id', $job->id)->count() }}
                                                    </div>
                                                </td>
                                                <td class="pe-4 py-3 border-0 text-end">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="{{ route('jobs.show', $job) }}" class="btn-action-view"
                                                            title="{{ __('View') }}"><i class="bi bi-eye"></i></a>
                                                        <a href="{{ route('jobs.edit', $job) }}" class="btn-action-edit"
                                                            title="{{ __('Edit') }}"><i class="bi bi-pencil"></i></a>
                                                        <form action="{{ route('jobs.destroy', $job) }}" method="POST"
                                                            onsubmit="return confirm('{{ __('Are you sure?') }}');"
                                                            class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn-action-delete"
                                                                title="{{ __('Delete') }}"><i class="bi bi-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3 opacity-20">
                                    <i class="bi bi-briefcase" style="font-size: 4rem; color: #3b82f6;"></i>
                                </div>
                                <h6 class="text-dark fw-bold">{{ __('No active listings') }}</h6>
                                <p class="text-muted small mx-auto" style="max-width: 200px;">
                                    {{ __('You haven\'t posted any job opportunities yet.') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- My Training Programs -->
            <div class="col-lg-6">
                <div class="card rounded-4 shadow border-0 h-100 overflow-hidden animate__animated animate__fadeInUp animate__delay-1s"
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(16, 185, 129, 0.1) !important;">
                    <div class="card-header border-0 py-4 px-4"
                        style="background: linear-gradient(to right, rgba(16, 185, 129, 0.05), transparent);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="icon-box rounded-3 bg-success bg-opacity-10 p-2 me-3">
                                    <i class="bi bi-mortarboard-fill fs-4 text-success"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bolder text-dark">{{ __('My Training Programs') }}</h5>
                                    <p class="text-muted mb-0 extra-small fw-bold text-uppercase tracking-wider">
                                        {{ __('Your Courses') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('trainings.create') }}"
                                class="btn btn-success rounded-pill px-4 fw-bold shadow-sm hover-scale">
                                <i class="bi bi-plus-lg me-1"></i> {{ __('New Course') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($myTrainings) && $myTrainings->count())
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 custom-table">
                                    <thead>
                                        <tr>
                                            <th class="ps-4 py-3 border-0 text-muted extra-small fw-bold">
                                                {{ __('COURSE DETAILS') }}</th>
                                            <th class="py-3 border-0 text-muted extra-small fw-bold text-center">
                                                {{ __('STUDENTS') }}</th>
                                            <th class="pe-4 py-3 border-0 text-muted extra-small fw-bold text-end">
                                                {{ __('ACTIONS') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($myTrainings as $training)
                                            <tr class="table-row-hover">
                                                <td class="ps-4 py-3 border-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                                            style="width: 32px; height: 32px;">
                                                            <i class="bi bi-journal-check text-success"
                                                                style="font-size: 0.9rem;"></i>
                                                        </div>
                                                        <div class="text-truncate" style="max-width: 200px;">
                                                            <div class="fw-bold text-dark mb-0">{{ $training->name }}</div>
                                                            <div class="text-muted extra-small">
                                                                {{ Str::limit($training->description, 40) }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 border-0 text-center">
                                                    <div class="d-inline-flex align-items-center px-2 py-1 rounded-pill bg-success-subtle text-success fw-bold"
                                                        style="font-size: 0.75rem;">
                                                        <i class="bi bi-person-fill-check me-1"></i>
                                                        {{ $training->enrollments_count ?? 0 }}
                                                    </div>
                                                </td>
                                                <td class="pe-4 py-3 border-0 text-end">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="{{ route('trainings.edit', $training) }}" class="btn-action-edit"
                                                            title="{{ __('Edit') }}"><i class="bi bi-pencil"></i></a>
                                                        @if(auth()->user()->id === $training->mentor_id || auth()->user()->role === 'admin')
                                                            <form action="{{ route('trainings.destroy', $training) }}" method="POST"
                                                                onsubmit="return confirm('{{ __('Are you sure?') }}');"
                                                                class="d-inline">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn-action-delete"
                                                                    title="{{ __('Delete') }}"><i class="bi bi-trash"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3 opacity-20">
                                    <i class="bi bi-mortarboard" style="font-size: 4rem; color: #10b981;"></i>
                                </div>
                                <h6 class="text-dark fw-bold">{{ __('No active courses') }}</h6>
                                <p class="text-muted small mx-auto" style="max-width: 200px;">
                                    {{ __('Start by creating your first training program.') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes pulse-ring {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.4); }
        }

        /* Action button styling */
        .hover-bg-light:hover {
            background-color: #f8fafc;
        }

        .transition-all {
            transition: all 0.2s ease-in-out;
        }

        /* Custom scrollbar for cards */
        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .list-item {
            transition: all 0.3s ease;
        }

        .list-item.removing {
            transform: scale(0.95);
            opacity: 0;
        }

        .extra-small {
            font-size: 0.65rem;
            letter-spacing: 0.05em;
        }

        .small-head {
            font-size: 1.1rem;
        }

        .tracking-wider {
            letter-spacing: 0.1em;
        }

        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .custom-table thead th {
            text-transform: uppercase;
            font-size: 0.65rem;
            padding: 1rem 0.75rem;
        }

        .table-row-hover {
            transition: background-color 0.2s ease;
        }

        .table-row-hover:hover {
            background-color: rgba(0, 0, 0, 0.015) !important;
        }

        /* Advanced Request Box Styles */
        .premium-request-card {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
        }

        .premium-request-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08) !important;
            transform: translateY(-4px);
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05) !important;
        }

        .hover-opacity-10:hover {
            opacity: 0.05 !important;
        }

        .pointer-events-none {
            pointer-events: none;
        }

        .avatar-circle {
            box-shadow: inset 0 2px 4px rgba(255, 255, 255, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .bg-indigo {
            background-color: #6366f1;
        }

        .bg-indigo-subtle {
            background-color: #e0e7ff;
        }

        .text-indigo {
            color: #4338ca;
        }

        .bg-warning-subtle {
            background-color: #fef3c7;
        }

        .bg-danger-subtle {
            background-color: #fee2e2;
        }

        .bg-success-subtle {
            background-color: #d1fae5;
        }

        .bg-info-subtle {
            background-color: #cffafe;
        }

        .text-warning {
            color: #d97706;
        }

        .text-danger {
            color: #dc2626;
        }

        .text-success {
            color: #059669;
        }

        .text-info {
            color: #0891b2;
        }

        .scroll-fade-top,
        .scroll-fade-bottom {
            pointer-events: none;
        }

        /* Advanced Action Buttons */
        .btn-action-view,
        .btn-action-edit,
        .btn-action-delete {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
            background: #f8fafc;
        }

        .btn-action-view {
            color: #3b82f6;
        }

        .btn-action-view:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-edit {
            color: #f59e0b;
        }

        .btn-action-edit:hover {
            background: #f59e0b;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-delete {
            color: #ef4444;
        }

        .btn-action-delete:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-2px);
        }

        .bg-blue-subtle {
            background-color: #e0f2fe;
        }

        .text-blue {
            color: #0369a1;
        }

        .floating-icon {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .icon-stat-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.ajax-form');

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const type = this.dataset.type;
                    const listItem = this.closest('.list-item');
                    const btn = this.querySelector('button');
                    const originalContent = btn.innerHTML;

                    // Loading state
                    btn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span>';

                    const formData = new FormData(this);

                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Success toast
                                showToast(data.message, 'success');

                                // Remove item with animation
                                if (listItem) {
                                    listItem.classList.add('removing');
                                    setTimeout(() => {
                                        listItem.remove();
                                        updateCounters(type, data.status);
                                        checkEmpty(type);
                                    }, 300);
                                }
                            } else {
                                showToast('{{ __("An error occurred") }}', 'danger');
                                btn.disabled = false;
                                btn.innerHTML = originalContent;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast('{{ __("An error occurred") }}', 'danger');
                            btn.disabled = false;
                            btn.innerHTML = originalContent;
                        });
                });
            });

            function updateCounters(type, status) {
                // Update Stat card counter
                const statId = type === 'job-requests' ? 'job-requests-stat' : (type === 'enrollments' ? 'enrollments-stat' : null);
                if (statId) {
                    const statCounter = document.getElementById(statId);
                    if (statCounter) {
                        let val = parseInt(statCounter.innerText);
                        statCounter.innerText = Math.max(0, val - 1);
                    }
                }

                if (type === 'mentorship' && status === 'approved') {
                    const activeMenteesStat = document.getElementById('active-mentees-stat');
                    if (activeMenteesStat) {
                        activeMenteesStat.innerText = parseInt(activeMenteesStat.innerText) + 1;
                    }
                }

                // Update Section badge counter
                if (type === 'my-applications') {
                    const badge = document.querySelector('[style*="border-top: 4px solid #6366f1"] .badge');
                    if (badge) {
                        let val = parseInt(badge.innerText);
                        badge.innerText = Math.max(0, val - 1);
                    }
                    return;
                }

                const badgeId = type + '-badge';
                const badge = document.getElementById(badgeId);
                if (badge) {
                    let val = parseInt(badge.innerText);
                    badge.innerText = Math.max(0, val - 1);
                } else if (type === 'mentorship') {
                    const mentBadge = document.getElementById('mentorship-badge');
                    if (mentBadge) {
                        let val = parseInt(mentBadge.innerText);
                        mentBadge.innerText = Math.max(0, val - 1);
                    }
                }
            }

            function checkEmpty(type) {
                const listId = type === 'my-applications' ? null : type + '-list';
                if (!listId && type === 'my-applications') {
                    const list = document.querySelector('[style*="border-top: 4px solid #6366f1"] .card-body');
                    if (list && list.querySelectorAll('.list-item').length === 0) {
                        list.innerHTML = `<div class="text-center py-5">
                                        <i class="bi bi-inbox text-indigo opacity-25 mb-3" style="font-size: 3rem;"></i>
                                        <div class="text-muted fw-medium empty-msg">{{ __('No applications') }}</div>
                                    </div>`;
                    }
                    return;
                }
                const list = document.getElementById(listId);
                if (list && list.querySelectorAll('.list-item').length === 0) {
                    let icon = 'bi-inbox';
                    let color = 'text-muted';
                    if (type === 'job-requests') { icon = 'bi-briefcase'; color = 'text-danger'; }
                    else if (type === 'mentorship') { icon = 'bi-person-hearts'; color = 'text-warning'; }
                    else if (type === 'enrollments') { icon = 'bi-journal-text'; color = 'text-info'; }

                    list.innerHTML = `<div class="text-center py-5">
                                        <i class="bi ${icon} ${color} opacity-25 mb-3" style="font-size: 3rem;"></i>
                                        <div class="text-muted fw-medium empty-msg">{{ __('No pending items') }}</div>
                                    </div>`;
                }
            }

            function showToast(message, type) {
                const container = document.querySelector('.toast-container');
                if (!container) return;

                const html = `
                            <div class="toast align-items-center text-white bg-${type} border-0 shadow-lg rounded-4 animate__animated animate__fadeInRight" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body d-flex align-items-center">
                                        <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'}-fill fs-5 me-2"></i>
                                        <div>${message}</div>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>`;

                container.insertAdjacentHTML('beforeend', html);
                const toastEl = container.querySelector('.toast:last-child');
                new bootstrap.Toast(toastEl, { delay: 3000 }).show();
            }
        });
    </script>
@endsection