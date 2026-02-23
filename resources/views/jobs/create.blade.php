@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('jobs.index') }}" class="btn btn-light rounded-circle p-2 me-3 shadow-sm">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h2 class="fw-bold text-dark mb-0">{{ __('Post New Job') }}</h2>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form action="{{ route('jobs.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('JOB TITLE') }}</label>
                                <select name="title"
                                    class="form-select form-select-lg rounded-3 @error('title') is-invalid @enderror"
                                    required>
                                    <option value="">{{ __('Select Job Title') }}</option>
                                    @foreach($jobTitles as $title)
                                        <option value="{{ $title }}" {{ old('title') == $title ? 'selected' : '' }}>
                                            {{ __($title) }}</option>
                                    @endforeach
                                </select>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('COMPANY NAME') }}</label>
                                <input type="text" name="company"
                                    class="form-control form-control-lg rounded-3 @error('company') is-invalid @enderror"
                                    value="{{ old('company') }}" placeholder="{{ __('e.g. Google') }}" required>
                                @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('CAREER PATH') }}</label>
                                <select name="career_path_id"
                                    class="form-select form-select-lg rounded-3 @error('career_path_id') is-invalid @enderror"
                                    required>
                                    <option value="">{{ __('Select Path') }}</option>
                                    @foreach($careerPaths as $path)
                                        <option value="{{ $path->id }}" {{ old('career_path_id') == $path->id ? 'selected' : '' }}>{{ $path->name }}</option>
                                    @endforeach
                                </select>
                                @error('career_path_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 text-end mt-5">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm">
                                    {{ __('Create Job Listing') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection