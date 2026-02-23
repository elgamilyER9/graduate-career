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
                    <div
                        class="card border-0 shadow-lg rounded-4 text-center p-4 h-100 transition-all duration-300 hover-translate-y-n2 bg-white">
                        <div class="position-relative d-inline-block mx-auto mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background={{ $user->role === 'mentor' ? '0D6EFD' : '6c757d' }}&color=fff&size=80"
                                class="rounded-circle shadow-sm" alt="User">
                            @if($user->role === 'mentor')
                                <span class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1 shadow-sm"
                                    title="Verified Mentor"
                                    style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border: 2px solid white;">
                                    <i class="bi bi-patch-check-fill" style="font-size: 0.8rem;"></i>
                                </span>
                            @endif
                        </div>

                        <h6 class="fw-bold text-dark mb-1">{{ $user->name }}</h6>

                        <div class="mb-3">
                            <span
                                class="badge {{ $user->role === 'mentor' ? 'bg-primary' : 'bg-secondary' }} bg-opacity-10 text-{{ $user->role === 'mentor' ? 'primary' : 'secondary' }} rounded-pill px-3 py-1 fw-bold text-uppercase"
                                style="font-size: 0.6rem;">
                                {{ $user->role === 'mentor' ? __('Mentor') : __('Student') }}
                            </span>
                        </div>

                        <p class="small text-muted mb-0">
                            <i class="bi bi-mortarboard-fill me-1"></i> {{ $user->faculty->name ?? __('Community Member') }}
                        </p>

                        <div class="mt-3 pt-3 border-top w-100">
                            <button
                                class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-bold">{{ __('View Profile') }}</button>
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