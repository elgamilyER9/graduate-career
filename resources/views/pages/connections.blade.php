@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5 animate__animated animate__fadeIn">
        <div class="col-12">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold">{{ __('Network') }}</span>
            <h2 class="display-5 fw-bold text-dark mb-2">{{ __('My Professional Connections') }}</h2>
            <p class="lead text-muted">{{ __('Manage your mentors and mentees here.') }}</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse($connections as $conn)
            @php
                $targetUser = Auth::user()->role === 'mentor' ? $conn->student : $conn->mentor;
            @endphp
            <div class="col-12 col-md-6 col-lg-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all duration-300 hover-translate-y-n3 h-100 p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="position-relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($targetUser->name) }}&background=0D6EFD&color=fff&size=60"
                                alt="User" class="rounded-circle shadow-sm">
                            <span class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle p-1 shadow-sm"></span>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold text-dark mb-0">{{ $targetUser->name }}</h5>
                            <span class="badge bg-primary-subtle text-primary rounded-pill small fw-semibold text-uppercase mt-1" style="font-size: 0.65rem;">
                                {{ Auth::user()->role === 'mentor' ? __('Mentee') : __('Mentor') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="bg-light p-3 rounded-4 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small fw-bold text-uppercase">{{ __('Faculty') }}</span>
                            <span class="text-dark small fw-semibold">{{ $targetUser->faculty->name ?? __('Unknown') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small fw-bold text-uppercase">{{ __('Connected Since') }}</span>
                            <span class="text-dark small fw-semibold">{{ $conn->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <div class="mt-auto d-flex gap-2">
                        <a href="mailto:{{ $targetUser->email }}"
                            class="btn btn-primary rounded-pill flex-grow-1 fw-bold shadow-sm py-2">
                            <i class="bi bi-envelope-at me-2"></i> {{ __('Email') }}
                        </a>
                        <button class="btn btn-light rounded-circle shadow-sm p-0 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" title="Chat">
                            <i class="bi bi-chat-dots-fill text-primary mt-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 animate__animated animate__fadeIn">
                <div class="bg-white p-5 rounded-4 shadow-lg border border-light d-inline-block" style="max-width: 500px;">
                    <div class="avatar-circle-lg bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                        <i class="bi bi-person-plus display-4"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">{{ __('No connections yet.') }}</h4>
                    <p class="text-muted mb-4">{{ __('Expand your professional network by requesting mentorship from experts in your field.') }}</p>
                    @if(Auth::user()->role === 'user')
                        <a href="{{ route('mentors.index') }}"
                            class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm py-3">{{ __('Browse Mentors') }}</a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .transition-all { transition: all 0.3s ease; }
    .duration-300 { transition-duration: 300ms; }
    .hover-translate-y-n3:hover { transform: translateY(-0.5rem); }
    .avatar-circle-lg {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection
