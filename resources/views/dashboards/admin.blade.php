@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Welcome Header -->
        <div class="row mb-4 animate__animated animate__fadeInDown">
            <div class="col-12">
                <div class="p-4 bg-white rounded-4 shadow-sm border-0 d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">{{ __('Admin Dashboard') }} |
                            {{ __('Welcome, :name! 👋', ['name' => Auth::user()->name]) }}</h2>
                        <p class="text-muted mb-0">{{ __("System overview and management.") }}</p>
                    </div>
                    <div class="d-none d-md-block">
                        <a href="{{ route('users.create') }}"
                            class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-person-plus me-2"></i> {{ __('Add New User') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-3 text-primary">
                                <i class="bi bi-people d-block" style="font-size: 24px;"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0 fw-medium">{{ __('Total Users') }}</h6>
                                <h3 class="fw-bold mb-0 mt-1">{{ $usersCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 bg-success bg-opacity-10 p-3 rounded-3 text-success">
                                <i class="bi bi-briefcase d-block" style="font-size: 24px;"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0 fw-medium">{{ __('Available Jobs') }}</h6>
                                <h3 class="fw-bold mb-0 mt-1">{{ $jobsCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 bg-warning bg-opacity-10 p-3 rounded-3 text-warning">
                                <i class="bi bi-star d-block" style="font-size: 24px;"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0 fw-medium">{{ __('Skills Database') }}</h6>
                                <h3 class="fw-bold mb-0 mt-1">{{ $skillsCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 bg-info bg-opacity-10 p-3 rounded-3 text-info">
                                <i class="bi bi-mortarboard d-block" style="font-size: 24px;"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0 fw-medium">{{ __('Trainings') }}</h6>
                                <h3 class="fw-bold mb-0 mt-1">{{ $trainingsCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Section -->
        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <h5 class="fw-bold mb-4">{{ __('Quick Management') }}</h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('users.index') }}"
                            class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <i class="bi bi-people-fill me-2 text-primary"></i> {{ __('Manage Users') }}
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $usersCount }}</span>
                        </a>
                        <a href="{{ route('jobs.index') }}"
                            class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <i class="bi bi-briefcase-fill me-2 text-success"></i> {{ __('Manage Jobs') }}
                            </div>
                            <span class="badge bg-success rounded-pill">{{ $jobsCount }}</span>
                        </a>
                        <a href="{{ route('career_paths.index') }}"
                            class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <i class="bi bi-diagram-3-fill me-2 text-warning"></i> {{ __('Manage Career Paths') }}
                            </div>
                            <span class="badge bg-warning rounded-pill">{{ $careerPathsCount }}</span>
                        </a>
                        <a href="{{ route('universities.index') }}"
                            class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-building me-2 text-info"></i> {{ __('Manage Universities') }}
                            </div>
                            <span class="badge bg-info rounded-pill">{{ $universitiesCount }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <h5 class="fw-bold mb-4">{{ __('System Statistics') }}</h5>
                    <div class="mt-2">
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ __('Faculties') }}</span>
                            <span class="fw-bold">{{ $facultiesCount }}</span>
                        </div>
                        <div class="progress mb-4" style="height: 10px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ __('Skills') }}</span>
                            <span class="fw-bold">{{ $skillsCount }}</span>
                        </div>
                        <div class="progress mb-4" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ __('Trainings') }}</span>
                            <span class="fw-bold">{{ $trainingsCount }}</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection