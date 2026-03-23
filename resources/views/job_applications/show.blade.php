@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex align-items-center justify-content-between mb-5 animate__animated animate__fadeIn">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('job_applications.index') }}" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center shadow-sm hover-scale transition-all" style="width: 48px; height: 48px;" title="{{ __('Back') }}">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
            <div>
                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-1 mb-2 fw-bold text-uppercase tracking-wider extra-small">
                    {{ __('Application Details') }}
                </span>
                <h2 class="fw-bolder text-dark mb-0">{{ $jobApplication->user->name }}</h2>
            </div>
        </div>
        <span class="badge {{ $jobApplication->status === 'approved' ? 'bg-success' : ($jobApplication->status === 'rejected' ? 'bg-danger' : 'bg-warning') }} rounded-pill px-4 py-2 fw-bold fs-6 shadow-sm">
            <i class="bi {{ $jobApplication->status === 'approved' ? 'bi-check-circle' : ($jobApplication->status === 'rejected' ? 'bi-x-circle' : 'bi-hourglass-split') }} me-2"></i>
            {{ __(ucfirst($jobApplication->status)) }}
        </span>
    </div>

    <div class="row g-4 animate__animated animate__fadeInUp">
        <div class="col-lg-8">
            <!-- Applicant Profile Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-white border-0 py-4 px-4 d-flex align-items-center">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-3">
                        <i class="bi bi-person-badge fs-4"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">{{ __('Applicant Profile') }}</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-4 h-100">
                                <p class="text-muted small text-uppercase fw-bold mb-1 extra-small tracking-wider">{{ __('Full Name') }}</p>
                                <p class="fw-bold text-dark mb-0">{{ $jobApplication->user->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-4 h-100">
                                <p class="text-muted small text-uppercase fw-bold mb-1 extra-small tracking-wider">{{ __('Email Address') }}</p>
                                <p class="fw-bold text-dark mb-0"><a href="mailto:{{ $jobApplication->user->email }}" class="text-decoration-none">{{ $jobApplication->user->email }}</a></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-4 h-100">
                                <p class="text-muted small text-uppercase fw-bold mb-1 extra-small tracking-wider">{{ __('University') }}</p>
                                <p class="fw-bold text-dark mb-0">{{ $jobApplication->user->university->name ?? $jobApplication->user->other_university ?? __('N/A') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-4 h-100">
                                <p class="text-muted small text-uppercase fw-bold mb-1 extra-small tracking-wider">{{ __('Faculty / Major') }}</p>
                                <p class="fw-bold text-dark mb-0">{{ $jobApplication->user->faculty->name ?? $jobApplication->user->other_faculty ?? __('N/A') }}</p>
                            </div>
                        </div>
                        @if($jobApplication->user->linkedin_url)
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-4">
                                <p class="text-muted small text-uppercase fw-bold mb-1 extra-small tracking-wider">{{ __('LinkedIn Profile') }}</p>
                                <a href="{{ $jobApplication->user->linkedin_url }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mt-1">
                                    <i class="bi bi-linkedin me-1"></i> {{ __('View Profile') }}
                                </a>
                            </div>
                        </div>
                        @endif
                        @if($jobApplication->user->bio)
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-4">
                                <p class="text-muted small text-uppercase fw-bold mb-1 extra-small tracking-wider">{{ __('Applicant Bio') }}</p>
                                <p class="text-dark mb-0">{{ $jobApplication->user->bio }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Job Details Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-white border-0 py-4 px-4 d-flex align-items-center">
                    <div class="icon-box bg-info bg-opacity-10 text-info rounded-3 p-2 me-3">
                        <i class="bi bi-briefcase fs-4"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">{{ __('Applied Position') }}</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="p-4 bg-light rounded-4 border-start border-4 border-info">
                        <h4 class="fw-bold text-dark mb-2">{{ $jobApplication->job->title }}</h4>
                        <div class="d-flex align-items-center gap-3 text-muted small mb-3">
                            <span><i class="bi bi-building me-1"></i> {{ $jobApplication->job->company }}</span>
                            <span><i class="bi bi-tag me-1"></i> {{ $jobApplication->job->careerPath->name ?? __('N/A') }}</span>
                        </div>
                        <a href="{{ route('jobs.show', $jobApplication->job) }}" class="btn btn-info text-white rounded-pill px-4 py-2 fw-bold text-decoration-none btn-sm shadow-sm">
                            <i class="bi bi-box-arrow-up-right me-1"></i> {{ __('View Job Details') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Action Card -->
            @if(auth()->user()->role === 'mentor' && auth()->user()->id === $jobApplication->mentor_id)
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-4 text-center">
                        <i class="bi bi-shield-lock-fill text-primary me-2"></i>{{ __('Review Action') }}
                    </h5>
                    
                    <form action="{{ route('job_applications.update', $jobApplication) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small tracking-wider text-uppercase">{{ __('Feedback Notes (Optional)') }}</label>
                            <textarea name="notes" class="form-control rounded-4 border-0 shadow-sm" rows="4" placeholder="{{ __('Add any notes regarding this application...') }}">{{ $jobApplication->notes }}</textarea>
                        </div>
                        
                        <div class="d-grid gap-3">
                            <button type="submit" name="status" value="approved" class="btn btn-success rounded-pill py-3 fw-bold shadow-sm hover-scale transition-all">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ __('Approve Application') }}
                            </button>
                            <button type="submit" name="status" value="rejected" class="btn btn-danger rounded-pill py-3 fw-bold shadow-sm hover-scale transition-all">
                                <i class="bi bi-x-circle-fill me-2"></i>{{ __('Reject Application') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Application Timeline -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h6 class="mb-0 fw-bold text-dark text-uppercase tracking-wider extra-small">
                        <i class="bi bi-clock-history me-2 text-primary"></i>{{ __('Timeline') }}
                    </h6>
                </div>
                <div class="card-body px-4 pb-4 pt-0">
                    <ul class="list-unstyled mb-0 position-relative">
                        <li class="mb-4 ms-3 position-relative">
                            <span class="position-absolute top-0 start-0 translate-middle p-2 bg-primary border border-white border-3 rounded-circle" style="margin-left: -15px;"></span>
                            <div class="fw-bold text-dark small">{{ __('Application Submitted') }}</div>
                            <div class="text-muted extra-small">{{ $jobApplication->created_at->format('M d, Y - h:i A') }}</div>
                        </li>
                        <li class="ms-3 position-relative">
                            <span class="position-absolute top-0 start-0 translate-middle p-2 {{ $jobApplication->status !== 'pending' ? 'bg-success' : 'bg-secondary' }} border border-white border-3 rounded-circle" style="margin-left: -15px;"></span>
                            <div class="fw-bold {{ $jobApplication->status !== 'pending' ? 'text-dark' : 'text-muted' }} small">{{ __('Reviewed') }}</div>
                            <div class="text-muted extra-small">{{ $jobApplication->updated_at > $jobApplication->created_at ? $jobApplication->updated_at->format('M d, Y - h:i A') : __('Pending') }}</div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Read-only Notes for Applicants -->
            @if((auth()->user()->role === 'user' || auth()->user()->role === 'admin') && $jobApplication->notes)
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-4 bg-light bg-opacity-50">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">
                        <i class="bi bi-chat-left-text-fill text-warning me-2"></i>{{ __('Mentor Feedback') }}
                    </h6>
                    <p class="mb-0 text-muted small">{{ $jobApplication->notes }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .transition-all { transition: all 0.3s ease; }
    .hover-scale { transition: transform 0.2s ease; display: inline-block; }
    .hover-scale:hover { transform: scale(1.05); }
    .extra-small { font-size: 0.75rem; }
    .tracking-wider { letter-spacing: 0.1em; }
    ul.list-unstyled::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 2px;
        background-color: #e2e8f0;
    }
</style>
@endsection
