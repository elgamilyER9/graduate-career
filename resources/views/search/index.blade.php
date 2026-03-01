@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        {{-- Header --}}
        <div class="mb-5">
            <h2 class="display-6 fw-bolder mb-2">
                <i class="bi bi-search me-2 text-primary"></i>{{ __('Advanced Search') }}
            </h2>
            <p class="text-muted">{{ __('Find jobs, trainings, mentors, and skills') }}</p>
        </div>

        {{-- Search Form --}}
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 rounded-4 shadow-sm p-4">
                    <form action="{{ route('search.advanced') }}" method="GET" class="d-flex flex-column gap-3">
                        <div class="input-group input-group-lg">
                            <input type="text" name="q" class="form-control rounded-start-lg" 
                                   placeholder="{{ __('Search...') }}" value="{{ $query }}" autofocus>
                            <select name="type" class="form-select rounded-end-lg">
                                <option value="all" {{ $type === 'all' ? 'selected' : '' }}>{{ __('All') }}</option>
                                <option value="jobs" {{ $type === 'jobs' ? 'selected' : '' }}>{{ __('Jobs') }}</option>
                                <option value="trainings" {{ $type === 'trainings' ? 'selected' : '' }}>{{ __('Trainings') }}</option>
                                <option value="mentors" {{ $type === 'mentors' ? 'selected' : '' }}>{{ __('Mentors') }}</option>
                                <option value="skills" {{ $type === 'skills' ? 'selected' : '' }}>{{ __('Skills') }}</option>
                            </select>
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search me-2"></i>{{ __('Search') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Results --}}
        @if($query)
            <div class="row g-4">
                {{-- Jobs Results --}}
                @if(isset($results['jobs']) && count($results['jobs']) > 0)
                    <div class="col-lg-8">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-briefcase-fill me-2 text-success"></i>{{ __('Jobs') }} ({{ count($results['jobs']) }})
                        </h5>
                        <div class="row g-3 mb-5">
                            @foreach($results['jobs'] as $job)
                                <div class="col-12">
                                    <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none">
                                        <div class="card border-0 rounded-3 shadow-sm h-100 hover-lift transition-all">
                                            <div class="card-body p-4">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1">{{ $job->title }}</h6>
                                                        <p class="text-muted small mb-0">{{ $job->company }}</p>
                                                    </div>
                                                    <span class="badge bg-success">{{ __('Job') }}</span>
                                                </div>
                                                <p class="text-muted small">
                                                    <i class="bi bi-person me-1"></i>{{ $job->mentor->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Trainings Results --}}
                @if(isset($results['trainings']) && $results['trainings']->count() > 0)
                    <div class="col-lg-8">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-mortarboard-fill me-2 text-info"></i>{{ __('Trainings') }} ({{ $results['trainings']->count() }})
                        </h5>
                        <div class="row g-3 mb-5">
                            @foreach($results['trainings'] as $training)
                                <div class="col-12">
                                    <a href="{{ route('trainings.show', $training) }}" class="text-decoration-none">
                                        <div class="card border-0 rounded-3 shadow-sm h-100 hover-lift transition-all">
                                            <div class="card-body p-4">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1">{{ $training->title }}</h6>
                                                        <p class="text-muted small mb-0">{{ Str::limit($training->description, 100) }}</p>
                                                    </div>
                                                    <span class="badge bg-info">{{ __('Training') }}</span>
                                                </div>
                                                <p class="text-muted small">
                                                    <i class="bi bi-person me-1"></i>{{ $training->mentor->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Mentors Results --}}
                @if(isset($results['mentors']) && $results['mentors']->count() > 0)
                    <div class="col-lg-8">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-person-badge-fill me-2 text-purple"></i>{{ __('Mentors') }} ({{ $results['mentors']->count() }})
                        </h5>
                        <div class="row g-3 mb-5">
                            @foreach($results['mentors'] as $mentor)
                                <div class="col-12">
                                    <a href="{{ route('users.show', $mentor) }}" class="text-decoration-none">
                                        <div class="card border-0 rounded-3 shadow-sm h-100 hover-lift transition-all">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=0D6EFD&color=fff&size=50"
                                                        class="rounded-circle" alt="{{ $mentor->name }}">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1">{{ $mentor->name }}</h6>
                                                        <p class="text-muted small mb-0">{{ $mentor->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- No Results --}}
                @if((!isset($results['jobs']) || count($results['jobs']) === 0) &&
                    (!isset($results['trainings']) || $results['trainings']->count() === 0) &&
                    (!isset($results['mentors']) || $results['mentors']->count() === 0))
                    <div class="col-lg-8 mx-auto">
                        <div class="card border-0 rounded-4 shadow-sm p-5 text-center">
                            <div class="mb-4">
                                <i class="bi bi-search" style="font-size: 3rem; color: #d3d3d3;"></i>
                            </div>
                            <h5 class="fw-bold text-muted mb-2">{{ __('No results found') }}</h5>
                            <p class="text-muted small">{{ __('Try searching with different keywords') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 rounded-4 shadow-sm p-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-search" style="font-size: 4rem; color: #d3d3d3;"></i>
                        </div>
                        <h5 class="fw-bold text-muted mb-2">{{ __('Start searching') }}</h5>
                        <p class="text-muted small">{{ __('Enter keywords to find jobs, trainings, mentors, and skills') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
@endsection
