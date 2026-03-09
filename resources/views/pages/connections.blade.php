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
        @forelse($connections as $targetUser)
            @php
                // Determine relationship badge
                $badgeText = __('Community');
                if (auth()->user()->role === 'mentor') {
                    // check if this user is a mentee
                    $isMentee = \App\Models\MentorshipRequest::where('mentor_id', auth()->id())
                        ->where('user_id', $targetUser->id)
                        ->where('status', 'approved')
                        ->exists();
                    if ($isMentee) $badgeText = __('Mentee');
                } else {
                    $isMentor = \App\Models\MentorshipRequest::where('user_id', auth()->id())
                        ->where('mentor_id', $targetUser->id)
                        ->where('status', 'approved')
                        ->exists();
                    if ($isMentor) $badgeText = __('Mentor');
                }
            @endphp
            <div class="col-12 col-md-6 col-lg-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden transition-all duration-300 hover-translate-y-n3 h-100 p-4 bg-white position-relative" style="border-top: 4px solid #0d6efd !important;">
                    
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="bi bi-diagram-3-fill text-primary" style="font-size: 4rem;"></i>
                    </div>

                    <div class="d-flex align-items-center mb-4 position-relative z-1">
                        <div class="position-relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($targetUser->name) }}&background=0D6EFD&color=fff&size=60"
                                alt="User" class="rounded-circle shadow-sm border border-2 border-white">
                            <span class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle shadow-sm" style="width: 14px; height: 14px;"></span>
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-black text-dark mb-0 fs-5">{{ $targetUser->name }}</h5>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill small fw-bold text-uppercase mt-1 tracking-wider" style="font-size: 0.65rem;">
                                <i class="bi bi-link-45deg me-1"></i> {{ $badgeText }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="bg-light bg-opacity-50 p-3 rounded-4 mb-4 border border-light position-relative z-1">
                        <div class="d-flex justify-content-between mb-2 align-items-center">
                            <span class="text-muted small fw-bold text-uppercase tracking-wider" style="font-size: 0.7rem;"><i class="bi bi-building me-1"></i> {{ __('Faculty') }}</span>
                            <span class="text-dark small fw-bold">{{ $targetUser->faculty->name ?? __('Unknown') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-bold text-uppercase tracking-wider" style="font-size: 0.7rem;"><i class="bi bi-calendar-check me-1"></i> {{ __('Joined') }}</span>
                            <span class="text-dark small fw-bold">{{ $targetUser->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <div class="mt-auto d-flex gap-2 position-relative z-1 border-top pt-3">
                        <a href="mailto:{{ $targetUser->email }}"
                            class="btn btn-outline-primary rounded-pill flex-grow-1 fw-bold border-2">
                            <i class="bi bi-envelope-at me-2"></i> {{ __('Email') }}
                        </a>
                        @php
                            $unreadFrom = \App\Models\Message::where('sender_id', $targetUser->id)
                                ->where('receiver_id', auth()->id())
                                ->where('read', false)
                                ->count();
                        @endphp
                        <a href="{{ route('messages.show', $targetUser) }}"
                            class="btn btn-primary rounded-circle shadow-sm p-0 d-flex align-items-center justify-content-center position-relative hover-scale"
                            style="width: 44px; height: 44px;" title="{{ __('Chat with :name', ['name' => $targetUser->name]) }}">
                            <i class="bi bi-chat-dots-fill text-white pb-1"></i>
                            @if($unreadFrom)
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-white border-2 rounded-circle" style="width: 12px; height: 12px;"></span>
                            @endif
                        </a>
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
