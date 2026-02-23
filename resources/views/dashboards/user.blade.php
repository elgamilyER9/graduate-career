@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Welcome Header -->
        <div class="row mb-4 animate__animated animate__fadeInDown">
            <div class="col-12">
                <div class="p-4 bg-white rounded-4 shadow-sm border-0 d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">{{ __('My Dashboard') }} |
                            {{ __('Welcome back, :name! 👋', ['name' => Auth::user()->name]) }}</h2>
                        <p class="text-muted mb-0">{{ __("Ready to start your next career step?") }}</p>
                    </div>
                    <div class="d-none d-md-block">
                        <a href="{{ route('jobs.index') }}"
                            class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-search me-2"></i> {{ __('Find Jobs') }}
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
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 bg-success bg-opacity-10 p-3 rounded-3 text-success">
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
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 bg-warning bg-opacity-10 p-3 rounded-3 text-warning">
                                <i class="bi bi-envelope-check d-block" style="font-size: 24px;"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0 fw-medium">{{ __('Sent Requests') }}</h6>
                                <h3 class="fw-bold mb-0 mt-1">{{ count($myRequests) }}</h3>
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
                                <i class="bi bi-clock-history d-block" style="font-size: 24px;"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0 fw-medium">{{ __('Pending') }}</h6>
                                <h3 class="fw-bold mb-0 mt-1">{{ $pendingRequestsCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 p-4">
                        <h5 class="fw-bold mb-0 text-dark">{{ __('Recommended for you') }}</h5>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted">{{ __('Complete your profile to get personalized recommendations.') }}</p>
                        <div class="mt-4">
                            <div class="d-flex align-items-start mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-3 text-primary me-3">
                                    <i class="bi bi-lightning-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ __('Update your Skills') }}</h6>
                                    <p class="small text-muted mb-0">{{ __('Let employers know what you are good at.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="bg-success bg-opacity-10 p-3 rounded-3 text-success me-3">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ __('Upload your CV') }}</h6>
                                    <p class="small text-muted mb-0">
                                        {{ __('Professional CVs increase your chances by 60%.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                    <div class="avatar-container mb-3 position-relative d-inline-block">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&size=80"
                            alt="Profile" class="rounded-circle shadow-sm border border-4 border-white">
                        <span
                            class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle p-2"></span>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted small mb-3">{{ __('Graduate Student') }}</p>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar rounded-pill" role="progressbar"
                            style="width: 45%; background-color: #0D6EFD;" aria-valuenow="45" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-3">
                        <span>{{ __('Profile Completion') }}</span>
                        <span class="fw-bold">45%</span>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                        class="btn btn-outline-primary btn-sm rounded-pill px-4 py-2 w-100 fw-bold">{{ __('Complete Profile') }}</a>
                </div>
            </div>
        </div>

        <!-- Mentorship Section -->
        <div class="row g-4 mt-2">
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 animate__animated animate__fadeInUp">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="fw-bold mb-0 text-dark">{{ __('Find a Mentor') }}</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-bold mb-1">{{ __('Find your Professional Mentor') }}</h6>
                                <p class="text-muted small mb-0">{{ __('Get guidance from experienced professionals in your field.') }}</p>
                            </div>
                            <a href="{{ route('mentors.index') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                                {{ __('Browse Mentors') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate__animated animate__fadeInUp">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="fw-bold mb-0 text-dark">{{ __('My Mentorship Requests') }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('MENTOR') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('STATUS') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($myRequests as $req)
                                        <tr>
                                            <td class="px-4 py-3 border-0">
                                                <h6 class="mb-0 fw-bold">{{ $req->mentor->name }}</h6>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                @if($req->status === 'pending')
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">{{ __('Pending') }}</span>
                                                @elseif($req->status === 'approved')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">{{ __('Approved') }}</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">{{ __('Rejected') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4 text-muted small">
                                                {{ __('You haven\'t sent any requests yet.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection