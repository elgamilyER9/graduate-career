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

                            {{-- Job Title --}}
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

                            {{-- Company + Career Path --}}
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

                            {{-- Location + Salary --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="bi bi-geo-alt me-1 text-success"></i>{{ __('LOCATION') }}
                                </label>
                                <input type="text" name="location"
                                    class="form-control form-control-lg rounded-3 @error('location') is-invalid @enderror"
                                    value="{{ old('location') }}" placeholder="{{ __('e.g. Cairo, Egypt') }}">
                                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="bi bi-cash-coin me-1 text-warning"></i>{{ __('SALARY RANGE') }}
                                </label>
                                <input type="text" name="salary_range"
                                    class="form-control form-control-lg rounded-3 @error('salary_range') is-invalid @enderror"
                                    value="{{ old('salary_range') }}" placeholder="{{ __('e.g. $3000 - $5000') }}">
                                @error('salary_range') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Job Type --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="bi bi-clock me-1 text-info"></i>{{ __('JOB TYPE') }}
                                </label>
                                <select name="type"
                                    class="form-select form-select-lg rounded-3 @error('type') is-invalid @enderror">
                                    <option value="">{{ __('Select Type') }}</option>
                                    <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>{{ __('Full-time') }}</option>
                                    <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>{{ __('Part-time') }}</option>
                                    <option value="remote" {{ old('type') == 'remote' ? 'selected' : '' }}>{{ __('Remote') }}</option>
                                    <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>{{ __('Internship') }}</option>
                                    <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>{{ __('Contract') }}</option>
                                </select>
                                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="bi bi-file-text me-1 text-primary"></i>{{ __('JOB DESCRIPTION') }}
                                </label>
                                <textarea name="description" rows="5"
                                    class="form-control form-control-lg rounded-3 @error('description') is-invalid @enderror"
                                    placeholder="{{ __('Describe the role, responsibilities, and requirements...') }}">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 me-2">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm">
                                    <i class="bi bi-plus-circle me-2"></i>{{ __('Create Job Listing') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection