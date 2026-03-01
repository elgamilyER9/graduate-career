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
                @php
                    $existing = $myRequests[$mentor->id] ?? null;
                @endphp
                <div class="col-12 col-md-6 col-lg-3 animate__animated animate__fadeInUp"
                    style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div class="flip-card-container">
                        <div class="flip-card" id="card{{ $mentor->id }}">
                            <!-- Front Side -->
                            <div class="flip-card-front card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                                <div class="card-body p-4 text-center d-flex flex-column">
                                    <div class="position-relative mb-4 d-inline-block mx-auto">
                                        <div class="avatar-glow"></div>
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=0D6EFD&color=fff&size=100"
                                            alt="Mentor" class="rounded-circle shadow position-relative z-1">
                                        <span
                                            class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle p-2 shadow-sm"
                                            title="Online"></span>
                                    </div>

                                    <h5 class="fw-bold text-dark mb-0">{{ $mentor->name }}</h5>
                                    @if ($mentor->job_title)
                                        <p class="text-primary small fw-bold mb-1">{{ $mentor->job_title }}
                                            @if ($mentor->company)
                                                @ {{ $mentor->company }}
                                            @endif
                                        </p>
                                    @else
                                        <p class="text-primary small fw-semibold mb-3">
                                            <i class="bi bi-mortarboard-fill me-1"></i>
                                            {{ $mentor->careerPath->name ?? __('Professional Mentor') }}
                                        </p>
                                    @endif

                                    @if ($mentor->years_experience)
                                        <div class="mb-3">
                                            <span class="badge bg-light text-dark border rounded-pill px-2 py-1 small">
                                                <i class="bi bi-clock-history me-1 text-primary"></i>
                                                {{ $mentor->years_experience }}
                                                {{ __('Years Exp.') }}
                                            </span>
                                            @if ($mentor->linkedin_url)
                                                <a href="{{ $mentor->linkedin_url }}" target="_blank" class="ms-1 text-primary"
                                                    title="LinkedIn">
                                                    <i class="bi bi-linkedin"></i>
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="bg-light-subtle rounded-3 p-3 mb-4 text-start flex-grow-1">
                                        <p class="small text-secondary mb-0 line-clamp-3">
                                            {{ $mentor->bio ?: __('No bio available yet.') }}
                                        </p>
                                    </div>

                                    @if($existing)
                                        @if($existing->status === 'pending')
                                            <button class="btn btn-warning rounded-pill px-4 w-100 fw-bold shadow-sm py-2" disabled>
                                                <i class="bi bi-clock-history me-1"></i> {{ __('Pending') }}
                                            </button>
                                        @elseif($existing->status === 'approved')
                                            <button class="btn btn-success rounded-pill px-4 w-100 fw-bold shadow-sm py-2" disabled>
                                                <i class="bi bi-check-circle-fill me-1"></i> {{ __('Connected') }}
                                            </button>
                                        @else
                                            <button class="btn btn-primary rounded-pill px-4 w-100 fw-bold shadow-sm py-2 flip-trigger"
                                                onclick="flipCard('{{ $mentor->id }}')">
                                                {{ __('Send Request') }}
                                            </button>
                                        @endif
                                    @else
                                        <button class="btn btn-primary rounded-pill px-4 w-100 fw-bold shadow-sm py-2 flip-trigger"
                                            onclick="flipCard('{{ $mentor->id }}')">
                                            {{ __('Request Mentorship') }}
                                        </button>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-0 text-center pb-4 pt-0">
                                    <small class="text-muted"><i class="bi bi-geo-alt-fill me-1"></i>
                                        {{ $mentor->university->name ?? __('Unknown University') }}</small>
                                </div>
                            </div>

                            <!-- Back Side (Request Form) -->
                            <div class="flip-card-back card border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                                <div class="premium-card-head p-4 pb-0 d-flex justify-content-between align-items-center">
                                    <button class="btn btn-light rounded-circle p-2 shadow-sm"
                                        onclick="flipCard('{{ $mentor->id }}')">
                                        <i class="bi bi-arrow-left"></i>
                                    </button>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fw-bold small">
                                        {{ __('NEW REQUEST') }}
                                    </span>
                                </div>
                                <div class="card-body p-4 pt-2">
                                    <div class="text-center mb-4">
                                        <div class="small-avatar mb-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=0D6EFD&color=fff&size=50"
                                                class="rounded-circle shadow-sm" alt="">
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">{{ __('Guidance from') }} {{ $mentor->name }}</h6>
                                        <p class="text-muted extra-small mb-0">
                                            {{ $mentor->job_title ?: $mentor->careerPath->name }}</p>
                                    </div>

                                    <form action="{{ route('mentorship_requests.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">

                                        <div class="mb-4">
                                            <label
                                                class="form-label fw-bold text-dark extra-small mb-2 text-uppercase letter-spacing-1">
                                                {{ __('Briefly describe your goals') }}
                                            </label>
                                            <textarea name="message" class="form-control premium-input p-3 shadow-none" rows="6"
                                                placeholder="{{ __('Help the mentor understand how they can guide you...') }}"
                                                required></textarea>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary rounded-pill w-100 py-2 fw-bold shadow-sm hover-up">
                                            {{ __('Confirm Send') }} <i class="bi bi-send-fill ms-2 small"></i>
                                        </button>
                                    </form>
                                </div>
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
            background: radial-gradient(circle, rgba(13, 110, 253, 0.15) 0%, rgba(13, 110, 253, 0) 70%);
            z-index: 0;
        }

        /* 3D Flip Card CSS */
        .flip-card-container {
            perspective: 1500px;
            height: 520px;
            margin-bottom: 30px;
        }

        .flip-card {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
            cursor: pointer;
        }

        .flip-card.is-flipped {
            transform: rotateY(180deg);
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            border-radius: 20px;
        }

        .flip-card-back {
            transform: rotateY(180deg);
            z-index: 2;
        }

        .premium-input {
            border: 1px solid #eee !important;
            border-radius: 15px !important;
            background-color: #f8f9ff !important;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .premium-input:focus {
            border-color: #0d6efd !important;
            background-color: #fff !important;
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.05) !important;
        }

        .extra-small {
            font-size: 0.75rem;
        }

        .letter-spacing-1 {
            letter-spacing: 0.5px;
        }

        /* Prevent button clicks from flipping card if not needed, 
           or use specific triggers */
        .flip-card-front, .flip-card-back {
            cursor: default;
        }
    </style>

    <script>
        function flipCard(id) {
            const card = document.getElementById('card' + id);
            card.classList.toggle('is-flipped');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.mentor-action').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    var status = this.dataset.status;
                    if (status === 'pending') {
                        e.preventDefault();
                        alert('{{ __('Your request is still pending.') }}');
                    } else if (status === 'approved') {
                        e.preventDefault();
                        alert('{{ __('You are already connected with this mentor.') }}');
                    }
                });
            });
        });
    </script>
@endsection