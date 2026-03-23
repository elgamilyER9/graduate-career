@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Premium Header Section -->
        <div class="row align-items-center mb-5 animate__animated animate__fadeIn">
            <div class="col-12 col-lg-5">
                <h1 class="display-5 fw-black text-dark mb-2 position-relative d-inline-block">
                    {{ __('Training Programs') }}
                    <div class="position-absolute bottom-0 start-0 w-50"
                        style="height: 4px; background: #10b981; border-radius: 2px; bottom: -10px;"></div>
                </h1>
                <p class="text-muted mt-3 mb-0 fw-medium">
                    {{ __('Master new skills with our elite, mentor-led specialized courses.') }}</p>
            </div>

            <div class="col-12 col-lg-7 mt-4 mt-lg-0">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-lg-end align-items-center">
                    <!-- Advanced Search Bar -->
                    <form action="{{ route('trainings.index') }}" method="GET" class="flex-grow-1 w-100"
                        style="max-width: 550px;">
                        <div
                            class="search-glass rounded-pill p-1 shadow-lg border border-white border-opacity-20 d-flex position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0 w-100 h-100 backdrop-blur-md z-0"
                                style="background: rgba(255,255,255,0.6);"></div>
                            <span class="d-flex align-items-center ps-4 position-relative z-1">
                                <i class="bi bi-search text-success opacity-50"></i>
                            </span>
                            <input type="text" name="search"
                                class="form-control border-0 bg-transparent shadow-none py-3 px-3 position-relative z-1 fw-bold text-dark"
                                placeholder="{{ __('Search courses, providers, or skills...') }}"
                                value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('trainings.index') }}"
                                    class="btn btn-link text-muted border-0 p-0 me-2 position-relative z-1 d-flex align-items-center">
                                    <i class="bi bi-x-circle-fill"></i>
                                </a>
                            @endif
                            <button
                                class="btn btn-emerald rounded-pill px-5 fw-black position-relative z-1 shadow-lg hover-lift"
                                type="submit" style="letter-spacing: 1px;">
                                {{ __('SEARCH') }}
                            </button>
                        </div>
                    </form>

                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'mentor')
                        <a href="{{ route('trainings.create') }}"
                            class="btn btn-emerald-gold rounded-pill px-4 py-3 fw-black shadow-lg hover-lift d-flex align-items-center gap-2">
                            <i class="bi bi-mortarboard-fill fs-5"></i> <span>{{ __('NEW COURSE') }}</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-glass border-0 shadow-lg rounded-5 mb-5 p-4 animate__animated animate__fadeInDown">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-emerald text-white rounded-circle p-2 d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;">
                        <i class="bi bi-check2-all"></i>
                    </div>
                    <span class="fw-bold text-dark">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Training Grid -->
        <div class="row g-4 pt-2">
            @forelse($trainings as $training)
                <div class="col-12 col-md-6 col-xxl-4 animate__animated animate__fadeInUp"
                    style="animation-delay: {{ $loop->index * 0.05 }}s">
                    <div
                        class="advanced-glass-card h-100 p-4 rounded-5 border border-white border-opacity-10 transition-all hover-glow position-relative overflow-hidden group">

                        <!-- Floating Background Decoration -->
                        <div class="position-absolute top-0 end-0 p-3 opacity-5 group-hover-opacity-10 transition-all text-emerald-900"
                            style="font-size: 8rem; margin-right: -2rem; margin-top: -1rem; transform: rotate(15deg);">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>

                        <div class="position-relative z-1 h-100 d-flex flex-column">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="flex-shrink-0 bg-white bg-opacity-10 backdrop-blur rounded-4 d-flex align-items-center justify-content-center shadow-lg"
                                    style="width: 60px; height: 60px; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);">
                                    <i class="bi bi-lightning-charge-fill text-warning fs-2"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h4 class="fw-black mb-1 text-dark line-clamp-1">{{ $training->name ?? $training->title }}
                                    </h4>
                                    <span
                                        class="badge rounded-pill bg-soft-emerald text-emerald-700 small fw-bold border border-emerald border-opacity-10">LEVEL
                                        1 • FUNDAMENTALS</span>
                                </div>
                            </div>

                            <p class="text-muted small fw-medium mb-4 line-clamp-3">
                                {{ $training->description ?? __('Master the core principles and advanced techniques of this field with our comprehensive mentor-led training program designed for career growth.') }}
                            </p>

                            <div class="mt-auto">
                                <!-- Rich Metadata Strip -->
                                <div class="d-flex align-items-center flex-wrap gap-3 mb-4 text-muted small fw-bold p-3 rounded-4"
                                    style="background: rgba(0,0,0,0.02);">
                                    <span class="d-flex align-items-center"><i
                                            class="bi bi-clock-history me-2 text-emerald"></i> 12h</span>
                                    <span class="badge rounded-circle bg-emerald opacity-25 p-0"
                                        style="width:4px; height:4px;"></span>
                                    <span class="d-flex align-items-center"><i class="bi bi-person-badge me-2 text-primary"></i>
                                        {{ $training->mentor->name ?? __('Mentor') }}</span>
                                    <span class="badge rounded-circle bg-emerald opacity-25 p-0"
                                        style="width:4px; height:4px;"></span>
                                    <span class="d-flex align-items-center"><i class="bi bi-bar-chart-fill me-2 text-info"></i>
                                        {{ __('Intermediate') }}</span>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('trainings.show', $training) }}"
                                        class="btn btn-dark w-100 rounded-pill py-3 fw-black shadow-lg hover-lift border-0 flex-grow-1 d-flex align-items-center justify-content-center gap-2"
                                        style="background: #1e1b4b; letter-spacing: 1px;">
                                        {{ __('ENROLL NOW') }} <i class="bi bi-arrow-right-short fs-4"></i>
                                    </a>

                                    @if(auth()->user()->id === $training->mentor_id || auth()->user()->role === 'admin')
                                        <div class="btn-group gap-2">
                                            <a href="{{ route('trainings.edit', $training) }}"
                                                class="btn btn-warning rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm text-white border-0"
                                                title="{{ __('Edit') }}">
                                                <i class="bi bi-pencil-square fs-5"></i>
                                            </a>
                                            <form action="{{ route('trainings.destroy', $training) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm border-0"
                                                    onclick="return confirm('{{ __('Are you sure?') }}')"
                                                    title="{{ __('Delete') }}">
                                                    <i class="bi bi-trash-fill fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 animate__animated animate__fadeIn">
                    <div class="search-glass p-5 rounded-5 border border-dashed text-center">
                        <i class="bi bi-journal-x text-muted display-1 mb-3 opacity-25"></i>
                        <h3 class="fw-black text-dark">{{ __('No courses available right now') }}</h3>
                        <p class="text-muted mb-4">
                            {{ __('We\'re currently preparing new specialized trainings. Check back soon!') }}</p>
                        <a href="{{ route('trainings.index') }}"
                            class="btn btn-emerald rounded-pill px-5 py-3 fw-bold text-white">{{ __('Reset Search') }}</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .fw-black {
            font-weight: 900;
        }

        .text-emerald {
            color: #10b981;
        }

        .text-emerald-900 {
            color: #064e3b;
        }

        .text-emerald-700 {
            color: #047857;
        }

        .bg-emerald {
            background-color: #10b981;
        }

        .bg-soft-emerald {
            background: rgba(16, 185, 129, 0.1);
        }

        .search-glass {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }

        .alert-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
        }

        .advanced-glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05);
            border-radius: 2.5rem;
        }

        .advanced-glass-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 30px 60px -15px rgba(16, 185, 129, 0.15), 0 0 20px rgba(245, 158, 11, 0.05) !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
        }

        .btn-emerald {
            background: #10b981;
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-emerald:hover {
            background: #059669;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.4);
        }

        .btn-emerald-gold {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fef3c7;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-emerald-gold:hover {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
            transform: translateY(-2px);
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .backdrop-blur-md {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .group:hover .group-hover-opacity-10 {
            opacity: 0.1 !important;
        }
    </style>
@endsection