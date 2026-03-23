@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-5 animate__animated animate__fadeIn">
            <div class="col-12 text-center">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold tracking-wider shadow-sm">
                    <i class="bi bi-star-fill me-1 text-warning"></i> {{ __('Expert Guidance') }}
                </span>
                <h2 class="display-5 fw-black text-dark mb-3" style="letter-spacing: -1px;">{{ __('Find your Professional Mentor') }}</h2>
                <p class="lead text-muted mx-auto fw-medium" style="max-width: 700px;">
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
                            <div class="flip-card-front card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white" style="border-top: 4px solid #0d6efd !important;">
                                <div class="card-body p-4 text-center d-flex flex-column position-relative">
                                    <div class="position-absolute opacity-10" style="left: -10px; top: -10px; transform: rotate(-15deg);">
                                        <i class="bi bi-person-workspace text-primary" style="font-size: 5rem;"></i>
                                    </div>
                                    <div class="position-relative mb-4 d-inline-block mx-auto z-1">
                                        <div class="avatar-glow"></div>
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=0D6EFD&color=fff&size=100"
                                            alt="Mentor" class="rounded-circle shadow-sm border border-4 border-white position-relative z-1" style="width:100px; height:100px;">
                                        <span class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle p-2 shadow-sm" style="width:18px; height:18px; transform: translate(-10px, -5px);" title="Online"></span>
                                    </div>

                                    <h5 class="fw-black text-dark mb-1 z-1">{{ $mentor->name }}</h5>
                                    @if ($mentor->job_title)
                                        <p class="text-primary small fw-bold mb-2 z-1 bg-primary bg-opacity-10 rounded-pill px-3 py-1 d-inline-block mx-auto">
                                            {{ $mentor->job_title }}
                                            @if ($mentor->company)
                                                <span class="text-dark">@ {{ $mentor->company }}</span>
                                            @endif
                                        </p>
                                    @else
                                        <p class="text-primary small fw-bold mb-3 z-1 bg-primary bg-opacity-10 rounded-pill px-3 py-1 d-inline-block mx-auto">
                                            <i class="bi bi-mortarboard-fill me-1"></i>
                                            {{ $mentor->careerPath->name ?? __('Professional Mentor') }}
                                        </p>
                                    @endif

                                    @if ($mentor->years_experience)
                                        <div class="mb-3 z-1 d-flex justify-content-center gap-2">
                                            <span class="badge bg-light text-dark border shadow-sm rounded-pill px-3 py-2 small fw-bold">
                                                <i class="bi bi-clock-history me-1 text-primary"></i>
                                                {{ $mentor->years_experience }}
                                                {{ __('Years Exp.') }}
                                            </span>
                                            @if ($mentor->linkedin_url)
                                                <a href="{{ $mentor->linkedin_url }}" target="_blank" class="btn btn-sm btn-light border shadow-sm rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 32px; height: 32px;" title="LinkedIn">
                                                    <i class="bi bi-linkedin"></i>
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="bg-light rounded-4 p-3 mb-4 text-start flex-grow-1 z-1 border border-light shadow-sm">
                                        <p class="small text-secondary mb-0 line-clamp-3 fw-medium">
                                            <i class="bi bi-quote fs-5 text-muted opacity-50 me-1"></i>{{ $mentor->bio ?: __('No bio available yet.') }}
                                        </p>
                                    </div>

                                    <div class="z-1 mt-auto">
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
                                                <button class="btn btn-primary rounded-pill px-4 w-100 fw-bold shadow-sm py-2 flip-trigger hover-scale"
                                                    onclick="flipCard('{{ $mentor->id }}')">
                                                    <i class="bi bi-send-fill me-1"></i> {{ __('Send Request') }}
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn btn-primary rounded-pill px-4 w-100 fw-bold shadow-sm py-2 flip-trigger hover-scale"
                                                onclick="flipCard('{{ $mentor->id }}')">
                                                <i class="bi bi-person-plus-fill me-1"></i> {{ __('Request Mentorship') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer bg-light border-0 text-center py-3 z-1 mt-auto border-top border-light">
                                    <small class="text-muted fw-bold"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                        {{ $mentor->university->name ?? __('Unknown University') }}</small>
                                </div>
                            </div>

                            <!-- Back Side (Request Form) -->
                            <div class="flip-card-back card border-0 shadow-sm rounded-4 overflow-hidden bg-white" style="border-top: 4px solid #198754 !important;">
                                <div class="premium-card-head p-4 pb-0 d-flex justify-content-between align-items-center bg-light border-bottom border-light">
                                    <button class="btn btn-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center border" style="width: 35px; height: 35px;"
                                        onclick="flipCard('{{ $mentor->id }}')">
                                        <i class="bi bi-arrow-left text-muted fw-bold"></i>
                                    </button>
                                    <h6 class="fw-bolder text-dark mb-0">{{ __('NEW REQUEST') }}</h6>
                                </div>
                                <div class="card-body p-4 pt-4 d-flex flex-column h-100">
                                    <div class="text-center mb-4">
                                        <div class="small-avatar mb-2 d-inline-block">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=198754&color=fff&size=60"
                                                class="rounded-circle shadow-sm border border-3 border-white" alt="">
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">{{ __('Guidance from') }} <span class="text-success">{{ $mentor->name }}</span></h6>
                                        <p class="text-muted small fw-medium mb-0 bg-light rounded-pill px-2 py-1 d-inline-block mt-1">
                                            {{ $mentor->job_title ?: $mentor->careerPath->name }}</p>
                                    </div>

                                    <form action="{{ route('mentorship_requests.store') }}" method="POST" class="mt-auto flex-grow-1 d-flex flex-column">
                                        @csrf
                                        <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">

                                        <div class="mb-4 flex-grow-1 d-flex flex-column">
                                            <label
                                                class="form-label fw-bold text-dark small mb-2 text-uppercase tracking-wider">
                                                {{ __('Briefly describe your goals') }}
                                            </label>
                                            <textarea name="message" class="form-control premium-input p-3 shadow-sm h-100 flex-grow-1" style="min-height: 120px;"
                                                placeholder="{{ __('Help the mentor understand how they can guide you...') }}"
                                                required></textarea>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-success rounded-pill w-100 py-2 fw-bold shadow-sm hover-scale mt-auto">
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
        .fw-black { font-weight: 900; }
        .tracking-wider { letter-spacing: 0.05em; }
        .hover-scale { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-scale:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }

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
            width: 140%;
            height: 140%;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.15) 0%, rgba(13, 110, 253, 0) 70%);
            z-index: 0;
            pointer-events: none;
        }

        /* 3D Flip Card CSS */
        .flip-card-container {
            perspective: 1500px;
            height: 540px;
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
            border-radius: 1rem;
        }

        .flip-card-back {
            transform: rotateY(180deg);
            z-index: 2;
        }

        .premium-input {
            border: 1px solid #e2e8f0 !important;
            border-radius: 1rem !important;
            background-color: #f8fafc !important;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            resize: none;
        }

        .premium-input:focus {
            border-color: #198754 !important;
            background-color: #fff !important;
            box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.1) !important;
        }

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