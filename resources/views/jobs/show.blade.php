@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Header with back button -->
        <div class="d-flex align-items-center justify-content-between mb-5">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('jobs.index') }}"
                    class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 44px; height: 44px;" title="{{ __('Back') }}">
                    <i class="bi bi-arrow-left fs-5"></i>
                </a>
                <div>
                    <h2 class="fw-bold text-dark mb-1">{{ $job->title }}</h2>
                    <p class="text-muted mb-0">{{ __('Job Details') }}</p>
                </div>
            </div>
            @if(auth()->user()->role === 'admin')
                <div class="d-flex gap-2">
                    <a href="{{ route('jobs.edit', $job) }}" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm">
                        <i class="bi bi-pencil me-2"></i> {{ __('Edit') }}
                    </a>
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST"
                        onsubmit="return confirm('{{ __('Are you sure?') }}');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger rounded-3 px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-trash me-2"></i> {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Job Card -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-light border-0 py-4 px-4">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="bi bi-briefcase-fill me-2" style="color: #3b82f6;"></i>
                            {{ __('Job Information') }}
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Job Title -->
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small text-uppercase mb-2">
                                    {{ __('Job Title') }}
                                </label>
                                <div class="p-3 bg-light rounded-3">
                                    <h4 class="fw-bold text-dark mb-0">{{ $job->title }}</h4>
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small text-uppercase mb-2">
                                    {{ __('Company') }}
                                </label>
                                <div class="p-3 bg-light rounded-3">
                                    <p class="fw-bold text-dark mb-0">
                                        <i class="bi bi-building me-2" style="color: #10b981;"></i>
                                        {{ $job->company }}
                                    </p>
                                </div>
                            </div>

                            <!-- Career Path -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small text-uppercase mb-2">
                                    {{ __('Career Path') }}
                                </label>
                                <div class="p-3 bg-light rounded-3">
                                    @if($job->careerPath)
                                        <span
                                            class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-semibold fs-6">
                                            {{ $job->careerPath->name }}
                                        </span>
                                    @else
                                        <span class="text-muted">{{ __('N/A') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Creation Date -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small text-uppercase mb-2">
                                    {{ __('Created At') }}
                                </label>
                                <div class="p-3 bg-light rounded-3">
                                    <p class="text-dark mb-0">
                                        <i class="bi bi-calendar-event me-2" style="color: #f59e0b;"></i>
                                        {{ $job->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small text-uppercase mb-2">
                                    {{ __('Last Updated') }}
                                </label>
                                <div class="p-3 bg-light rounded-3">
                                    <p class="text-dark mb-0">
                                        <i class="bi bi-arrow-repeat me-2" style="color: #8b5cf6;"></i>
                                        {{ $job->updated_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-light border-0 py-4 px-4">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="bi bi-lightning-fill me-2" style="color: #f59e0b;"></i>
                            {{ __('Quick Actions') }}
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <a href="{{ route('jobs.index') }}"
                            class="btn btn-outline-secondary w-100 rounded-3 py-2 fw-semibold mb-2">
                            <i class="bi bi-list me-2"></i> {{ __('View All Jobs') }}
                        </a>
                        <a href="{{ route('jobs.create') }}"
                            class="btn btn-outline-primary w-100 rounded-3 py-2 fw-semibold">
                            <i class="bi bi-plus-circle me-2"></i> {{ __('Create New Job') }}
                        </a>
                    </div>
                </div>

                <!-- Apply for Job Card -->
                @if(auth()->check() && auth()->user()->role === 'user')
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-light border-0 py-4 px-4">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="bi bi-file-earmark-check-fill me-2" style="color: #3b82f6;"></i>
                                {{ $applicationStatus ? __('Application Status') : __('Apply for This Job') }}
                            </h5>
                        </div>
                        <div class="card-body p-4 text-center">
                            @if($applicationStatus)
                                @php
                                    $badgeClass = 'bg-secondary';
                                    $statusText = __('Applied');
                                    $description = __('Your application has been received and is being reviewed.');

                                    if ($applicationStatus == 'approved') {
                                        $badgeClass = 'bg-success';
                                        $statusText = __('Accepted');
                                        $description = __('Congratulations! Your application has been approved.');
                                    } elseif ($applicationStatus == 'rejected') {
                                        $badgeClass = 'bg-danger';
                                        $statusText = __('Rejected');
                                        $description = __('We regret to inform you that your application was not selected.');
                                    } elseif ($applicationStatus == 'pending') {
                                        $badgeClass = 'bg-warning text-dark';
                                        $statusText = __('Pending');
                                        $description = __('Your application is currently being reviewed by your mentor.');
                                    }
                                @endphp

                                <div class="mb-3">
                                    <span class="badge {{ $badgeClass }} rounded-pill px-4 py-2 fs-6 fw-bold">
                                        {{ $statusText }}
                                    </span>
                                </div>
                                <p class="text-muted small mb-0">{{ $description }}</p>
                                <p class="text-muted small mb-3">{{ __('Submit an application for this job and it will be sent to your mentor for review.') }}</p>
                                <form action="{{ route('job_applications.store', $job) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-bold">
                                        <i class="bi bi-send-fill me-2"></i> {{ __('Submit Application') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Job Status -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-light border-0 py-4 px-4">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="bi bi-info-circle-fill me-2" style="color: #3b82f6;"></i>
                            {{ __('Status') }}
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 p-3 bg-success bg-opacity-10 rounded-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; background: #10b981;">
                                <i class="bi bi-check-circle-fill text-white fs-5"></i>
                            </div>
                            <div>
                                <p class="small text-muted fw-semibold text-uppercase mb-1">{{ __('Status') }}</p>
                                <p class="fw-bold text-dark mb-0">{{ __('Active') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-primary-subtle {
            background-color: rgba(59, 130, 246, 0.1) !important;
        }
    </style>
@endsection