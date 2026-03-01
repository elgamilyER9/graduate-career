@extends('layouts.app')

@section('content')
    <div class="container py-5 mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 animate__animated animate__fadeIn">
                <div class="text-center mb-5">
                    <div class="brand-logo mx-auto mb-3" style="width: 60px; height: 60px;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7V17L12 22L22 17V7L12 2Z" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 22V12" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M22 7L12 12L2 7" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h2 class="fw-bold text-dark">{{ __('Join as') }} <span
                            class="text-primary">{{ __(request('role', 'Member')) }}</span></h2>
                    <p class="text-muted small">{{ __('Start your professional career journey today.') }}</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden p-4 p-md-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="{{ request('role', 'user') }}">

                        <div class="row g-4 mb-4">
                            <div class="col-12">
                                <label for="name"
                                    class="form-label fw-bold text-muted small mb-1">{{ __('FULL NAME') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="bi bi-person text-muted"></i></span>
                                    <input id="name" type="text"
                                        class="form-control bg-light border-0 py-2 @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="John Doe">
                                </div>
                                @error('name')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="email"
                                    class="form-label fw-bold text-muted small mb-1">{{ __('EMAIL ADDRESS') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input id="email" type="email"
                                        class="form-control bg-light border-0 py-2 @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="john@example.com">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="phone"
                                    class="form-label fw-bold text-muted small mb-1">{{ __('PHONE NUMBER') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="bi bi-telephone text-muted"></i></span>
                                    <input id="phone" type="text"
                                        class="form-control bg-light border-0 py-2 @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" placeholder="01xxxxxxxxx">
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="career_path_id"
                                    class="form-label fw-bold text-muted small mb-1">{{ __('CAREER PATH / EXPERTISE') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="bi bi-signpost-split text-muted"></i></span>
                                    <select name="career_path_id" id="career_path_id"
                                        class="form-select bg-light border-0 @error('career_path_id') is-invalid @enderror">
                                        <option value="">{{ __('Select Career Path') }}</option>
                                        @foreach ($careerPaths as $path)
                                            <option value="{{ $path->id }}" {{ old('career_path_id') == $path->id ? 'selected' : '' }}>{{ $path->name }}
                                            </option>
                                        @endforeach
                                        <option value="other" {{ old('career_path_id') == 'other' ? 'selected' : '' }}>
                                            {{ __('Other...') }}
                                        </option>
                                    </select>
                                </div>
                                <div id="other_career_path_container"
                                    class="mt-2 {{ old('career_path_id') == 'other' ? '' : 'd-none' }}">
                                    <input type="text" name="other_career_path" id="other_career_path"
                                        class="form-control bg-light border-0 py-2 @error('other_career_path') is-invalid @enderror"
                                        placeholder="{{ __('Enter Specialty/Field Name') }}"
                                        value="{{ old('other_career_path') }}">
                                    @error('other_career_path')
                                        <span class="invalid-feedback d-block mt-1"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                @error('career_path_id')
                                    <span class="invalid-feedback d-block mt-2"
                                        role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            @if (request('role') === 'user' || !request('role'))
                                <div class="col-12">
                                    <label for="university_id"
                                        class="form-label fw-bold text-muted small mb-1">{{ __('UNIVERSITY') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i
                                                class="bi bi-building text-muted"></i></span>
                                        <select name="university_id" id="university_id"
                                            class="form-select bg-light border-0 @error('university_id') is-invalid @enderror">
                                            <option value="">{{ __('Select University') }}</option>
                                            @foreach ($universities as $university)
                                                <option value="{{ $university->id }}" {{ old('university_id') == $university->id ? 'selected' : '' }}>
                                                    {{ $university->name }}
                                                </option>
                                            @endforeach
                                            <option value="other" {{ old('university_id') == 'other' ? 'selected' : '' }}>
                                                {{ __('Other...') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div id="other_university_container"
                                        class="mt-2 {{ old('university_id') == 'other' ? '' : 'd-none' }}">
                                        <input type="text" name="other_university" id="other_university"
                                            class="form-control bg-light border-0 py-2 @error('other_university') is-invalid @enderror"
                                            placeholder="{{ __('Enter University Name') }}"
                                            value="{{ old('other_university') }}">
                                        @error('other_university')
                                            <span class="invalid-feedback d-block mt-1"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    @error('university_id')
                                        <span class="invalid-feedback d-block mt-2"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="faculty_id"
                                        class="form-label fw-bold text-muted small mb-1">{{ __('FACULTY') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i
                                                class="bi bi-book text-muted"></i></span>
                                        <select name="faculty_id" id="faculty_id"
                                            class="form-select bg-light border-0 @error('faculty_id') is-invalid @enderror">
                                            <option value="">{{ __('Select Faculty') }}</option>
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}" data-university="{{ $faculty->university_id }}"
                                                    {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}
                                                </option>
                                            @endforeach
                                            <option value="other" {{ old('faculty_id') == 'other' ? 'selected' : '' }}>
                                                {{ __('Other...') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div id="other_faculty_container"
                                        class="mt-2 {{ old('faculty_id') == 'other' ? '' : 'd-none' }}">
                                        <input type="text" name="other_faculty" id="other_faculty"
                                            class="form-control bg-light border-0 py-2 @error('other_faculty') is-invalid @enderror"
                                            placeholder="{{ __('Enter Faculty Name') }}" value="{{ old('other_faculty') }}">
                                        @error('other_faculty')
                                            <span class="invalid-feedback d-block mt-1"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    @error('faculty_id')
                                        <span class="invalid-feedback d-block mt-2"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-12">
                                <label for="linkedin_url"
                                    class="form-label fw-bold text-muted small mb-1">{{ __('LINKEDIN URL') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="bi bi-linkedin text-muted"></i></span>
                                    <input id="linkedin_url" type="text"
                                        class="form-control bg-light border-0 py-2 @error('linkedin_url') is-invalid @enderror"
                                        name="linkedin_url" value="{{ old('linkedin_url') }}"
                                        placeholder="https://linkedin.com/in/username">
                                </div>
                                @error('linkedin_url')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            @if (request('role') === 'mentor')
                                <div class="col-md-6">
                                    <label for="job_title"
                                        class="form-label fw-bold text-muted small mb-1">{{ __('JOB TITLE') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i
                                                class="bi bi-briefcase text-muted"></i></span>
                                        <input id="job_title" type="text"
                                            class="form-control bg-light border-0 py-2 @error('job_title') is-invalid @enderror"
                                            name="job_title" value="{{ old('job_title') }}" placeholder="Senior Web Developer">
                                    </div>
                                    @error('job_title')
                                        <span class="invalid-feedback d-block mt-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="company"
                                        class="form-label fw-bold text-muted small mb-1">{{ __('COMPANY') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i
                                                class="bi bi-building-fill text-muted"></i></span>
                                        <input id="company" type="text"
                                            class="form-control bg-light border-0 py-2 @error('company') is-invalid @enderror"
                                            name="company" value="{{ old('company') }}" placeholder="Google, Freelance, etc.">
                                    </div>
                                    @error('company')
                                        <span class="invalid-feedback d-block mt-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="years_experience"
                                        class="form-label fw-bold text-muted small mb-1">{{ __('YEARS OF EXPERIENCE') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i
                                                class="bi bi-clock-history text-muted"></i></span>
                                        <input id="years_experience" type="number"
                                            class="form-control bg-light border-0 py-2 @error('years_experience') is-invalid @enderror"
                                            name="years_experience" value="{{ old('years_experience') }}" placeholder="5">
                                    </div>
                                    @error('years_experience')
                                        <span class="invalid-feedback d-block mt-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="col-12">
                                    <label for="bio"
                                        class="form-label fw-bold text-muted small mb-1">{{ __('BIO / SUMMARY') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i
                                                class="bi bi-info-circle text-muted"></i></span>
                                        <textarea name="bio" id="bio"
                                            class="form-control bg-light border-0 @error('bio') is-invalid @enderror"
                                            placeholder="{{ __('Tell us about your professional background...') }}">{{ old('bio') }}</textarea>
                                    </div>
                                    @error('bio')
                                        <span class="invalid-feedback d-block mt-2"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-md-6">
                                <label for="password"
                                    class="form-label fw-bold text-muted small mb-1">{{ __('PASSWORD') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="bi bi-lock text-muted"></i></span>
                                    <input id="password" type="password"
                                        class="form-control bg-light border-0 py-2 @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password" placeholder="••••••••">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block mt-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm"
                                    class="form-label fw-bold text-muted small mb-1">{{ __('CONFIRM PASSWORD') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="bi bi-shield-lock text-muted"></i></span>
                                    <input id="password-confirm" type="password" class="form-control bg-light border-0 py-2"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit"
                                class="btn btn-primary rounded-pill py-2 fw-bold animate__animated animate__pulse animate__infinite animate__slower">
                                {{ __('Create Account') }}
                            </button>


                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted small mb-0">{{ __('Already have an account?') }}
                                <a href="{{ route('login') }}"
                                    class="text-primary fw-bold text-decoration-none">{{ __('Login Here') }}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const universitySelect = document.getElementById('university_id');
            const facultySelect = document.getElementById('faculty_id');
            const careerPathSelect = document.getElementById('career_path_id');

            function toggleOther(selectElement, containerId) {
                const container = document.getElementById(containerId);
                if (container) {
                    if (selectElement.value === 'other') {
                        container.classList.remove('d-none');
                    } else {
                        container.classList.add('d-none');
                    }
                }
            }

            if (universitySelect) {
                universitySelect.addEventListener('change', function () {
                    toggleOther(this, 'other_university_container');
                });
            }

            if (facultySelect) {
                facultySelect.addEventListener('change', function () {
                    toggleOther(this, 'other_faculty_container');
                });
            }

            if (careerPathSelect) {
                careerPathSelect.addEventListener('change', function () {
                    toggleOther(this, 'other_career_path_container');
                });
            }

            if (universitySelect && facultySelect) {
                const allFaculties = Array.from(facultySelect.options).slice(1); // Exclude "Select Faculty"

                universitySelect.addEventListener('change', function () {
                    const selectedUniversityId = this.value;

                    // Clear and reset faculty select
                    facultySelect.innerHTML = '<option value="">{{ __("Select Faculty") }}</option>';

                    if (selectedUniversityId) {
                        // Filter and add relevant faculties
                        const filteredFaculties = allFaculties.filter(option => {
                            // This assumes you might need a data attribute or we just filter by university_id if available
                            // But since we are doing it on client-side, we need the university_id on the option
                            return option.getAttribute('data-university') === selectedUniversityId;
                        });

                        filteredFaculties.forEach(option => facultySelect.appendChild(option.cloneNode(true)));
                    } else {
                        // If no university selected, show nothing or all? User probably wants choice.
                    }
                });
            }
        });
    </script>

    <style>
        .brand-logo {
            background: linear-gradient(135deg, #0D6EFD 0%, #00d2ff 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.3);
        }

        .form-control:focus {
            background-color: #fff !important;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            border: 1px solid #0D6EFD !important;
        }

        .input-group-text {
            border-radius: 0.5rem 0 0 0.5rem;
        }

        .form-control {
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .form-select {
            border-radius: 0 0.5rem 0.5rem 0;
            border: none;
            padding: 0.5rem 1rem;
        }

        .form-select:focus {
            background-color: #fff !important;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            border: 1px solid #0D6EFD !important;
        }

        [dir="rtl"] .input-group-text {
            border-radius: 0 0.5rem 0.5rem 0;
        }

        [dir="rtl"] .form-control {
            border-radius: 0.5rem 0 0 0.5rem;
        }

        [dir="rtl"] .form-select {
            border-radius: 0.5rem 0 0 0.5rem;
            background-position: left 0.75rem center;
        }
    </style>
@endsection