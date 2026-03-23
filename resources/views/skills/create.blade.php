@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('skills.index') }}" class="btn btn-light rounded-circle p-2 me-3 shadow-sm">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h2 class="fw-bold text-dark mb-0">Add New Skill</h2>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form action="{{ route('skills.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-1">SKILL NAME</label>
                                <input type="text" name="name"
                                    class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="e.g. Laravel" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-1">CAREER PATH</label>
                                <select name="career_path_id"
                                    class="form-select form-select-lg rounded-3 @error('career_path_id') is-invalid @enderror"
                                    required>
                                    <option value="">Select Path</option>
                                    @foreach($careerPaths as $path)
                                        <option value="{{ $path->id }}" {{ old('career_path_id') == $path->id ? 'selected' : '' }}>{{ $path->name }}</option>
                                    @endforeach
                                </select>
                                @error('career_path_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 text-end mt-5">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm">
                                    Create Skill
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection