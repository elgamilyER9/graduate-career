@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ $careerPath ? route('career_paths.show', $careerPath) : '#' }}" class="btn btn-light rounded-circle p-2 me-3 shadow-sm">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h2 class="fw-bold text-dark mb-0">Edit Career Path</h2>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form action="{{ $careerPath ? route('career_paths.update', $careerPath) : '#' }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-1">PATH NAME</label>
                                <input type="text" name="name"
                                    class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                    value="{{ old('name', $careerPath->name ?? '') }}" placeholder="e.g. Full Stack Development" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-1">DESCRIPTION</label>
                                <textarea name="description"
                                    class="form-control rounded-3 @error('description') is-invalid @enderror" rows="5"
                                    placeholder="Provide a brief description of this career path">{{ old('description', $careerPath->description) }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 text-end mt-5">
                                <a href="{{ $careerPath ? route('career_paths.show', $careerPath) : '#' }}" class="btn btn-secondary btn-lg rounded-pill px-5 fw-bold shadow-sm me-2">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-sm">
                                    Update Career Path
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
