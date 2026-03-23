@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-5 animate__animated animate__fadeIn">
            <div class="col-12 text-center">
                <span
                    class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold">{{ __('Network') }}</span>
                <h2 class="display-5 fw-bold text-dark mb-3">{{ __('Community Directory') }}</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">
                    {{ __('Meet other graduates and professionals in our community. Build relationships that last a lifetime.') }}
                </p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            @foreach($users as $user)
                <div class="col-12 col-md-6 col-lg-3 animate__animated animate__fadeInUp"
                    style="animation-delay: {{ $loop->index * 0.05 }}s">
                    <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100 transition-all duration-300 hover-translate-y-n2 bg-white position-relative
                                        {{ $user->role === 'admin' ? 'border-top-danger' : ($user->role === 'mentor' ? 'border-top-primary' : 'border-top-secondary') }}"
                        style="{{ $user->role === 'admin' ? 'border-top: 5px solid #dc3545 !important;' : ($user->role === 'mentor' ? 'border-top: 5px solid #0d6efd !important;' : 'border-top: 5px solid #6c757d !important;') }}">

                        <!-- Role-colored background splash -->
                        <div class="position-absolute top-0 start-0 w-100 opacity-10"
                            style="height: 100px; background: linear-gradient(180deg, {{ $user->role === 'admin' ? '#dc3545' : ($user->role === 'mentor' ? '#0d6efd' : '#6c757d') }} 0%, rgba(255,255,255,0) 100%);">
                        </div>

                        <div class="position-relative d-inline-block mx-auto mb-3 mt-2 z-1">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background={{ $user->role === 'mentor' ? '0D6EFD' : '6c757d' }}&color=fff&size=80"
                                class="rounded-circle shadow-sm" alt="User"
                                style="border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;">
                            @if($user->role === 'mentor')
                                <span class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1 shadow-sm"
                                    title="Verified Mentor"
                                    style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border: 2px solid white;">
                                    <i class="bi bi-patch-check-fill" style="font-size: 0.8rem;"></i>
                                </span>
                            @endif
                        </div>

                        <h6 class="fw-black text-dark mb-1 fs-5 position-relative z-1">{{ $user->name }}</h6>

                        <div class="mb-3 position-relative z-1">
                            <span
                                class="badge {{ $user->role === 'admin' ? 'bg-danger' : ($user->role === 'mentor' ? 'bg-primary' : 'bg-secondary') }} text-white rounded-pill px-3 py-1 fw-bold text-uppercase shadow-sm tracking-wider"
                                style="font-size: 0.65rem;">
                                @if($user->role === 'admin')
                                    <i class="bi bi-shield-lock-fill me-1"></i> {{ __('Admin') }}
                                @elseif($user->role === 'mentor')
                                    <i class="bi bi-star-fill me-1"></i> {{ __('Mentor') }}
                                @else
                                    <i class="bi bi-person-fill me-1"></i> {{ __('Student') }}
                                @endif
                            </span>
                        </div>

                        <p class="small text-muted mb-4 position-relative z-1 fw-medium">
                            <i class="bi bi-mortarboard-fill me-1 text-success"></i>
                            {{ $user->faculty->name ?? __('Community Member') }}
                        </p>

                        <div class="mt-auto pt-3 border-top w-100 d-flex gap-2 position-relative z-1">
                            <a href="{{ route('messages.show', $user) }}"
                                class="btn btn-primary rounded-pill flex-grow-1 fw-bold shadow-sm hover-scale text-white">
                                <i class="bi bi-chat-dots-fill me-1"></i> {{ __('Chat') }}
                            </a>
                            <a href="{{ route('users.show', $user) }}"
                                class="btn btn-light border-primary border text-primary rounded-circle px-0 fw-bold shadow-sm hover-scale d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;" title="{{ __('View Profile') }}">
                                <i class="bi bi-person-fill fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center pb-5 animate__animated animate__fadeIn">
            <button class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm">
                <i class="bi bi-arrow-down-circle me-2"></i> {{ __('Load More Members') }}
            </button>
        </div>
    </div>

    <style>
        .transition-all {
            transition: all 0.3s ease;
        }

        .duration-300 {
            transition-duration: 300ms;
        }

        .hover-translate-y-n2:hover {
            transform: translateY(-0.4rem);
        }
    </style>
@endsection