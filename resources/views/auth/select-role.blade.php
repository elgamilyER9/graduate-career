@extends('layouts.app')

@section('content')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-10 col-lg-8 animate__animated animate__fadeIn">
                <h1 class="fw-bold text-dark mb-2">{{ __('How do you want to') }} <span
                        class="text-primary">{{ __('Join Us?') }}</span></h1>
                <p class="text-muted mb-5">{{ __('Select your objective to customize your experience.') }}</p>

                <div class="row g-4 justify-content-center">
                    <!-- User/Student Card -->
                    <div class="col-12 col-md-5">
                        <a href="{{ route('register', ['role' => 'user']) }}" class="text-decoration-none group">
                            <div
                                class="card border-0 shadow-sm rounded-4 p-4 h-100 transition-hover overflow-hidden position-relative">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle mb-4 mx-auto d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-person-workspace h1 mb-0"></i>
                                </div>
                                <h3 class="fw-bold text-dark">{{ __("I'm a Student") }}</h3>
                                <p class="text-muted small">
                                    {{ __('I want to find career paths, skills, and training opportunities.') }}
                                </p>
                                <div class="mt-auto">
                                    <span
                                        class="btn btn-outline-primary rounded-pill px-4 group-hover-bg">{{ __('Choose Student') }}</span>
                                </div>
                                <!-- Background decoration -->
                                <div class="position-absolute bottom-0 end-0 opacity-05" style="margin: -20px;">
                                    <i class="bi bi-person-workspace" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Mentor Card -->
                    <div class="col-12 col-md-5">
                        <a href="{{ route('register', ['role' => 'mentor']) }}" class="text-decoration-none group">
                            <div
                                class="card border-0 shadow-sm rounded-4 p-4 h-100 transition-hover overflow-hidden position-relative">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle mb-4 mx-auto d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-award h1 mb-0"></i>
                                </div>
                                <h3 class="fw-bold text-dark">{{ __("I'm a Mentor") }}</h3>
                                <p class="text-muted small">
                                    {{ __('I want to guide graduates and share my professional experience.') }}
                                </p>
                                <div class="mt-auto">
                                    <span
                                        class="btn btn-outline-success rounded-pill px-4 group-hover-bg">{{ __('Choose Mentor') }}</span>
                                </div>
                                <!-- Background decoration -->
                                <div class="position-absolute bottom-0 end-0 opacity-05" style="margin: -20px;">
                                    <i class="bi bi-award" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p class="text-muted">{{ __('Already have an account?') }}
                        <a href="{{ route('login') }}"
                            class="text-primary fw-bold text-decoration-none">{{ __('Login instead') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .transition-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .transition-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        }

        .group:hover .group-hover-bg {
            background-color: var(--bs-primary);
            color: white;
        }

        .group:hover .btn-outline-success.group-hover-bg {
            background-color: var(--bs-success);
            color: white;
        }

        .opacity-05 {
            opacity: 0.05;
        }
    </style>
@endsection