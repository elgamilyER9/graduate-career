@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('career_paths.index') }}" class="btn btn-light rounded-circle p-2 shadow-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold text-dark mb-1">{{ $careerPath->name ?? 'N/A' }}</h2>
                <p class="text-muted mb-0">View career path details and related information.</p>
            </div>
            @if(auth()->user()->role === 'admin')
                <div class="ms-auto">
                    <a href="{{ $careerPath ? route('career_paths.edit', $careerPath) : '#' }}" class="btn btn-warning rounded-3 px-4 py-2 fw-semibold shadow-sm">
                        <i class="bi bi-pencil me-2"></i> Edit
                    </a>
                    <form action="{{ $careerPath ? route('career_paths.destroy', $careerPath) : '#' }}" method="POST" class="d-inline ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-3 px-4 py-2 fw-semibold shadow-sm"
                            onclick="return confirm('Are you sure you want to delete this career path?')">
                            <i class="bi bi-trash me-2"></i> Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Career Path Overview -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h5 class="fw-bold text-dark mb-3">About This Path</h5>
            <p class="text-muted">{{ $careerPath->description ?? 'No description available.' }}</p>
        </div>

        <!-- Associated Jobs -->
        @if($careerPath->jobs && $careerPath->jobs->count() > 0)
        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-3">Associated Jobs ({{ $careerPath->jobs->count() }})</h4>
            <div class="row g-3">
                @foreach($careerPath->jobs as $job)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 transition-hover">
                            <div class="card-body p-4">
                                <h6 class="fw-bold text-dark mb-2">{{ $job->title }}</h6>
                                <p class="text-muted small mb-3">{{ Str::limit($job->description ?? 'N/A', 100) }}</p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-outline-primary rounded-3">
                                        View Job
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Associated Skills -->
        @if($careerPath->skills && $careerPath->skills->count() > 0)
        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-3">Required Skills ({{ $careerPath->skills->count() }})</h4>
            <div class="row g-3">
                @foreach($careerPath->skills as $skill)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 transition-hover">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 me-3">
                                        <i class="bi bi-star h5 mb-0"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0">{{ $skill->name }}</h6>
                                </div>
                                <p class="text-muted small mb-0">{{ $skill->description ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Associated Trainings -->
        @if($careerPath->trainings && $careerPath->trainings->count() > 0)
        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-3">Recommended Trainings ({{ $careerPath->trainings->count() }})</h4>
            <div class="row g-3">
                @foreach($careerPath->trainings as $training)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 transition-hover">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3 me-3">
                                        <i class="bi bi-book h5 mb-0"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0">{{ $training->name }}</h6>
                                </div>
                                <p class="text-muted small mb-2">{{ $training->description ?? 'N/A' }}</p>
                                <a href="{{ route('trainings.show', $training) }}" class="btn btn-sm btn-outline-info rounded-3">
                                    View Training
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if((!$careerPath->jobs || $careerPath->jobs->count() === 0) && 
            (!$careerPath->skills || $careerPath->skills->count() === 0) && 
            (!$careerPath->trainings || $careerPath->trainings->count() === 0))
            <div class="alert alert-info border-0 rounded-4 text-center py-4">
                <p class="mb-0">No associated jobs, skills, or trainings yet. Consider adding some to this career path.</p>
            </div>
        @endif
    </div>

    <style>
        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
            transition: all 0.3s ease;
        }
    </style>
@endsection
