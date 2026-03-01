@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">Career Paths</h2>
                <p class="text-muted mb-0">Define and manage career paths for students.</p>
            </div>
            <a href="{{ route('career_paths.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Add Career Path
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">
            @forelse($careerPaths as $path)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 transition-hover">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3">
                                    <i class="bi bi-signpost-split h4 mb-0"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-0 text-truncate">{{ $path->name }}</h5>
                            </div>
                            <p class="text-muted small mb-4 text-truncate-3">{{ $path->description }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <div class="small text-muted">
                                    <span class="badge bg-light text-dark me-2">{{ $path->jobs_count ?? $path->jobs->count() }}
                                        Jobs</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('career_paths.show', $path) }}"
                                        class="btn btn-light btn-sm rounded-3 p-2 text-primary border-0 shadow-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('career_paths.edit', $path) }}"
                                        class="btn btn-light btn-sm rounded-3 p-2 text-warning border-0 shadow-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('career_paths.destroy', $path) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-light btn-sm rounded-3 p-2 text-danger border-0 shadow-sm"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted small">No career paths found.</div>
            @endforelse
        </div>
    </div>

    <style>
        .text-truncate-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }
    </style>
@endsection