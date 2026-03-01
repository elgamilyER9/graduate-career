@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Premium Header -->
        <div class="row align-items-center mb-5 animate__animated animate__fadeIn">
            <div class="col-12 col-md-8">
                <span
                    class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3 fw-bold text-uppercase tracking-wider">
                    {{ __('Applicant Tracking') }}
                </span>
                <h2 class="fw-bolder text-dark mb-2 display-6">
                    <i class="bi bi-file-earmark-text text-primary me-2"></i>{{ __('Job Applications') }}
                </h2>
                <p class="text-muted mb-0 lead">{{ __('Manage and review applications for your job postings.') }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            </div>
        @endif

        <div class="row g-4">
            @forelse($applications as $application)
                <div class="col-xl-4 col-md-6 animate__animated animate__fadeInUp"
                    style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-scale transition-all">
                        <!-- Top Color Bar based on status -->
                        <div
                            style="height: 6px; background-color: {{ $application->status === 'approved' ? '#10b981' : ($application->status === 'rejected' ? '#ef4444' : '#f59e0b') }}">
                        </div>

                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span
                                    class="badge {{ $application->status === 'approved' ? 'bg-success-subtle text-success' : ($application->status === 'rejected' ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning') }} rounded-pill px-3 py-2 fw-bold small">
                                    <i
                                        class="bi {{ $application->status === 'approved' ? 'bi-check-circle' : ($application->status === 'rejected' ? 'bi-x-circle' : 'bi-hourglass-split') }} me-1"></i>
                                    {{ __(ucfirst($application->status)) }}
                                </span>
                                <span class="text-muted extra-small fw-medium">
                                    <i class="bi bi-clock me-1"></i>{{ $application->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <h5 class="fw-bold text-dark mb-1 text-truncate">{{ $application->user->name }}</h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-envelope me-1"></i>{{ $application->user->email }}
                            </p>

                            <div class="p-3 bg-light rounded-3 mb-4">
                                <p class="small text-muted mb-1 text-uppercase fw-bold" style="font-size: 0.65rem;">
                                    {{ __('Applying For') }}</p>
                                <p class="fw-bold text-dark mb-0 text-truncate">{{ $application->job->title }}</p>
                                <p class="text-muted small mb-0"><i
                                        class="bi bi-building me-1"></i>{{ $application->job->company }}</p>
                            </div>

                            <div class="d-grid gap-2 mt-auto">
                                <a href="{{ route('job_applications.show', $application) }}"
                                    class="btn btn-primary rounded-pill py-2 fw-bold">
                                    {{ __('Review Application') }} <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-inbox text-muted opacity-25" style="font-size: 5rem;"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">{{ __('No Job Applications') }}</h4>
                        <p class="text-muted mx-auto" style="max-width: 400px;">
                            {{ __('There are currently no job applications to review.') }}
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .transition-all {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .extra-small {
            font-size: 0.75rem;
        }

        .tracking-wider {
            letter-spacing: 0.05em;
        }

        .bg-success-subtle {
            background-color: #d1fae5 !important;
        }

        .bg-danger-subtle {
            background-color: #fee2e2 !important;
        }

        .bg-warning-subtle {
            background-color: #fef3c7 !important;
        }

        .text-success {
            color: #059669 !important;
        }

        .text-danger {
            color: #dc2626 !important;
        }

        .text-warning {
            color: #d97706 !important;
        }
    </style>
@endsection