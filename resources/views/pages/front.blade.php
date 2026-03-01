@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">

        @if(auth()->user()->role === 'admin')
            {{-- ADMIN FRONT --}}
            <div
                class="hero-section bg-dark text-white rounded-5 p-5 mb-5 position-relative overflow-hidden shadow-lg animate__animated animate__fadeIn">
                <div class="position-absolute top-0 end-0 p-4 opacity-10 pointer-events-none"
                    style="transform: scale(2) translate(10%, -10%);">
                    <i class="bi bi-shield-check" style="font-size: 15rem;"></i>
                </div>
                <div class="position-relative z-1 max-w-2xl">
                    <span
                        class="badge bg-primary bg-opacity-25 text-primary rounded-pill px-3 py-2 mb-3 fw-bold border border-primary border-opacity-25 text-uppercase tracking-wider">
                        <i class="bi bi-lightning-charge-fill me-1"></i> {{ __('Platform Overview') }}
                    </span>
                    <h1 class="display-4 fw-black mb-3" style="letter-spacing: -1px;">
                        {{ __('Welcome back') }}, <span class="text-primary">{{ auth()->user()->name }}</span>
                    </h1>
                    <p class="lead text-white-50 mb-4 fw-medium">
                        {{ __('Monitor platform activity, manage users, and oversee the entire Graduate Career ecosystem from your command center.') }}
                    </p>
                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <a href="{{ route('home') }}"
                            class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift d-flex align-items-center gap-2">
                            <i class="bi bi-grid-fill"></i> {{ __('Access Dashboard') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                            <h2 class="fw-black text-dark mb-0 fs-1">{{ $usersCount }}</h2>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">{{ __('Total Users') }}</h5>
                        <p class="text-muted small mb-0">{{ __('Registered students & alumni') }}</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-briefcase-fill fs-4"></i>
                            </div>
                            <h2 class="fw-black text-dark mb-0 fs-1">{{ $jobsCount }}</h2>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">{{ __('Active Jobs') }}</h5>
                        <p class="text-muted small mb-0">{{ __('Opportunities listed on platform') }}</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-person-hearts fs-4"></i>
                            </div>
                            <h2 class="fw-black text-dark mb-0 fs-1">{{ $mentorsCount }}</h2>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">{{ __('Expert Mentors') }}</h5>
                        <p class="text-muted small mb-0">{{ __('Guiding the next generation') }}</p>
                    </div>
                </div>
            </div>

            {{-- Admin Quick Actions --}}
            <div class="row g-4 mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                <div class="col-12">
                    <h4 class="fw-bolder text-dark mb-4"><i class="bi bi-lightning-fill text-warning me-2"></i>{{ __('Quick Actions') }}</h4>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('jobs.create') }}" class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white text-decoration-none text-center">
                        <i class="bi bi-plus-circle text-primary fs-1 mb-3"></i>
                        <h6 class="fw-bold text-dark mb-0">{{ __('Add New Job') }}</h6>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('trainings.create') }}" class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white text-decoration-none text-center">
                        <i class="bi bi-mortarboard text-success fs-1 mb-3"></i>
                        <h6 class="fw-bold text-dark mb-0">{{ __('Add Training') }}</h6>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('users.index') }}" class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white text-decoration-none text-center">
                        <i class="bi bi-people text-info fs-1 mb-3"></i>
                        <h6 class="fw-bold text-dark mb-0">{{ __('Manage Users') }}</h6>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('career_paths.index') }}" class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white text-decoration-none text-center">
                        <i class="bi bi-signpost-split text-danger fs-1 mb-3"></i>
                        <h6 class="fw-bold text-dark mb-0">{{ __('Career Paths') }}</h6>
                    </a>
                </div>
            </div>

        @elseif(auth()->user()->role === 'mentor')
            {{-- MENTOR FRONT --}}
            <div class="hero-section text-white rounded-5 p-5 mb-5 position-relative overflow-hidden shadow-lg animate__animated animate__fadeIn"
                style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                <div class="position-absolute top-0 end-0 p-4 opacity-10 pointer-events-none"
                    style="transform: scale(2) translate(10%, -10%);">
                    <i class="bi bi-stars" style="font-size: 15rem;"></i>
                </div>
                <div class="position-relative z-1 max-w-2xl">
                    <span
                        class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3 fw-bold border border-white border-opacity-25 text-uppercase tracking-wider shadow-sm">
                        <i class="bi bi-award-fill me-1"></i> {{ __('Mentor Hub') }}
                    </span>
                    <h1 class="display-4 fw-black mb-3" style="letter-spacing: -1px;">
                        {{ __('Shape the Future') }}, <span class="text-warning">{{ auth()->user()->name }}</span>
                    </h1>
                    <p class="lead text-white-50 mb-4 fw-medium">
                        {{ __('Your guidance makes a difference. Post new job opportunities, create training programs, and mentor students directly from here.') }}
                    </p>
                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <a href="{{ route('jobs.create') }}"
                            class="btn btn-warning text-dark rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift d-flex align-items-center gap-2">
                            <i class="bi bi-briefcase-fill"></i> {{ __('Post a Job') }}
                        </a>
                        <a href="{{ route('home') }}"
                            class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift d-flex align-items-center gap-2">
                            <i class="bi bi-grid-fill"></i> {{ __('My Dashboard') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-8">
                    <h4 class="fw-bolder text-dark mb-4">{{ __('Quick Impact') }}</h4>
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                            <div
                                class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white border-start border-4 border-warning">
                                <h2 class="fw-black text-dark mb-2 fs-1">{{ $menteesCount }}</h2>
                                <h5 class="fw-bold text-dark mb-1">{{ __('Active Mentees') }}</h5>
                                <p class="text-muted small mb-0">{{ __('Students under your guidance') }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                            <div
                                class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all p-4 bg-white border-start border-4 border-primary">
                                <h2 class="fw-black text-dark mb-2 fs-1">{{ $activeJobsCount }}</h2>
                                <h5 class="fw-bold text-dark mb-1">{{ __('Active Positions') }}</h5>
                                <p class="text-muted small mb-0">{{ __('Jobs you have posted') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Mentor Resources/Tips --}}
                    <div class="card border-0 shadow-sm rounded-4 bg-primary bg-opacity-10 p-4 border border-primary border-opacity-25 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-lightbulb-fill me-2"></i>{{ __('Mentor Tips') }}</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex align-items-start"><i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i> <span>{{ __('Check your messages daily to stay connected with mentees') }}.</span></li>
                            <li class="mb-2 d-flex align-items-start"><i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i> <span>{{ __('Keep your job postings detailed and requirements clear') }}.</span></li>
                            <li class="d-flex align-items-start"><i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i> <span>{{ __('Provide constructive feedback on rejected applications') }}.</span></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <h4 class="fw-bolder text-dark mb-4">{{ __('Recent Applications') }}</h4>
                    <div class="card border-0 shadow-sm rounded-4 bg-white p-2">
                        @forelse($recentApplications as $app)
                            <a href="{{ route('job_applications.show', $app) }}"
                                class="text-decoration-none dropdown-item rounded-3 p-3 {{ !$loop->last ? 'border-bottom border-light' : '' }} hover-lift transition-all d-block">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary fw-bold rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($app->user->name, 0, 1)) }}
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mb-0 fw-bold text-dark text-truncate">{{ $app->user->name }}</h6>
                                        <small class="text-muted text-truncate d-block">{{ $app->job->title }}</small>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-medium">{{ __('No pending applications') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        @else
            {{-- USER FRONT --}}
            <div class="hero-section text-white rounded-5 p-5 mb-5 position-relative overflow-hidden shadow-lg animate__animated animate__fadeIn"
                style="background: linear-gradient(135deg, #0f172a 0%, #334155 100%);">
                <div class="position-absolute top-0 end-0 p-4 opacity-10 pointer-events-none"
                    style="transform: scale(2) translate(10%, -10%);">
                    <i class="bi bi-rocket-takeoff-fill" style="font-size: 15rem;"></i>
                </div>
                <div class="position-relative z-1 max-w-2xl">
                    <span
                        class="badge bg-success bg-opacity-25 text-success rounded-pill px-3 py-2 mb-3 fw-bold border border-success border-opacity-25 text-uppercase tracking-wider">
                        <i class="bi bi-compass-fill me-1"></i> {{ __('Discover Opportunities') }}
                    </span>
                    <h1 class="display-4 fw-black mb-3" style="letter-spacing: -1px;">
                        {{ __('Launch Your Career') }}, <span class="text-success">{{ auth()->user()->name }}</span>
                    </h1>
                    <p class="lead text-white-50 mb-4 fw-medium" style="max-width: 600px;">
                        {{ __('Connect with expert mentors, enroll in specialized trainings, and discover top job opportunities handpicked for graduates.') }}
                    </p>
                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <a href="{{ route('jobs.index') }}"
                            class="btn btn-success rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift d-flex align-items-center gap-2 text-white">
                            <i class="bi bi-search"></i> {{ __('Find a Job') }}
                        </a>
                        <a href="{{ route('mentors.index') }}"
                            class="btn btn-light rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift d-flex align-items-center gap-2">
                            <i class="bi bi-people-fill"></i> {{ __('Find a Mentor') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-12 mb-2 animate__animated animate__fadeInUp">
                    <h4 class="fw-bolder text-dark text-center mb-4">{{ __('How It Works') }}</h4>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-white rounded-4 shadow-sm h-100 hover-lift transition-all">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-person-badge fs-3"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ __('1. Build Your Profile') }}</h5>
                                <p class="text-muted small mb-0">{{ __('Update your skills, faculty, and LinkedIn to stand out') }}.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-white rounded-4 shadow-sm h-100 hover-lift transition-all border-bottom border-4 border-success">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-search fs-3"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ __('2. Discover & Apply') }}</h5>
                                <p class="text-muted small mb-0">{{ __('Browse curated jobs and trainings that match your path') }}.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-white rounded-4 shadow-sm h-100 hover-lift transition-all">
                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-chat-dots fs-3"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ __('3. Connect with Mentors') }}</h5>
                                <p class="text-muted small mb-0">{{ __('Get guidance from experts who have been in your shoes') }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-8 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="fw-bolder text-dark mb-0">
                            <i class="bi bi-briefcase-fill text-primary me-2"></i> {{ __('Featured Jobs') }}
                        </h4>
                        <a href="{{ route('jobs.index') }}"
                            class="btn btn-link text-decoration-none fw-bold p-0 d-flex align-items-center gap-1">
                            {{ __('View All') }} <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="row g-4">
                        @forelse($featuredJobs as $job)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all bg-white bg-opacity-75"
                                    style="backdrop-filter: blur(10px);">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="custom-avatar rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold shadow-sm"
                                                style="width:50px; height:50px; font-size: 1.25rem;">
                                                {{ strtoupper(substr($job->company, 0, 1)) }}
                                            </div>
                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 fw-bold">{{ $job->type ?? 'Full-time' }}</span>
                                        </div>
                                        <h5 class="card-title fw-bold text-dark mb-1">{{ $job->title }}</h5>
                                        <p class="text-muted small fw-medium mb-3"><i
                                                class="bi bi-building me-1"></i>{{ $job->company }}</p>
                                        <div class="mt-auto pt-3 border-top border-light">
                                            <a href="{{ route('jobs.show', $job->id) }}"
                                                class="btn btn-primary rounded-pill w-100 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-1 hover-scale">
                                                {{ __('View Details') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="bg-light rounded-4 p-5 text-center border border-dashed">
                                    <i class="bi bi-briefcase text-muted fs-1 mb-3"></i>
                                    <h6 class="text-dark fw-bold">{{ __('No Featured Jobs Yet') }}</h6>
                                    <p class="text-muted small mb-0">{{ __('Check back later for new opportunities.') }}</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="fw-bolder text-dark mb-0">
                            <i class="bi bi-star-fill text-warning me-2"></i> {{ __('Top Mentors') }}
                        </h4>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden p-2">
                        @forelse($topMentors as $mentor)
                            <a href="{{ route('mentors.index') }}"
                                class="text-decoration-none text-dark d-block p-3 rounded-3 hover-bg-light transition-all {{ !$loop->last ? 'border-bottom border-light' : '' }}">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=EBF4FF&color=1E40AF"
                                        class="rounded-circle shadow-sm" style="width: 48px; height: 48px;" alt="Mentor">
                                    <div>
                                        <h6 class="mb-0 fw-bold text-primary">{{ $mentor->name }}</h6>
                                        <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                            {{ $mentor->faculty->name ?? __('Expert Mentor') }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-center text-muted">
                                <i class="bi bi-people fs-3 mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-medium">{{ __('No mentors available') }}</p>
                            </div>
                        @endforelse

                        @if($topMentors->count() > 0)
                            <div class="p-2 border-top border-light mt-2">
                                <a href="{{ route('mentors.index') }}"
                                    class="btn btn-light rounded-pill w-100 fw-bold text-primary btn-sm">
                                    {{ __('Browse All Directory') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .fw-black {
            font-weight: 900;
        }

        .tracking-wider {
            letter-spacing: 0.05em;
        }

        .max-w-2xl {
            max-width: 42rem;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1) !important;
        }

        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .hover-bg-light:hover {
            background-color: #f8f9fa;
        }

        html[dir="rtl"] .me-1 {
            margin-right: 0 !important;
            margin-left: .25rem !important;
        }

        html[dir="rtl"] .me-2 {
            margin-right: 0 !important;
            margin-left: .5rem !important;
        }

        html[dir="rtl"] .me-3 {
            margin-right: 0 !important;
            margin-left: 1rem !important;
        }

        html[dir="rtl"] .ms-3 {
            margin-left: 0 !important;
            margin-right: 1rem !important;
        }

        html[dir="rtl"] .border-start {
            border-left: 0 !important;
            border-right: 4px solid !important;
            border-right-color: inherit !important;
        }
    </style>
@endsection