@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Super Premium Welcome Header -->
        <div class="rounded-5 p-5 mb-5 position-relative overflow-hidden animate__animated animate__fadeIn shadow-2xl"
            style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); color:white;">

            <!-- Animated Background Blobs -->
            <div class="position-absolute blob shadow-lg"
                style="top:-100px;right:-100px;width:500px;height:500px;background:radial-gradient(circle, rgba(245,158,11,0.15) 0%, transparent 70%);border-radius:50%; animation: pulse-slow 8s infinite alternate;">
            </div>
            <div class="position-absolute blob shadow-lg"
                style="bottom:-50px;left:-10px;width:350px;height:350px;background:radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%);border-radius:50%; animation: pulse-slow 12s infinite alternate-reverse;">
            </div>

            <div class="row align-items-center position-relative z-1">
                <div class="col-lg-8">
                    <div
                        class="d-inline-flex align-items-center bg-white bg-opacity-10 backdrop-blur-md rounded-pill px-4 py-2 mb-4 border border-white border-opacity-20 shadow-sm">
                        <i class="bi bi-stars text-warning me-2 fs-5"></i>
                        <span class="small fw-black text-uppercase tracking-widest"
                            style="letter-spacing: 2px;">{{ __('ELITE STUDENT PORTAL') }}</span>
                    </div>
                    <h1 class="display-3 fw-black mb-3 text-white" style="letter-spacing: -3px; line-height: 0.9;">
                        {{ __('Welcome back,') }}<br>
                        <span class="text-warning position-relative">
                            {{ Auth::user()->name }}
                            <div class="position-absolute bottom-0 start-0 w-100"
                                style="height: 8px; background: rgba(245,158,11,0.3); bottom: 10px; z-index: -1;"></div>
                        </span>!
                    </h1>
                    <p class="text-white-50 mt-4 mb-0 fw-medium fs-5 lh-base" style="max-width: 650px; opacity: 0.8;">
                        {{ __('Your journey to excellence continues here. Explore high-tier mentorship, pro-level training, and career-defining opportunities.') }}
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end mt-5 mt-lg-0">
                    <!-- Advanced Quick Access Card -->
                    <div
                        class="search-glass p-4 rounded-5 border border-white border-opacity-10 d-inline-block text-start shadow-2xl transform-hover transition-all">
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div class="rounded-circle p-1 bg-white bg-opacity-20 shadow-inner">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=f59e0b&color=1e1b4b&size=60&bold=true"
                                    class="rounded-circle border border-white border-2" width="60" height="60">
                            </div>
                            <div>
                                <div class="small text-white-50 fw-black text-uppercase tracking-wider"
                                    style="font-size: 0.65rem;">{{ __('Verified Member') }}</div>
                                <div class="fw-black text-white fs-5 text-truncate" style="max-width: 180px;">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                        <div class="vstack gap-2">
                            <a href="{{ route('jobs.index') }}"
                                class="btn btn-warning w-100 rounded-pill py-3 fw-black shadow-lg hover-lift d-flex align-items-center justify-content-center gap-2"
                                style="color: #1e1b4b;">
                                <i class="bi bi-briefcase-fill"></i> {{ __('EXPLORE JOBS') }}
                            </a>
                            <a href="{{ route('profile.edit') }}"
                                class="btn btn-outline-white-glass w-100 rounded-pill py-3 fw-black hover-lift d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-person-gear"></i> {{ __('SETTINGS') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Super Advanced Stat Cards -->
        <div class="row g-4 mb-5">
            <!-- Job Stat -->
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div
                    class="advanced-stat-card h-100 p-4 rounded-5 border border-light bg-white shadow-soft transition-all hover-glow group position-relative overflow-hidden">
                    <div class="position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm"
                                style="width: 50px; height: 50px; background: #e0e7ff;">
                                <i class="bi bi-briefcase-fill fs-3 text-primary"></i>
                            </div>
                            <span
                                class="badge rounded-pill bg-soft-warning text-warning fw-black small-caps px-3 py-2 border border-warning border-opacity-10">JOBS</span>
                        </div>
                        <h2 class="display-5 fw-black mb-1 text-dark">{{ $jobsCount }}</h2>
                        <p class="text-muted small fw-bold mb-0 text-uppercase tracking-widest">{{ __('Active Listings') }}
                        </p>
                        <div class="mt-4 pt-3 border-top border-light d-flex justify-content-between align-items-center">
                            <span class="small fw-black text-indigo-600">{{ __('GO TO BOARD') }}</span>
                            <div class="rounded-circle bg-soft-primary p-2 d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-arrow-right text-indigo-600"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('jobs.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <!-- Training Stat -->
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div
                    class="advanced-stat-card h-100 p-4 rounded-5 border border-light bg-white shadow-soft transition-all hover-glow group position-relative overflow-hidden">
                    <div class="position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm"
                                style="width: 50px; height: 50px; background: #dcfce7;">
                                <i class="bi bi-lightning-charge-fill fs-3 text-success"></i>
                            </div>
                            <span
                                class="badge rounded-pill bg-soft-success text-success fw-black small-caps px-3 py-2 border border-success border-opacity-10">LIVE</span>
                        </div>
                        <h2 class="display-5 fw-black mb-1 text-dark">{{ $trainingsCount }}</h2>
                        <p class="text-muted small fw-bold mb-0 text-uppercase tracking-widest">{{ __('Open Courses') }}</p>
                        <div class="mt-4 pt-3 border-top border-light d-flex justify-content-between align-items-center">
                            <span class="small fw-black text-emerald-600">{{ __('START LEARNING') }}</span>
                            <div class="rounded-circle bg-soft-success p-2 d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-arrow-right text-emerald-600"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('trainings.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <!-- Mentors Stat -->
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div
                    class="advanced-stat-card h-100 p-4 rounded-5 border border-light bg-white shadow-soft transition-all hover-glow group position-relative overflow-hidden">
                    <div class="position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm"
                                style="width: 50px; height: 50px; background: #fef3c7;">
                                <i class="bi bi-person-heart fs-3 text-warning"></i>
                            </div>
                            <span
                                class="badge rounded-pill bg-soft-warning text-warning fw-black small-caps px-3 py-2 border border-warning border-opacity-10">COMMUNITY</span>
                        </div>
                        <h2 class="display-5 fw-black mb-1 text-dark">{{ count($myRequests) }}</h2>
                        <p class="text-muted small fw-bold mb-0 text-uppercase tracking-widest">{{ __('My Mentors') }}</p>
                        <div class="mt-4 pt-3 border-top border-light d-flex justify-content-between align-items-center">
                            <span class="small fw-black text-warning">{{ __('GET GUIDED') }}</span>
                            <div class="rounded-circle bg-soft-warning p-2 d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-arrow-right text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('mentors.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <!-- Tracking Stat -->
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <div
                    class="advanced-stat-card h-100 p-4 rounded-5 border border-light bg-white shadow-soft transition-all hover-glow group position-relative overflow-hidden">
                    <div class="position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm"
                                style="width: 50px; height: 50px; background: #e0f2fe;">
                                <i class="bi bi-activity fs-3 text-info"></i>
                            </div>
                            <span
                                class="badge rounded-pill bg-soft-primary text-primary fw-black small-caps px-3 py-2 border border-primary border-opacity-10">PROGRESS</span>
                        </div>
                        <h2 class="display-5 fw-black mb-1 text-dark">{{ $pendingRequestsCount }}</h2>
                        <p class="text-muted small fw-bold mb-0 text-uppercase tracking-widest">{{ __('Pending Tasks') }}
                        </p>
                        <div class="mt-4 pt-3 border-top border-light d-flex justify-content-between align-items-center">
                            <span class="small fw-black text-primary">{{ __('VIEW STATUS') }}</span>
                            <div class="rounded-circle bg-soft-primary p-2 d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-arrow-right text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <a href="#mentorship-requests-section" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <!-- Integrated Premium Notifications -->
        @php
            $unreadNotifications = Auth::user()->notifications()->where('read', false)->count();
            $recentNotifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->take(5)->get();
        @endphp
        @if($unreadNotifications > 0 || $recentNotifications->count() > 0)
            <div class="row g-4 mb-5 animate__animated animate__fadeInUp">
                <div class="col-12">
                    <div class="advanced-glass-card rounded-5 border-0 shadow-lg overflow-hidden position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-100 backdrop-blur-xl"
                            style="background: rgba(255,255,255,0.4);"></div>
                        <div class="card-body p-4 position-relative z-1">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm"
                                        style="width:50px;height:50px;background:#e0e7ff;">
                                        <i class="bi bi-bell-fill fs-3 text-primary"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-black text-dark">{{ __('Recent Updates') }}</h5>
                                        <p class="text-muted small fw-bold mb-0">
                                            {{ __('You have :count unread notifications', ['count' => $unreadNotifications]) }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('notifications.index') }}"
                                    class="btn btn-dark rounded-pill px-4 py-2 fw-black small-caps shadow-sm hover-lift border-0"
                                    style="background: #1e1b4b;">
                                    {{ __('VIEW ALL') }} <i class="bi bi-arrow-right-short ms-1 fs-5"></i>
                                </a>
                            </div>

                            @if($recentNotifications->count() > 0)
                                <div class="notification-scroll-area pe-2" style="max-height: 280px; overflow-y: auto;">
                                    @foreach($recentNotifications as $notification)
                                        <div class="d-flex gap-4 p-3 mb-3 rounded-4 transition-all {{ !$notification->read ? 'bg-white shadow-md border-indigo-200' : 'bg-white bg-opacity-40 border-transparent' }} border"
                                            style="border-left: 4px solid {{ !$notification->read ? '#f59e0b' : '#e2e8f0' }};">
                                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle bg-light"
                                                style="width: 45px; height: 45px;">
                                                <i
                                                    class="bi {{ \App\Services\NotificationService::getIcon($notification->type) }} fs-4 text-indigo-600"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <p
                                                        class="mb-1 {{ !$notification->read ? 'fw-black text-dark' : 'text-muted fw-bold' }} fs-6">
                                                        {{ $notification->title }}
                                                    </p>
                                                    <small class="text-muted fw-bold"
                                                        style="font-size: 0.7rem;">{{ $notification->created_at->diffForHumans() }}</small>
                                                </div>
                                                <p class="text-muted small mb-0 line-clamp-1 opacity-75">{{ $notification->message }}
                                                </p>
                                            </div>
                                            @if(!$notification->read)
                                                <div class="d-flex align-items-center">
                                                    <form action="{{ route('notifications.read', $notification) }}" method="POST"
                                                        class="m-0">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-soft-warning rounded-circle p-2 d-flex align-items-center justify-content-center border-0"
                                                            title="{{ __('Mark as read') }}" style="width: 32px; height: 32px;">
                                                            <i class="bi bi-check-lg fw-black"></i>
                                                        </button>
                                                    </form>
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

        <!-- Main Dashboard Layout Grid -->
        <div class="row g-4 mb-5">
            <!-- Left Column: Opportunities & Feeds -->
            <div class="col-12 col-lg-8">
                <!-- Training Programs Section (Already Upgraded Previously) -->
                <!-- Premium Training Programs Section -->
                <div
                    class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5 animate__animated animate__fadeInUp position-relative">
                    <div class="card-header bg-white py-4 border-0 px-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:50px;height:50px;background:#dcfce7;">
                                    <i class="bi bi-mortarboard-fill fs-3 text-success"></i>
                                </div>
                                <div>
                                    <h4 class="fw-black mb-0 text-dark position-relative d-inline-block">
                                        {{ __('Training Programs') }}
                                        <div class="position-absolute bottom-0 start-0 w-50"
                                            style="height: 3px; background: #f59e0b; border-radius: 2px; bottom: -8px;">
                                        </div>
                                    </h4>
                                    <p class="text-muted small mt-2 mb-0 fw-medium">
                                        {{ __('Boost your skills with expert-led courses') }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('trainings.index') }}"
                                class="btn btn-sm rounded-pill px-4 fw-bold hover-lift border-0 shadow-sm"
                                style="background: #fef3c7; color: #b45309;">
                                {{ __('Explore All') }} <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if(isset($availableTrainings) && $availableTrainings->count() > 0)
                            <div class="row g-4 row-cols-1 row-cols-md-2">
                                @foreach($availableTrainings as $training)
                                    <div class="col">
                                        <div
                                            class="advanced-glass-card h-100 p-4 rounded-5 border border-white border-opacity-10 transition-all hover-glow position-relative overflow-hidden group">

                                            <div class="position-relative z-1 h-100 d-flex flex-column">
                                                <div class="d-flex align-items-center gap-3 mb-4">
                                                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm"
                                                        style="width: 50px; height: 50px; background: #fef3c7;">
                                                        <i class="bi bi-lightning-charge-fill text-warning fs-3"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-black mb-1 text-dark">{{ $training->name }}</h5>
                                                        <span
                                                            class="badge rounded-pill bg-soft-warning text-warning small fw-bold">PRO
                                                            LEVEL</span>
                                                    </div>
                                                </div>

                                                <div class="mt-auto">
                                                    <div class="d-flex align-items-center gap-4 mb-4 text-muted small fw-bold">
                                                        <span><i class="bi bi-clock-history me-1 text-primary"></i> 12h</span>
                                                        <span><i class="bi bi-person-badge me-1 text-success"></i>
                                                            {{ $training->mentor->name ?? __('Mentor') }}</span>
                                                        <span><i class="bi bi-bar-chart-fill me-1 text-info"></i>
                                                            {{ __('Intermediate') }}</span>
                                                    </div>

                                                    <a href="{{ route('trainings.show', $training) }}"
                                                        class="btn btn-dark w-100 rounded-pill py-3 fw-black shadow-lg hover-lift border-0"
                                                        style="background: #1e1b4b; letter-spacing: 1px;">
                                                        {{ __('ENROLL NOW') }} <i class="bi bi-chevron-right ms-2 small"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-journal-x fs-1 text-muted opacity-25 mb-3"></i>
                                <h6 class="fw-bold text-muted">{{ __('No trainings available right now') }}</h6>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Premium Job Opportunities Section -->
                <div
                    class="card border-0 shadow-sm rounded-5 overflow-hidden animate__animated animate__fadeInUp position-relative">
                    <div class="card-header bg-white py-4 border-0 px-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:50px;height:50px;background:#e0e7ff;">
                                    <i class="bi bi-briefcase-fill fs-3 text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="fw-black mb-0 text-dark position-relative d-inline-block">
                                        {{ __('Featured Jobs') }}
                                        <div class="position-absolute bottom-0 start-0 w-50"
                                            style="height: 3px; background: #f59e0b; border-radius: 2px; bottom: -8px;">
                                        </div>
                                    </h4>
                                    <p class="text-muted small mt-2 mb-0 fw-medium">
                                        {{ __('Top positions matching your profile') }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('jobs.index') }}"
                                class="btn btn-sm rounded-pill px-4 fw-bold hover-lift border-0 shadow-sm"
                                style="background: #e0e7ff; color: #1e1b4b;">
                                {{ __('Browse All') }} <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="vstack gap-4">
                            @if(isset($recentJobs) && $recentJobs->count() > 0)
                                @foreach($recentJobs as $job)
                                    <div
                                        class="advanced-job-card p-4 rounded-5 border border-light bg-white shadow-sm transition-all hover-glow group position-relative overflow-hidden">

                                        <div class="row align-items-center position-relative z-1">
                                            <div class="col-md-7">
                                                <div class="d-flex align-items-center gap-4">
                                                    <div class="job-brand-icon p-3 rounded-4 bg-indigo-950 shadow-lg d-flex align-items-center justify-content-center fw-black text-white"
                                                        style="width: 55px; height: 55px; font-size: 1.2rem;">
                                                        {{ strtoupper(substr($job->company ?? 'C', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-black mb-1 text-dark">{{ $job->title }}</h5>
                                                        <div class="d-flex gap-3 mt-2">
                                                            <span class="small fw-bold text-muted"><i
                                                                    class="bi bi-building me-1"></i>
                                                                {{ $job->company ?? 'Company' }}</span>
                                                            <span class="small fw-bold text-muted"><i
                                                                    class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                                                {{ $job->location ?? 'Remote' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 text-md-end mt-4 mt-md-0">
                                                <div class="d-flex align-items-center justify-content-md-end gap-3">
                                                    @php $application = $myApplications[$job->id] ?? null; @endphp
                                                    @if($application)
                                                        <span
                                                            class="badge rounded-pill px-4 py-3 border {{ $application->status == 'approved' ? 'bg-soft-success text-success border-success' : ($application->status == 'rejected' ? 'bg-soft-danger text-danger border-danger' : 'bg-soft-warning text-warning border-warning') }} fw-bold text-uppercase tracking-wider small">
                                                            {{ __(ucfirst($application->status)) }}
                                                        </span>
                                                        @if($application->status == 'pending')
                                                            <form action="{{ route('job_applications.destroy', $application) }}"
                                                                method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-outline-danger rounded-circle p-2 border-0 hover-lift"
                                                                    title="{{ __('Cancel') }}">
                                                                    <i class="bi bi-trash3-fill fs-5"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <span
                                                            class="badge bg-light text-dark fw-bold px-3 py-2 rounded-pill small me-2">$2K
                                                            - 5K</span>
                                                        <form action="{{ route('job_applications.store', $job) }}" method="POST">
                                                            @csrf
                                                            <button
                                                                class="btn btn-primary rounded-pill px-5 py-3 fw-black shadow-lg hover-lift text-white border-0"
                                                                style="background: #1e1b4b; letter-spacing: 1px;">
                                                                {{ __('APPLY') }} <i class="bi bi-check-lg ms-1"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Meta Info Strip -->
                                        <div class="mt-4 pt-3 border-top border-light d-flex gap-4">
                                            <div class="small fw-bold text-muted d-flex align-items-center">
                                                <i class="bi bi-briefcase-fill me-2 text-primary"></i> {{ __('Full Time') }}
                                            </div>
                                            <div class="small fw-bold text-muted d-flex align-items-center">
                                                <i class="bi bi-calendar2-event-fill me-2 text-info"></i> {{ __('3 days ago') }}
                                            </div>
                                            <div class="small fw-bold text-muted d-flex align-items-center ms-auto">
                                                <i class="bi bi-people-fill me-2 text-success"></i> 12 {{ __('Applicants') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted opacity-25"></i>
                                    <p class="text-muted mt-2 fw-bold">{{ __('No jobs found') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Premium Sidebar -->
            <div class="col-12 col-lg-4">
                <!-- Advanced Profile Card -->
                <div
                    class="advanced-glass-card p-4 mb-4 rounded-5 border-0 shadow-lg position-relative overflow-hidden transition-all hover-translate-y-n2">
                    <div class="position-absolute top-0 start-0 w-100 h-100"
                        style="background: radial-gradient(circle at top right, rgba(245,158,11,0.08) 0%, transparent 60%);">
                    </div>

                    <div class="position-relative z-1 text-center py-2">
                        <div class="position-relative d-inline-block mb-4">
                            <!-- Premium Gold Progress Ring -->
                            <svg class="profile-progress" width="130" height="130" viewBox="0 0 120 120">
                                <circle class="progress-ring-bg" cx="60" cy="60" r="54" fill="transparent"
                                    stroke="rgba(0,0,0,0.03)" stroke-width="6" />
                                <circle class="progress-ring-fill pulse-gold" cx="60" cy="60" r="54" fill="transparent"
                                    stroke="#f59e0b" stroke-width="8" stroke-dasharray="339.29" stroke-dashoffset="150"
                                    stroke-linecap="round" />
                            </svg>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1e1b4b&color=fff&size=100&bold=true"
                                    alt="Profile" class="rounded-circle shadow-lg border border-white border-4"
                                    style="width: 95px; height: 95px; object-fit: cover;">
                            </div>
                            <div class="position-absolute bottom-0 end-0 bg-success border border-white border-4 rounded-circle pulse-green"
                                style="width: 22px; height: 22px; margin-right: 15px; margin-bottom: 5px;"></div>
                        </div>

                        <h4 class="fw-black mb-1 text-dark">{{ Auth::user()->name }}</h4>
                        <p class="text-muted small fw-bold mb-4 opacity-75">{{ Auth::user()->email }}</p>

                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <div class="px-3 py-2 bg-white bg-opacity-50 rounded-pill border border-light shadow-sm">
                                <span class="badge rounded-circle bg-indigo-600 p-1 me-2"
                                    style="width:8px;height:8px;display:inline-block"></span>
                                <span
                                    class="small fw-black text-indigo-900 text-uppercase tracking-wider">{{ __(ucfirst(Auth::user()->role ?? 'Student')) }}</span>
                            </div>
                            <div class="px-3 py-2 bg-indigo-950 text-white rounded-pill shadow-lg">
                                <span class="small fw-black text-warning">45% {{ __('COMPLETED') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="btn btn-indigo-gold w-100 rounded-pill fw-black py-3 shadow-lg hover-lift d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-lightning-fill"></i> {{ __('OPTIMIZE PROFILE') }}
                        </a>
                    </div>
                </div>

                <!-- Advanced Mentorship Status -->
                <div class="advanced-glass-card p-4 mb-4 rounded-5 border-0 shadow-lg" id="mentorship-requests-section">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-light">
                        <h6 class="fw-black mb-0 text-dark d-flex align-items-center gap-2">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:50px;height:50px;background:#fef3c7;">
                                <i class="bi bi-person-heart fs-3 text-warning"></i>
                            </div>
                            {{ __('Mentorship Flow') }}
                        </h6>
                        <span
                            class="badge bg-indigo-950 text-white rounded-pill px-3 py-2 small fw-black shadow-sm">{{ count($myRequests) }}</span>
                    </div>

                    @if($myRequests && count($myRequests) > 0)
                        <div class="vstack gap-3">
                            @foreach($myRequests->take(3) as $req)
                                <div
                                    class="p-3 bg-white bg-opacity-40 rounded-4 border border-white border-opacity-50 shadow-sm transition-all hover-translate-x-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($req->mentor->name ?? 'M') }}&background=1e1b4b&color=fff&size=40&bold=true"
                                                    class="rounded-circle border border-white border-2 shadow-sm" width="40"
                                                    height="40">
                                                <div class="position-absolute bottom-0 end-0 bg-warning rounded-circle"
                                                    style="width:12px; height:12px; border: 2px solid white"></div>
                                            </div>
                                            <div>
                                                <h6 class="small fw-black mb-0 text-dark">{{ $req->mentor->name ?? __('Unknown') }}
                                                </h6>
                                                <small class="text-muted fw-bold small-caps">{{ __('MENTOR') }}</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            @php
                                                $st = $req->status;
                                                $statusColor = $st == 'approved' ? '#10b981' : ($st == 'rejected' ? '#ef4444' : '#f59e0b');
                                            @endphp
                                            <span class="badge rounded-pill px-2 py-1 small fw-black text-uppercase"
                                                style="background: {{ $statusColor }}20; color: {{ $statusColor }}; font-size: 0.6rem;">{{ __($st) }}</span>

                                            @if($st === 'pending')
                                                <form action="{{ route('mentorship_requests.destroy', $req) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('Are you sure?') }}');" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0 border-0 hover-scale"
                                                        title="{{ __('Cancel Request') }}">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 rounded-4 border border-dashed border-light">
                            <i class="bi bi-people text-muted opacity-25 display-6 mb-2 d-block"></i>
                            <p class="text-muted small fw-bold mb-0 text-uppercase tracking-tighter">
                                {{ __('No Mentorship Activity') }}
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Premium Learning Progress -->
                <div class="advanced-glass-card p-4 mb-4 rounded-5 border-0 shadow-lg">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-light">
                        <h6 class="fw-black mb-0 text-dark d-flex align-items-center gap-2">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:50px;height:50px;background:#e0f2fe;">
                                <i class="bi bi-play-circle-fill fs-3 text-info"></i>
                            </div>
                            {{ __('My Academy') }}
                        </h6>
                    </div>
                    @if(isset($myTrainings) && $myTrainings->count() > 0)
                        <div class="vstack gap-3">
                            @foreach($myTrainings->take(2) as $enrollment)
                                <div class="p-3 bg-white bg-opacity-40 rounded-4 border border-white border-opacity-50">
                                    <h6 class="small fw-black mb-2 text-dark text-truncate">{{ $enrollment->training->name }}</h6>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress flex-grow-1 shadow-inner"
                                            style="height: 6px; border-radius: 10px; background: rgba(0,0,0,0.05);">
                                            <div class="progress-bar bg-info rounded-pill"
                                                style="width: {{ $enrollment->status == 'completed' ? '100%' : ($enrollment->status == 'enrolled' ? '45%' : '10%') }}">
                                            </div>
                                        </div>
                                        <span class="small fw-black text-indigo-900"
                                            style="font-size: 0.65rem;">{{ $enrollment->status == 'completed' ? '100%' : '45%' }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 rounded-4 border border-dashed border-light">
                            <i class="bi bi-mortarboard text-muted opacity-25 display-6 mb-2 d-block"></i>
                            <p class="text-muted small fw-bold mb-0 text-uppercase tracking-tighter">
                                {{ __('Enroll in Your First Course') }}
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Black-Gold Pro Tips -->
                <div
                    class="card border-0 shadow-2xl rounded-5 p-4 bg-indigo-950 text-white overflow-hidden position-relative">
                    <div class="position-relative z-1">
                        <h6 class="fw-black mb-3 d-flex align-items-center gap-2 text-warning">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:40px;height:40px;background:#fef3c7;">
                                <i class="bi bi-stars fs-5 text-warning"></i>
                            </div>
                            {{ __('EXPERT TIPS') }}
                        </h6>
                        <ul class="small list-unstyled mb-0 vstack gap-3">
                            <li class="d-flex align-items-start gap-3">
                                <i class="bi bi-patch-check-fill text-warning mt-1"></i>
                                <span class="fw-medium text-white-50"><strong
                                        class="text-white">{{ __('Verify Identity:') }}</strong>
                                    {{ __('Verified users get 40% more mentor responses.') }}</span>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <i class="bi bi-patch-check-fill text-warning mt-1"></i>
                                <span class="fw-medium text-white-50"><strong
                                        class="text-white">{{ __('Skill Gaps:') }}</strong>
                                    {{ __('Check training modules to match job requirements.') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-indigo: #1e1b4b;
            --accent-gold: #f59e0b;
            --luxury-gradient: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            --glass-bg: rgba(255, 255, 255, 0.7);
        }

        .fw-black {
            font-weight: 900;
        }

        .tracking-widest {
            letter-spacing: 0.25em;
        }

        .small-caps {
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 1px;
        }

        /* Advanced Glassmorphism */
        .advanced-glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05);
            border-radius: 2.5rem;
        }

        .search-glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Animations */
        @keyframes pulse-slow {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            100% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        @keyframes gold-glow {
            0% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(245, 158, 11, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
            }
        }

        .pulse-gold {
            animation: gold-glow 3s infinite;
        }

        .pulse-blue {
            animation: blue-glow 3s infinite;
        }

        @keyframes blue-glow {
            0% {
                box-shadow: 0 0 0 0 rgba(49, 46, 129, 0.4);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(49, 46, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(49, 46, 129, 0);
            }
        }

        /* Custom Utility Classes */
        .bg-indigo-950 {
            background-color: #0c0a2d;
        }

        .text-indigo-900 {
            color: #1e1b4b;
        }

        .text-indigo-600 {
            color: #4f46e5;
        }

        .bg-soft-primary {
            background: rgba(79, 70, 229, 0.08);
        }

        .bg-soft-warning {
            background: rgba(245, 158, 11, 0.1);
        }

        .bg-soft-success {
            background: rgba(16, 185, 129, 0.1);
        }

        .bg-soft-info {
            background: rgba(14, 165, 233, 0.1);
        }

        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .shadow-soft {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.03);
        }

        .btn-indigo-gold {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-indigo-gold:hover {
            color: #fff;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 30px -5px rgba(30, 27, 75, 0.4);
            border-color: #f59e0b;
        }

        .btn-outline-white-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-outline-white-glass:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-color: white;
        }

        .hover-glow:hover {
            box-shadow: 0 20px 40px -10px rgba(30, 27, 75, 0.1), 0 0 20px rgba(245, 158, 11, 0.05) !important;
            border-color: rgba(245, 158, 11, 0.3) !important;
            transform: translateY(-5px);
        }

        .hover-translate-y-n2:hover {
            transform: translateY(-8px);
        }

        .hover-translate-x-2:hover {
            transform: translateX(8px);
        }

        /* Stats Styling */
        .stat-icon-box {
            transition: all 0.3s ease;
        }

        .group:hover .stat-icon-box {
            transform: scale(1.1) rotate(5deg);
        }

        /* Profile Ring */
        .profile-progress {
            transform: rotate(-90deg);
        }

        .progress-ring-fill {
            transition: stroke-dashoffset 0.8s ease-in-out;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .shadow-inner {
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection