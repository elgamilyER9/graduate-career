@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Welcome Header -->
        <div class="row mb-4 animate__animated animate__fadeInDown">
            <div class="col-12">
                <div class="p-4 bg-white rounded-4 shadow-sm border-0 d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">{{ __('Welcome back, :name! 👋', ['name' => Auth::user()->name]) }}</h2>
                        <p class="text-muted mb-0">{{ __("Here's what's happening with your career progress today.") }}</p>
                    </div>
                    <div class="d-none d-md-block">
                        <button class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-plus-lg me-2"></i> {{ __('Find New Jobs') }}
                        </button>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-briefcase" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                </svg>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0 fw-medium">{{ __('Available Jobs') }}</h6>
                                <h3 class="fw-bold mb-0 mt-1">{{ $jobsCount }}</h3>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                    <path
                                        d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0 fw-medium">{{ __('Total Users') }}</h6>
                                <h3 class="fw-bold mb-0 mt-1">{{ $usersCount }}</h3>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-bookmark-star" viewBox="0 0 16 16">
                                    <path
                                        d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z" />
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-chat-dots" viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 5.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l2.7 2.233a.5.5 0 0 0 .7 0l2.7-2.232a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                </svg>
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

        <!-- Main Content Section -->
        <div class="row g-4">
            <!-- Recent Activities -->
            <div class="col-12 col-lg-8 animate__animated animate__fadeInLeft">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-dark">{{ __('Recent Job Applications') }}</h5>
                        <a href="#" class="btn btn-link text-primary text-decoration-none fw-semibold p-0">{{ __('View All') }}</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('COMPANY') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('POSITION') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('DATE') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('STATUS') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-3 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-2 p-2 me-3">🏢</div>
                                                <span class="fw-semibold">Google</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-0">Full Stack Engineer</td>
                                        <td class="px-4 py-3 border-0 text-muted">2 hours ago</td>
                                        <td class="px-4 py-3 border-0 text-end">
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium">{{ __('In Review') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-2 p-2 me-3">🍎</div>
                                                <span class="fw-semibold">Apple</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-0">Product Designer</td>
                                        <td class="px-4 py-3 border-0 text-muted">Yesterday</td>
                                        <td class="px-4 py-3 border-0 text-end">
                                            <span
                                                class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3 py-2 fw-medium">{{ __('Sent') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-2 p-2 me-3">💻</div>
                                                <span class="fw-semibold">Microsoft</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-0">Backend Developer</td>
                                        <td class="px-4 py-3 border-0 text-muted">3 days ago</td>
                                        <td class="px-4 py-3 border-0 text-end">
                                            <span
                                                class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2 fw-medium">{{ __('Interview') }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Features -->
            <div class="col-12 col-lg-4 animate__animated animate__fadeInRight">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 text-center">
                        <div class="avatar-container mb-3 position-relative d-inline-block">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&size=80"
                                alt="Profile" class="rounded-circle shadow-sm border border-4 border-white">
                            <span
                                class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle p-2"></span>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted small mb-3">{{ __('Software Engineering Student') }}</p>
                        <div class="progress mb-3" style="height: 6px;">
                            <div class="progress-bar rounded-pill" role="progressbar"
                                style="width: 75%; background-color: #0D6EFD;" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mb-3">
                            <span>{{ __('Profile Completion') }}</span>
                            <span class="fw-bold">75%</span>
                        </div>
                        <button class="btn btn-outline-primary btn-sm rounded-pill px-4 py-2 w-100 fw-bold">{{ __('Complete Profile') }}</button>
                    </div>
                </div>

                <div class="p-4 bg-dark rounded-4 shadow-sm border-0 text-white overflow-hidden position-relative"
                    style="background: linear-gradient(135deg, #1a1a1a 0%, #333333 100%);">
                    <div class="position-relative z-1">
                        <h5 class="fw-bold mb-2">{{ __('Upgrade to Pro') }}</h5>
                        <p class="small text-white-50 mb-3">{{ __('Get unlimited applications and premium career counseling.') }}</p>
                        <button class="btn btn-warning rounded-pill btn-sm px-4 py-2 fw-bold text-dark">{{ __('Get Started') }}
                            🚀</button>
                    </div>
                    <!-- Decorative Circle -->
                    <div class="position-absolute top-0 end-0 mt-n4 me-n4 bg-white opacity-10 rounded-circle"
                        style="width: 150px; height: 150px;"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .rounded-4 {
            border-radius: 1rem !important;
        }

        .transition-hover {
            transition: all 0.3s ease;
        }

        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .bg-primary-subtle {
            background-color: #cfe2ff !important;
        }

        .bg-success-subtle {
            background-color: #d1e7dd !important;
        }

        .bg-warning-subtle {
            background-color: #fff3cd !important;
        }

        .bg-info-subtle {
            background-color: #cff4fc !important;
        }

        /* Animation classes (requiring Animate.css) */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
    </style>
@endsection