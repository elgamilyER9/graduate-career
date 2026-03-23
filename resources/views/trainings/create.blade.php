@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('trainings.index') }}" class="btn btn-light rounded-circle p-2 me-3 shadow-sm">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h2 class="fw-bold text-dark mb-0">{{ __('Add New Training') }}</h2>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form action="{{ route('trainings.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-2">{{ __('TRAINING TITLE') }}</label>
                                <input type="text" name="title"
                                    class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}" placeholder="e.g. Advanced Laravel Development" required>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-2">{{ __('PROGRAM NAME') }}</label>
                                <input type="text" name="name"
                                    class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="e.g. Laravel Mastery">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-2">{{ __('PROVIDER') }}</label>
                                <input type="text" name="provider"
                                    class="form-control form-control-lg rounded-3 @error('provider') is-invalid @enderror"
                                    value="{{ old('provider') }}" placeholder="e.g. Coursera / Udemy">
                                @error('provider') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-2">{{ __('CAREER PATH') }}</label>
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

                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-2">{{ __('DESCRIPTION') }}</label>
                                <textarea name="description"
                                    class="form-control form-control-lg rounded-3 @error('description') is-invalid @enderror"
                                    rows="4" placeholder="{{ __('Brief description of the training program') }}">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 text-end mt-5">
                                <a href="{{ route('trainings.index') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold me-2">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm">
                                    {{ __('Create Training') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection