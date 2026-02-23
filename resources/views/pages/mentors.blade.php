@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-5 animate__animated animate__fadeIn">
            <div class="col-12 text-center">
                <span
                    class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold">{{ __('Guidance') }}</span>
                <h2 class="display-5 fw-bold text-dark mb-3">{{ __('Find your Professional Mentor') }}</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">
                    {{ __('Get guidance from experienced professionals in your field to accelerate your career growth.') }}
                </p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            @forelse($mentors as $mentor)
                <div class="col-12 col-md-6 col-lg-3 animate__animated animate__fadeInUp"
                    style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div
                        class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all duration-300 hover-translate-y-n3 h-100">
                        <div class="card-body p-4 text-center">
                            <div class="position-relative mb-4 d-inline-block">
                                <div class="avatar-glow"></div>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=0D6EFD&color=fff&size=100"
                                    alt="Mentor" class="rounded-circle shadow position-relative z-1">
                                <span
                                    class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle p-2 shadow-sm"
                                    title="Online"></span>
                            </div>

                            <h5 class="fw-bold text-dark mb-1">{{ $mentor->name }}</h5>
                            <p class="text-primary small fw-semibold mb-3">
                                <i class="bi bi-mortarboard-fill me-1"></i>
                                {{ $mentor->faculty->name ?? __('Professional Mentor') }}
                            </p>

                            <div class="bg-light-subtle rounded-3 p-3 mb-4 text-start">
                                <p class="small text-secondary mb-0 line-clamp-3">
                                    {{ $mentor->bio ?: __('No bio available yet.') }}
                                </p>
                            </div>

                            <button class="btn btn-primary rounded-pill px-4 w-100 fw-bold shadow-sm py-2"
                                data-bs-toggle="modal" data-bs-target="#requestModal{{ $mentor->id }}">
                                {{ __('Request Mentorship') }}
                            </button>
                        </div>
                        <div class="card-footer bg-white border-0 text-center pb-4 pt-0">
                            <small class="text-muted"><i class="bi bi-geo-alt-fill me-1"></i>
                                {{ $mentor->university->name ?? __('Unknown University') }}</small>
                        </div>
                    </div>

                    <!-- Request Modal -->
                    <div class="modal fade" id="requestModal{{ $mentor->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                <div class="modal-header bg-primary text-white border-0 py-4">
                                    <h5 class="fw-bold mb-0">{{ __('Request from') }} {{ $mentor->name }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('mentorship_requests.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label
                                                class="form-label fw-bold text-muted small mb-2 text-uppercase">{{ __('Why do you want this mentor?') }}</label>
                                            <textarea name="message" class="form-control bg-light border-0 rounded-3 p-3"
                                                rows="5" placeholder="{{ __('Introduce yourself and describe your goals...') }}"
                                                required></textarea>
                                        </div>
                                        <div class="d-flex align-items-center p-3 bg-primary bg-opacity-10 rounded-3 mb-1">
                                            <i class="bi bi-info-circle-fill text-primary me-3 fs-4"></i>
                                            <p class="small text-primary mb-0">
                                                {{ __('Your message helps mentors understand how they can help you.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 p-4 pt-0">
                                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold"
                                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                        <button type="submit"
                                            class="btn btn-primary rounded-pill px-4 fw-bold px-5">{{ __('Send Request') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 animate__animated animate__fadeIn">
                    <div class="bg-white p-5 rounded-4 shadow-sm border border-dashed">
                        <i class="bi bi-people text-muted display-1 mb-3"></i>
                        <h4 class="fw-bold text-dark">{{ __('No Mentors Available') }}</h4>
                        <p class="text-muted">{{ __('Check back later as new mentors join our community.') }}</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .transition-all {
            transition: all 0.3s ease;
        }

        .duration-300 {
            transition-duration: 300ms;
        }

        .hover-translate-y-n3:hover {
            transform: translateY(-0.5rem);
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .avatar-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120%;
            height: 120%;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.2) 0%, rgba(13, 110, 253, 0) 70%);
            z-index: 0;
        }
    </style>
@endsection