@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">

        @if(auth()->user()->role === 'admin')
            {{-- ADVANCED ADMIN FRONT --}}
            <div
                class="advanced-glass-card rounded-5 border-0 shadow-2xl p-5 mb-5 position-relative overflow-hidden animate__animated animate__fadeIn">
                <!-- Animated Background Blobs -->
                <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden pointer-events-none opacity-50">
                    <div class="position-absolute rounded-circle blur-3xl pulse-slow"
                        style="width: 300px; height: 300px; background: rgba(79,70,229,0.15); top: -100px; right: -50px;"></div>
                    <div class="position-absolute rounded-circle blur-3xl pulse-slow"
                        style="width: 250px; height: 250px; background: rgba(245,158,11,0.1); bottom: -50px; left: -50px; animation-delay: 2s;">
                    </div>
                </div>

                <div class="card-body p-4 position-relative z-1">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <span
                                class="badge bg-indigo-950 text-warning rounded-pill px-4 py-2 mb-3 fw-black small-caps tracking-widest shadow-sm">
                                <i class="bi bi-shield-lock-fill me-2"></i> {{ __('GLOBAL COMMAND CENTER') }}
                            </span>
                            <h1 class="display-3 fw-black mb-3 text-dark" style="letter-spacing: -2px;">
                                {{ __('Systems') }} <span class="text-indigo-600">{{ __('Online') }}</span>
                            </h1>
                            <p class="lead text-muted mb-4 fw-bold opacity-75">
                                {{ __('Welcome back, Commander') }} <strong
                                    class="text-dark">{{ auth()->user()->name }}</strong>.
                                {{ __('Your ecosystem is performing at optimal levels. Manage infrastructure and user growth below.') }}
                            </p>
                            <div class="d-flex gap-3">
                                <a href="{{ route('home') }}"
                                    class="btn btn-indigo-gold rounded-pill px-5 py-3 fw-black shadow-lg hover-lift">
                                    <i class="bi bi-cpu-fill me-2"></i> {{ __('OPEN TERMINAL') }}
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 d-none d-lg-block text-center mt-5 mt-lg-0">
                            <div class="position-relative d-inline-block">
                                <div
                                    class="position-absolute top-50 start-50 translate-middle w-100 h-100 bg-indigo-500 rounded-circle opacity-10 blur-3xl">
                                </div>
                                <i class="bi bi-gear-wide-connected text-indigo-950 display-1 floating-icon opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div
                        class="advanced-glass-card group hover-glow p-4 transition-all h-100 position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="stat-icon-box p-3 bg-soft-primary rounded-4 text-indigo-600 shadow-sm">
                                <i class="bi bi-people-fill fs-3"></i>
                            </div>
                            <div class="text-end">
                                <h2 class="fw-black text-dark mb-0 fs-1 tracking-tighter">{{ $usersCount }}</h2>
                                <span class="badge bg-soft-success text-success fw-black small-caps">+12%
                                    {{ __('GROWTH') }}</span>
                            </div>
                        </div>
                        <h5 class="fw-black text-dark text-uppercase tracking-wider mb-1">{{ __('Total Users') }}</h5>
                        <p class="text-muted small fw-bold mb-0 opacity-75">{{ __('Global student & alumni base') }}</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                    <div
                        class="advanced-glass-card group hover-glow p-4 transition-all h-100 position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="stat-icon-box p-3 bg-soft-warning rounded-4 text-warning shadow-sm">
                                <i class="bi bi-briefcase-fill fs-3"></i>
                            </div>
                            <div class="text-end">
                                <h2 class="fw-black text-dark mb-0 fs-1 tracking-tighter">{{ $jobsCount }}</h2>
                                <span class="badge bg-soft-warning text-warning fw-black small-caps">{{ __('ACTIVE') }}</span>
                            </div>
                        </div>
                        <h5 class="fw-black text-dark text-uppercase tracking-wider mb-1">{{ __('Job Pulse') }}</h5>
                        <p class="text-muted small fw-bold mb-0 opacity-75">{{ __('Market opportunities active') }}</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                    <div
                        class="advanced-glass-card group hover-glow p-4 transition-all h-100 position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="stat-icon-box p-3 bg-soft-indigo rounded-4 text-indigo-950 shadow-sm"
                                style="background: rgba(30,27,75,0.08);">
                                <i class="bi bi-mortarboard-fill fs-3"></i>
                            </div>
                            <div class="text-end">
                                <h2 class="fw-black text-dark mb-0 fs-1 tracking-tighter">{{ $mentorsCount }}</h2>
                                <span class="badge bg-indigo-950 text-white fw-black small-caps">{{ __('ELITE') }}</span>
                            </div>
                        </div>
                        <h5 class="fw-black text-dark text-uppercase tracking-wider mb-1">{{ __('Mentorship') }}</h5>
                        <p class="text-muted small fw-bold mb-0 opacity-75">{{ __('Expert guides onboarded') }}</p>
                    </div>
                </div>
            </div>

            {{-- Admin Quick Actions --}}
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <h5 class="fw-black text-dark mb-4 text-uppercase tracking-widest d-flex align-items-center gap-2">
                        <span class="p-1 bg-warning rounded-pill"></span> {{ __('Action Terminal') }}
                    </h5>
                </div>
                @php
                    $actions = [
                        ['route' => 'jobs.create', 'icon' => 'bi-plus-circle', 'title' => 'Post Job', 'color' => 'indigo', 'bg' => 'bg-soft-primary'],
                        ['route' => 'trainings.create', 'icon' => 'bi-lightning-fill', 'title' => 'New Training', 'color' => 'warning', 'bg' => 'bg-soft-warning'],
                        ['route' => 'users.index', 'icon' => 'bi-shield-shaded', 'title' => 'IAM Control', 'color' => 'success', 'bg' => 'bg-soft-success'],
                        ['route' => 'career_paths.index', 'icon' => 'bi-diagram-3-fill', 'title' => 'System Flow', 'color' => 'info', 'bg' => 'bg-soft-info'],
                    ];
                @endphp
                @foreach($actions as $action)
                    <div class="col-md-3 animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <a href="{{ route($action['route']) }}"
                            class="advanced-glass-card d-block p-4 text-center text-decoration-none group hover-lift border-0 shadow-lg">
                            <div class="flex-shrink-0 mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle {{ $action['bg'] }} transition-all group-hover:scale-110"
                                style="width: 65px; height: 65px;">
                                <i class="bi {{ $action['icon'] }} fs-2 text-{{ $action['color'] }}"></i>
                            </div>
                            <h6 class="fw-black text-dark mb-0 text-uppercase tracking-wide">{{ __($action['title']) }}</h6>
                        </a>
                    </div>
                @endforeach
            </div>

        @elseif(auth()->user()->role === 'mentor')
            {{-- ADVANCED MENTOR FRONT --}}
            <div
                class="advanced-glass-card rounded-5 border-0 shadow-2xl p-5 mb-5 position-relative overflow-hidden animate__animated animate__fadeIn">
                <div class="position-absolute top-0 end-0 w-100 h-100 overflow-hidden pointer-events-none opacity-50">
                    <div class="position-absolute rounded-circle blur-3xl pulse-slow"
                        style="width: 350px; height: 350px; background: radial-gradient(circle, rgba(245,158,11,0.15) 0%, transparent 70%); top: -150px; right: -100px;">
                    </div>
                </div>

                <div class="card-body p-4 position-relative z-1">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <span
                                class="badge bg-indigo-950 text-warning rounded-pill px-4 py-2 mb-3 fw-black small-caps tracking-widest shadow-sm">
                                <i class="bi bi-stars me-2"></i> {{ __('EXPERT MENTOR HUB') }}
                            </span>
                            <h1 class="display-3 fw-black mb-3 text-dark" style="letter-spacing: -2px;">
                                {{ __('Shape the') }} <span class="text-warning">{{ __('Next Edge') }}</span>
                            </h1>
                            <p class="lead text-muted mb-4 fw-bold opacity-75">
                                {{ __('Your wisdom is the blueprint for future success') }}. <strong
                                    class="text-dark">{{ auth()->user()->name }}</strong>,
                                {{ __('ready to review new candidates and launch specialized training programs?') }}
                            </p>
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="{{ route('jobs.create') }}"
                                    class="btn btn-warning rounded-pill px-5 py-3 fw-black text-dark shadow-lg hover-lift">
                                    <i class="bi bi-rocket-takeoff-fill me-2"></i> {{ __('POST NEW OPPORTUNITY') }}
                                </a>
                                <a href="{{ route('home') }}"
                                    class="btn btn-indigo-gold rounded-pill px-5 py-3 fw-black shadow-lg hover-lift">
                                    <i class="bi bi-command me-2"></i> {{ __('COMMAND CENTER') }}
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 d-none d-lg-block text-center">
                            <i class="bi bi-mortarboard text-indigo-950 display-1 floating-icon opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-8">
                    <h5 class="fw-black text-dark mb-4 text-uppercase tracking-widest d-flex align-items-center gap-2">
                        <span class="p-1 bg-indigo-600 rounded-pill"></span> {{ __('Real-time Impact') }}
                    </h5>
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6 animate__animated animate__fadeInUp">
                            <div
                                class="advanced-glass-card group hover-glow p-4 transition-all h-100 position-relative overflow-hidden border-start border-4 border-warning">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h2 class="fw-black text-dark mb-0 fs-1 tracking-tighter">{{ $menteesCount }}</h2>
                                    <div class="stat-icon-box p-3 bg-soft-warning rounded-4 text-warning shadow-sm">
                                        <i class="bi bi-people-fill fs-4"></i>
                                    </div>
                                </div>
                                <h6 class="fw-black text-dark text-uppercase tracking-wider mb-1">{{ __('Approved Mentees') }}
                                </h6>
                                <p class="text-muted small fw-bold mb-0 opacity-75">{{ __('Students following your path') }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                            <div
                                class="advanced-glass-card group hover-glow p-4 transition-all h-100 position-relative overflow-hidden border-start border-4 border-indigo-600">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h2 class="fw-black text-dark mb-0 fs-1 tracking-tighter">{{ $activeJobsCount }}</h2>
                                    <div class="stat-icon-box p-3 bg-soft-primary rounded-4 text-indigo-600 shadow-sm">
                                        <i class="bi bi-briefcase-fill fs-4"></i>
                                    </div>
                                </div>
                                <h6 class="fw-black text-dark text-uppercase tracking-wider mb-1">{{ __('Market Reach') }}</h6>
                                <p class="text-muted small fw-bold mb-0 opacity-75">{{ __('Jobs you have pioneered') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Pro Tip Card --}}
                    <div class="advanced-glass-card p-4 bg-indigo-950 border-0 shadow-2xl animate__animated animate__fadeInUp"
                        style="animation-delay: 0.2s">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="p-2 bg-soft-warning rounded-3"><i class="bi bi-lightning-charge-fill text-warning"></i>
                            </div>
                            <h6 class="fw-black text-white mb-0 text-uppercase tracking-widest">{{ __('MENTAL PERFORMANCE') }}
                            </h6>
                        </div>
                        <ul class="list-unstyled mb-0 vstack gap-3">
                            <li class="d-flex align-items-start gap-3">
                                <i class="bi bi-patch-check-fill text-warning mt-1"></i>
                                <span class="text-white-50 small fw-bold"><strong
                                        class="text-white">{{ __('Speed Matters:') }}</strong>
                                    {{ __('Responding to mentees within 24h increases engagement by 60%.') }}</span>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <i class="bi bi-patch-check-fill text-warning mt-1"></i>
                                <span class="text-white-50 small fw-bold"><strong
                                        class="text-white">{{ __('Quality Feedback:') }}</strong>
                                    {{ __('Constructive rejection notes help build a stronger talent pipeline.') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 animate__animated animate__fadeInRight" style="animation-delay: 0.1s">
                    <h5 class="fw-black text-dark mb-4 text-uppercase tracking-widest d-flex align-items-center gap-2">
                        <span class="p-1 bg-warning rounded-pill"></span> {{ __('Inbox Pulse') }}
                    </h5>
                    <div class="advanced-glass-card shadow-lg overflow-hidden border-0"
                        style="background: rgba(255,255,255,0.6);">
                        <div class="list-group list-group-flush">
                            @forelse($recentApplications as $app)
                                <a href="{{ route('job_applications.show', $app) }}"
                                    class="list-group-item list-group-item-action bg-transparent border-0 p-3 hover-bg-white transition-all">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="position-relative">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($app->user->name) }}&background=1e1b4b&color=fff&size=50&bold=true"
                                                class="rounded-circle shadow-sm border border-2 border-white" width="45"
                                                height="45">
                                            <div class="position-absolute bottom-0 end-0 bg-warning rounded-circle pulse-warning"
                                                style="width:12px; height:12px; border: 2px solid white"></div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h6 class="mb-0 fw-black text-dark text-truncate">{{ $app->user->name }}</h6>
                                            <small class="text-muted fw-bold text-uppercase d-block text-truncate"
                                                style="font-size: 0.65rem;">{{ $app->job->title }}</small>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted opacity-25"></i>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-clipboard-x text-muted display-4 opacity-25 d-block mb-3"></i>
                                    <p class="text-muted small-caps fw-black mb-0">{{ __('No New Signals') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        @else
            {{-- ADVANCED USER FRONT --}}
            <div
                class="advanced-glass-card rounded-5 border-0 shadow-2xl p-5 mb-5 position-relative overflow-hidden animate__animated animate__fadeIn">
                <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden pointer-events-none opacity-50">
                    <div class="position-absolute rounded-circle blur-3xl pulse-slow"
                        style="width: 400px; height: 400px; background: radial-gradient(circle, rgba(16,185,129,0.12) 0%, transparent 70%); top: -150px; left: -100px;">
                    </div>
                </div>

                <div class="card-body p-4 position-relative z-1">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <span
                                class="badge bg-indigo-950 text-success rounded-pill px-4 py-2 mb-3 fw-black small-caps tracking-widest shadow-sm">
                                <i class="bi bi-rocket-takeoff-fill me-2"></i> {{ __('ELEVATE YOUR CAREER') }}
                            </span>
                            <h1 class="display-3 fw-black mb-3 text-dark" style="letter-spacing: -2px;">
                                {{ __('Reach New') }} <span class="text-success">{{ __('Milestones') }}</span>
                            </h1>
                            <p class="lead text-muted mb-4 fw-bold opacity-75">
                                {{ __('Launch your professional journey with precision') }}. <strong
                                    class="text-dark">{{ auth()->user()->name }}</strong>,
                                {{ __('access top-tier jobs, premium certifications, and elite mentorship.') }}
                            </p>
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="{{ route('jobs.index') }}"
                                    class="btn btn-indigo-gold rounded-pill px-5 py-3 fw-black shadow-lg hover-lift">
                                    <i class="bi bi-briefcase-fill me-2"></i> {{ __('FIND OPPORTUNITIES') }}
                                </a>
                                <a href="{{ route('mentors.index') }}"
                                    class="btn btn-outline-white-glass rounded-pill px-5 py-3 fw-black shadow-lg hover-lift text-dark border-indigo-200">
                                    <i class="bi bi-person-bounding-box me-2"></i> {{ __('TOP MENTORS') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <h5
                            class="fw-black text-dark text-center mb-5 text-uppercase tracking-widest border-bottom pb-4 border-light">
                            <span class="bg-soft-primary px-4 py-2 rounded-pill"><i
                                    class="bi bi-gear-wide-connected text-indigo-600 me-2"></i>{{ __('The Excellence Framework') }}</span>
                        </h5>
                        <div class="row g-4">
                            @php
                                $steps = [
                                    ['icon' => 'bi-person-badge', 'color' => 'indigo-600', 'title' => 'Digital Identity', 'desc' => 'Optimizing your skills profile for maximum market visibility.', 'delay' => '0.1s'],
                                    ['icon' => 'bi-intersect', 'color' => 'success', 'title' => 'Matching Engine', 'desc' => 'Discovering curated opportunities that align with your DNA.', 'delay' => '0.2s'],
                                    ['icon' => 'bi-bezier2', 'color' => 'warning', 'title' => 'Mentor Bridge', 'desc' => 'Direct access to elite experts who have mastered your path.', 'delay' => '0.3s']
                                ];
                            @endphp
                            @foreach($steps as $step)
                                <div class="col-md-4 animate__animated animate__fadeInUp"
                                    style="animation-delay: {{ $step['delay'] }}">
                                    <div
                                        class="advanced-glass-card p-4 text-center h-100 group transition-all hover-translate-y-n2 border-0 shadow-lg">
                                        <div class="position-relative d-inline-block mb-4">
                                            <div
                                                class="position-absolute top-50 start-50 translate-middle w-100 h-100 bg-{{ explode('-', $step['color'])[0] }} opacity-10 blur-2xl group-hover:opacity-20 transition-all">
                                            </div>
                                            <div class="bg-soft-primary text-{{ $step['color'] }} rounded-circle d-flex align-items-center justify-content-center shadow-md position-relative"
                                                style="width: 80px; height: 80px;">
                                                <i class="bi {{ $step['icon'] }} fs-1"></i>
                                                <div class="position-absolute top-0 end-0 bg-indigo-950 text-white rounded-circle fw-black d-flex align-items-center justify-content-center border border-white"
                                                    style="width: 25px; height: 25px; font-size: 0.7rem; margin: -5px;">
                                                    {{ $loop->iteration }}</div>
                                            </div>
                                        </div>
                                        <h5 class="fw-black text-dark mb-2">{{ __($step['title']) }}</h5>
                                        <p class="text-muted small fw-bold opacity-75 px-2">{{ __($step['desc']) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom border-light pb-3">
                            <h5 class="fw-black text-dark mb-0 text-uppercase tracking-widest">
                                <i class="bi bi-briefcase-fill text-indigo-600 me-2"></i> {{ __('Market Pulse') }}
                            </h5>
                            <a href="{{ route('jobs.index') }}"
                                class="btn btn-link text-indigo-600 fw-black small-caps text-decoration-none hover-translate-x-2 transition-all p-0">
                                {{ __('ALL OPPORTUNITIES') }} <i class="bi bi-arrow-right-short fs-4"></i>
                            </a>
                        </div>
                        <div class="row g-4">
                            @forelse($featuredJobs as $job)
                                <div class="col-md-6">
                                    <div
                                        class="advanced-glass-card p-4 h-100 group hover-glow transition-all position-relative border-0 shadow-lg overflow-hidden">
                                        <div class="d-flex justify-content-between align-items-start mb-4 position-relative z-1">
                                            <div class="bg-indigo-950 text-white rounded-4 shadow-lg d-flex align-items-center justify-content-center fw-black"
                                                style="width: 55px; height: 55px; font-size: 1.2rem;">
                                                {{ strtoupper(substr($job->company, 0, 1)) }}
                                            </div>
                                            <span
                                                class="badge bg-soft-primary text-indigo-600 rounded-pill px-3 py-2 fw-black small-caps shadow-sm">{{ $job->type ?? 'FULL-TIME' }}</span>
                                        </div>
                                        <h5 class="fw-black text-dark mb-2 position-relative z-1">{{ $job->title }}</h5>
                                        <div class="vstack gap-2 mb-4 position-relative z-1">
                                            <div class="d-flex align-items-center gap-2 text-muted small fw-bold"><i
                                                    class="bi bi-building-fill text-indigo-600"></i> {{ $job->company }}</div>
                                            <div class="d-flex align-items-center gap-2 text-muted small fw-bold"><i
                                                    class="bi bi-geo-alt-fill text-error"></i>
                                                {{ $job->location ?? 'Global / Remote' }}</div>
                                        </div>
                                        <a href="{{ route('jobs.show', $job->id) }}"
                                            class="btn btn-soft-primary rounded-pill w-100 fw-black py-2 shadow-sm position-relative z-1 hover-lift">
                                            {{ __('REVIEW POSITION') }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="advanced-glass-card p-5 text-center border-dashed border-2 opacity-50">
                                        <i class="bi bi-briefcase text-muted display-4 d-block mb-3"></i>
                                        <p class="text-muted small-caps fw-black mb-0">{{ __('Scanning for New Targets') }}</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom border-light pb-3">
                            <h5 class="fw-black text-dark mb-0 text-uppercase tracking-widest">
                                <i class="bi bi-shield-check text-warning me-2"></i> {{ __('Expert Node') }}
                            </h5>
                        </div>
                        <div class="advanced-glass-card shadow-lg p-3 border-0" style="background: rgba(255,255,255,0.6);">
                            @forelse($topMentors as $mentor)
                                <a href="{{ route('mentors.index') }}" class="d-block text-decoration-none group mb-2">
                                    <div
                                        class="p-3 rounded-4 transition-all group-hover:bg-white group-hover:shadow-md border border-transparent group-hover:border-indigo-100">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=1e1b4b&color=fff&size=55&bold=true"
                                                    class="rounded-circle shadow-md border-2 border-white"
                                                    style="width: 50px; height: 50px;">
                                                <div class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle"
                                                    style="width: 14px; height: 14px;"></div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h6 class="mb-0 fw-black text-dark text-truncate">{{ $mentor->name }}</h6>
                                                <small class="text-muted fw-bold d-block text-truncate small-caps"
                                                    style="font-size: 0.65rem;">
                                                    <i class="bi bi-mortarboard-fill text-warning me-1"></i>
                                                    {{ $mentor->faculty->name ?? __('Expert Guide') }}
                                                </small>
                                            </div>
                                            <i
                                                class="bi bi-chevron-right text-muted opacity-25 group-hover:opacity-100 transition-all"></i>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-5 text-center opacity-50">
                                    <i class="bi bi-people text-muted display-4 d-block mb-3"></i>
                                    <p class="text-muted small-caps fw-black mb-0">{{ __('No Guides Online') }}</p>
                                </div>
                            @endforelse

                            @if($topMentors->count() > 0)
                                <div class="p-2 border-top border-light mt-2">
                                    <a href="{{ route('mentors.index') }}"
                                        class="btn btn-indigo-gold btn-sm rounded-pill w-100 fw-black py-2">
                                        {{ __('VIEW ALL EXPERTS') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        @endif
        </div>

        <style>
            :root {
                --glass-bg: rgba(255, 255, 255, 0.7);
                --glass-border: rgba(255, 255, 255, 0.4);
                --indigo-950: #1e1b4b;
                --gold-accent: #f59e0b;
                --error-red: #ef4444;
            }

            .advanced-glass-card {
                background: var(--glass-bg);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                border: 1px solid var(--glass-border);
                border-radius: 2.5rem;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .hover-glow:hover {
                box-shadow: 0 0 50px rgba(79, 70, 229, 0.15);
                border-color: rgba(79, 70, 229, 0.4);
                transform: translateY(-8px);
            }

            .bg-indigo-950 {
                background-color: var(--indigo-950) !important;
            }

            .text-warning {
                color: var(--gold-accent) !important;
            }

            .text-error {
                color: var(--error-red) !important;
            }

            .btn-indigo-gold {
                background: var(--indigo-950);
                color: var(--gold-accent);
                border: 1px solid var(--gold-accent);
                transition: all 0.3s ease;
            }

            .btn-indigo-gold:hover {
                background: var(--gold-accent);
                color: var(--indigo-950);
                box-shadow: 0 15px 30px rgba(245, 158, 11, 0.3);
                transform: translateY(-3px);
            }

            .btn-outline-white-glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                transition: all 0.3s ease;
            }

            .btn-outline-white-glass:hover {
                background: rgba(255, 255, 255, 0.25);
                border-color: rgba(255, 255, 255, 0.5);
                transform: translateY(-3px);
            }

            .floating-icon {
                animation: floating 4s ease-in-out infinite;
            }

            @keyframes floating {

                0%,
                100% {
                    transform: translateY(0) rotate(0);
                }

                50% {
                    transform: translateY(-25px) rotate(5deg);
                }
            }

            .pulse-slow {
                animation: pulse-slow 10s infinite ease-in-out;
            }

            @keyframes pulse-slow {

                0%,
                100% {
                    transform: scale(1);
                    opacity: 0.4;
                }

                50% {
                    transform: scale(1.3);
                    opacity: 0.7;
                }
            }

            .fw-black {
                font-weight: 900;
            }

            .small-caps {
                font-variant: small-caps;
            }

            .tracking-widest {
                letter-spacing: 0.25em;
            }

            .tracking-tighter {
                letter-spacing: -0.05em;
            }

            .bg-soft-primary {
                background: rgba(79, 70, 229, 0.08);
            }

            .bg-soft-warning {
                background: rgba(245, 158, 11, 0.08);
            }

            .bg-soft-success {
                background: rgba(16, 185, 129, 0.08);
            }

            .hover-lift:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12) !important;
            }

            .hover-translate-y-n2:hover {
                transform: translateY(-0.5rem);
            }

            .hover-translate-x-2:hover {
                transform: translateX(0.5rem);
            }

            .blur-2xl {
                filter: blur(40px);
            }

            .blur-3xl {
                filter: blur(60px);
            }

            .group:hover .group-hover\:opacity-20 {
                opacity: 0.2 !important;
            }

            @media (max-width: 768px) {
                .display-3 {
                    font-size: 2.5rem;
                }

                .advanced-glass-card {
                    border-radius: 1.5rem;
                    padding: 2rem !important;
                }
            }

            /* RTL Specifics */
            html[dir="rtl"] .tracking-widest {
                letter-spacing: normal;
            }

            html[dir="rtl"] .hover-translate-x-2:hover {
                transform: translateX(-0.5rem);
            }
        </style>
@endsection