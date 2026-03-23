@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('jobs.index') }}" class="btn btn-light rounded-circle p-2 me-3 shadow-sm">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div>
                        <h2 class="fw-bold text-dark mb-0">{{ __('Edit Job Listing') }}</h2>
                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>
                            {{ __('Published') }}:
                            <span id="publishedTime"
                                  data-ts="{{ $job->created_at->timestamp }}"
                                  class="fw-semibold text-primary"></span>
                            &mdash;
                            <span class="text-secondary">{{ $job->created_at->format('d M Y, H:i') }}</span>
                        </small>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form action="{{ route('jobs.update', $job) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">

                            {{-- Job Title --}}
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('JOB TITLE') }}</label>
                                <select name="title"
                                    class="form-select form-select-lg rounded-3 @error('title') is-invalid @enderror"
                                    required>
                                    <option value="">{{ __('Select Job Title') }}</option>
                                    @foreach($jobTitles as $title)
                                        <option value="{{ $title }}" {{ (old('title') ?? $job->title) == $title ? 'selected' : '' }}>{{ __($title) }}</option>
                                    @endforeach
                                </select>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Company + Career Path --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('COMPANY NAME') }}</label>
                                <input type="text" name="company"
                                    class="form-control form-control-lg rounded-3 @error('company') is-invalid @enderror"
                                    value="{{ old('company') ?? $job->company }}" placeholder="{{ __('e.g. Google') }}" required>
                                @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('CAREER PATH') }}</label>
                                <select name="career_path_id"
                                    class="form-select form-select-lg rounded-3 @error('career_path_id') is-invalid @enderror"
                                    required>
                                    <option value="">{{ __('Select Path') }}</option>
                                    @foreach($careerPaths as $path)
                                        <option value="{{ $path->id }}" {{ (old('career_path_id') ?? $job->career_path_id) == $path->id ? 'selected' : '' }}>{{ $path->name }}</option>
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
                                    value="{{ old('location') ?? $job->location }}" placeholder="{{ __('e.g. Cairo, Egypt') }}">
                                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="bi bi-cash-coin me-1 text-warning"></i>{{ __('SALARY RANGE') }}
                                </label>
                                <input type="text" name="salary_range"
                                    class="form-control form-control-lg rounded-3 @error('salary_range') is-invalid @enderror"
                                    value="{{ old('salary_range') ?? $job->salary_range }}" placeholder="{{ __('e.g. $3000 - $5000') }}">
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
                                    @foreach(['full-time' => 'Full-time', 'part-time' => 'Part-time', 'remote' => 'Remote', 'internship' => 'Internship', 'contract' => 'Contract'] as $val => $label)
                                        <option value="{{ $val }}" {{ (old('type') ?? $job->type) == $val ? 'selected' : '' }}>{{ __($label) }}</option>
                                    @endforeach
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
                                    placeholder="{{ __('Describe the role, responsibilities, and requirements...') }}">{{ old('description') ?? $job->description }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Buttons --}}
                            <div class="col-12 d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    {{ __('Last updated') }}: {{ $job->updated_at->diffForHumans() }}
                                </small>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                        {{ __('Cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm">
                                        <i class="bi bi-check2-circle me-2"></i>{{ __('Update Job') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Dynamic "time ago" — reads Unix timestamp from data-ts, updates every 30s --}}
    <script>
        (function () {
            const el = document.getElementById('publishedTime');
            if (!el) return;

            // Unix timestamp (seconds) → JS Date
            const published = new Date(parseInt(el.dataset.ts, 10) * 1000);

            function timeAgo(date) {
                const seconds = Math.floor((Date.now() - date) / 1000);
                if (seconds < 60)   return seconds + ' second' + (seconds !== 1 ? 's' : '') + ' ago';
                const minutes = Math.floor(seconds / 60);
                if (minutes < 60)   return minutes + ' minute' + (minutes !== 1 ? 's' : '') + ' ago';
                const hours = Math.floor(minutes / 60);
                if (hours < 24)     return hours + ' hour' + (hours !== 1 ? 's' : '') + ' ago';
                const days = Math.floor(hours / 24);
                if (days < 30)      return days + ' day' + (days !== 1 ? 's' : '') + ' ago';
                const months = Math.floor(days / 30);
                if (months < 12)    return months + ' month' + (months !== 1 ? 's' : '') + ' ago';
                const years = Math.floor(months / 12);
                return years + ' year' + (years !== 1 ? 's' : '') + ' ago';
            }

            function update() {
                el.textContent = timeAgo(published);
            }

            update();                    // Run immediately on page load
            setInterval(update, 30000);  // Refresh every 30 seconds
        })();
    </script>
@endsection