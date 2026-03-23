@extends('layouts.app')

@section('content')
<div class="career-auth-container py-5">
    <div class="career-bg-glow"></div>
    
    <div class="container container-auth position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <!-- Header -->
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <div class="auth-logo-badge mb-3 mx-auto">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h1 class="logo-text h3 mb-1">graduate<span> career</span></h1>
                    <div class="d-flex align-items-center justify-content-center gap-2 mt-2">
                        <span class="badge rounded-pill bg-light text-primary border border-primary-soft px-3 py-2">
                            <i class="bi bi-briefcase-fill me-1"></i> {{ __("Registering as") }} {{ __(request('role', 'Member')) }}
                        </span>
                    </div>
                </div>

                <!-- Modern Card -->
                <div class="modern-card animate__animated animate__zoomIn p-4 p-md-5">
                    <div class="auth-card-header mb-5 text-center text-md-start">
                        <h2 class="h4 fw-bold mb-2">{{ __('Career Application Form') }}</h2>
                        <p class="text-muted small">{{ __('Please provide your professional details to set up your account and start discovering opportunities.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="career-form">
                        @csrf
                        <input type="hidden" name="role" value="{{ request('role', 'user') }}">

                        <!-- SECTION: Personal Profile -->
                        <div class="form-section-header mb-4 mt-2">
                            <span class="section-number">01</span>
                            <span class="section-title text-uppercase">{{ __('Personal Profile') }}</span>
                            <hr class="flex-grow-1 ms-3">
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="career-label">{{ __('Full Professional Name') }}</label>
                                <div class="career-input-wrapper @error('name') has-error @enderror">
                                    <span class="input-icon"><i class="bi bi-person"></i></span>
                                    <input type="text" name="name" class="career-control" 
                                           placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                                </div>
                                @error('name') <div class="career-error-msg mt-2"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="career-label">{{ __('Primary Email Address') }}</label>
                                <div class="career-input-wrapper @error('email') has-error @enderror">
                                    <span class="input-icon"><i class="bi bi-envelope-at"></i></span>
                                    <input type="email" name="email" class="career-control" 
                                           placeholder="john@example.com" value="{{ old('email') }}" required>
                                </div>
                                @error('email') <div class="career-error-msg mt-2"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="career-label">{{ __('Contact Phone') }}</label>
                                <div class="career-input-wrapper @error('phone') has-error @enderror">
                                    <span class="input-icon"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="phone" class="career-control" 
                                           placeholder="01xxxxxxxxx" value="{{ old('phone') }}">
                                </div>
                                @error('phone') <div class="career-error-msg mt-2"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="career-label">{{ __('LinkedIn Profile URL') }}</label>
                                <div class="career-input-wrapper @error('linkedin_url') has-error @enderror">
                                    <span class="input-icon"><i class="bi bi-linkedin"></i></span>
                                    <input type="text" name="linkedin_url" class="career-control" 
                                           placeholder="linkedin.com/in/username" value="{{ old('linkedin_url') }}">
                                </div>
                                @error('linkedin_url') <div class="career-error-msg mt-2"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- SECTION: Professional Background -->
                        <div class="form-section-header mb-4">
                            <span class="section-number">02</span>
                            <span class="section-title text-uppercase">{{ __('Professional Background') }}</span>
                            <hr class="flex-grow-1 ms-3">
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="career-label">{{ __('Core Specialty / Industry') }}</label>
                                <div class="career-input-wrapper @error('career_path_id') has-error @enderror">
                                    <span class="input-icon"><i class="bi bi-layers"></i></span>
                                    <select name="career_path_id" id="career_path_id" class="career-select">
                                        <option value="">{{ __('Select Your Path') }}</option>
                                        @foreach ($careerPaths as $path)
                                            <option value="{{ $path->id }}" {{ old('career_path_id') == $path->id ? 'selected' : '' }}>{{ $path->name }}</option>
                                        @endforeach
                                        <option value="other" {{ old('career_path_id') == 'other' ? 'selected' : '' }}>{{ __('Other Specialization...') }}</option>
                                    </select>
                                </div>
                                <div id="other_career_path_container" class="mt-2 {{ old('career_path_id') == 'other' ? '' : 'd-none' }}">
                                    <input type="text" name="other_career_path" class="career-control mt-2 border-bottom-only" placeholder="{{ __('Please specify...') }}" value="{{ old('other_career_path') }}">
                                </div>
                                @error('career_path_id') <div class="career-error-msg mt-2"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div> @enderror
                            </div>

                            @if (request('role', 'user') === 'user')
                                <div class="col-md-6">
                                    <label class="career-label">{{ __('Educational Institution') }}</label>
                                    <div class="career-input-wrapper @error('university_id') has-error @enderror">
                                        <span class="input-icon"><i class="bi bi-bank"></i></span>
                                        <select name="university_id" id="university_id" class="career-select">
                                            <option value="">{{ __('Select University') }}</option>
                                            @foreach ($universities as $university)
                                                <option value="{{ $university->id }}" {{ old('university_id') == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                                            @endforeach
                                            <option value="other" {{ old('university_id') == 'other' ? 'selected' : '' }}>{{ __('Other Institution...') }}</option>
                                        </select>
                                    </div>
                                    <div id="other_university_container" class="mt-2 {{ old('university_id') == 'other' ? '' : 'd-none' }}">
                                        <input type="text" name="other_university" class="career-control mt-2 border-bottom-only" placeholder="{{ __('Institution name...') }}" value="{{ old('other_university') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="career-label">{{ __('Faculty / Major') }}</label>
                                    <div class="career-input-wrapper @error('faculty_id') has-error @enderror">
                                        <span class="input-icon"><i class="bi bi-journal-check"></i></span>
                                        <select name="faculty_id" id="faculty_id" class="career-select">
                                            <option value="">{{ __('Select Faculty') }}</option>
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}" data-university="{{ $faculty->university_id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                            @endforeach
                                            <option value="other" {{ old('faculty_id') == 'other' ? 'selected' : '' }}>{{ __('Other Major...') }}</option>
                                        </select>
                                    </div>
                                    <div id="other_faculty_container" class="mt-2 {{ old('faculty_id') == 'other' ? '' : 'd-none' }}">
                                        <input type="text" name="other_faculty" class="career-control mt-2 border-bottom-only" placeholder="{{ __('Major name...') }}" value="{{ old('other_faculty') }}">
                                    </div>
                                </div>
                            @endif

                            @if (request('role') === 'mentor')
                                <div class="col-md-6">
                                    <label class="career-label">{{ __('Current Job Title') }}</label>
                                    <div class="career-input-wrapper @error('job_title') has-error @enderror">
                                        <span class="input-icon"><i class="bi bi-briefcase"></i></span>
                                        <input type="text" name="job_title" class="career-control" 
                                               placeholder="Senior Engineer" value="{{ old('job_title') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="career-label">{{ __('Years of Expertise') }}</label>
                                    <div class="career-input-wrapper @error('years_experience') has-error @enderror">
                                        <span class="input-icon"><i class="bi bi-clock-history"></i></span>
                                        <input type="number" name="years_experience" class="career-control" 
                                               placeholder="8" value="{{ old('years_experience') }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="career-label">{{ __('Professional Bio & Focus Area') }}</label>
                                    <div class="career-input-wrapper @error('bio') has-error @enderror px-2">
                                        <textarea name="bio" class="career-control px-3" rows="3" 
                                                  placeholder="{{ __('Highlight your professional background and how you can help others...') }}">{{ old('bio') }}</textarea>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- SECTION: Account Security -->
                        <div class="form-section-header mb-4">
                            <span class="section-number">03</span>
                            <span class="section-title text-uppercase">{{ __('Account Security') }}</span>
                            <hr class="flex-grow-1 ms-3">
                        </div>

                        <div class="row g-4 px-md-1">
                            <div class="col-md-6">
                                <label class="career-label">{{ __('Account Password') }}</label>
                                <div class="career-input-wrapper @error('password') has-error @enderror">
                                    <span class="input-icon"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" name="password" class="career-control" 
                                           placeholder="••••••••" required>
                                </div>
                                @error('password') <div class="career-error-msg mt-2"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="career-label">{{ __('Confirm Security Key') }}</label>
                                <div class="career-input-wrapper">
                                    <span class="input-icon"><i class="bi bi-check2-square"></i></span>
                                    <input type="password" name="password_confirmation" class="career-control" 
                                           placeholder="••••••••" required>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="mt-5 pt-4 text-center">
                            <div class="d-grid col-lg-7 col-md-10 mx-auto">
                                <button type="submit" class="btn-career-primary py-3 mb-4">
                                    <span class="h5 mb-0 fw-bold">{{ __('Complete Career Profile') }}</span>
                                    <i class="bi bi-arrow-right ms-2 fs-4"></i>
                                </button>
                            </div>
                            <p class="text-muted">
                                {{ __('Already registered?') }}
                                <a href="{{ route('login') }}" class="career-link-bold ms-1">{{ __('Sign In Here') }}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selects = ['university_id', 'faculty_id', 'career_path_id'];
        selects.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('change', function() {
                    const container = document.getElementById('other_' + id + '_container');
                    if (container) {
                        if (this.value === 'other') container.classList.remove('d-none');
                        else container.classList.add('d-none');
                    }
                });
            }
        });

        // University Faculty Sync
        const universitySelect = document.getElementById('university_id');
        const facultySelect = document.getElementById('faculty_id');
        if (universitySelect && facultySelect) {
            const allFaculties = Array.from(facultySelect.options).filter(o => o.value && o.value !== 'other');
            universitySelect.addEventListener('change', function() {
                const uId = this.value;
                facultySelect.innerHTML = '<option value="">{{ __("Select Faculty") }}</option>';
                if (uId && uId !== 'other') {
                    allFaculties.filter(o => o.getAttribute('data-university') === uId)
                                .forEach(o => facultySelect.appendChild(o.cloneNode(true)));
                    const other = document.createElement('option');
                    other.value = 'other'; other.text = '{{ __("Other...") }}';
                    facultySelect.appendChild(other);
                }
            });
        }
    });
</script>

<style>
/* PROFESSIONAL CAREER HUB STYLES */
:root {
    --career-primary: #1E40AF;
    --career-secondary: #3B82F6;
    --career-accent: #4F46E2;
    --career-bg: #F8FAFC;
    --career-card-border: #E2E8F0;
    --career-text-dark: #0F172A;
    --career-text-muted: #64748B;
    --career-link: #2563EB;
}

.career-auth-container {
    background-color: var(--career-bg);
    position: relative;
    overflow-x: hidden;
    min-height: 100vh;
    font-family: 'Outfit', 'Cairo', sans-serif;
}

.career-bg-glow {
    position: absolute;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.05) 0%, transparent 70%);
    top: -200px;
    left: -200px;
    z-index: 0;
}

.auth-logo-badge {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--career-primary), var(--career-accent));
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    box-shadow: 0 10px 20px rgba(30, 64, 175, 0.2);
}

.logo-text { font-weight: 850; color: var(--career-text-dark); letter-spacing: -1px; }
.logo-text span { color: var(--career-primary); }

.modern-card {
    background: white;
    border: 1px solid var(--career-card-border);
    border-radius: 28px;
    box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.06);
    position: relative;
    z-index: 10;
}

/* Section Styling */
.form-section-header { display: flex; align-items: center; }
.section-number {
    width: 38px;
    height: 38px;
    background: var(--career-primary);
    color: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    margin-inline-end: 15px;
    font-size: 0.9rem;
}
.section-title { font-weight: 800; color: var(--career-text-dark); letter-spacing: 1px; font-size: 0.85rem; }

/* Input Styles */
.career-label {
    display: block;
    font-size: 0.82rem;
    font-weight: 700;
    color: #475569;
    margin-bottom: 0.5rem;
}

.career-input-wrapper {
    background: #FFFFFF;
    border: 1.5px solid #E2E8F0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    transition: all 0.2s;
}

.career-input-wrapper:focus-within {
    border-color: var(--career-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.input-icon { padding: 0 14px; color: #94A3B8; font-size: 1.05rem; }

.career-control {
    border: none !important;
    background: transparent !important;
    padding: 12px 10px 12px 0;
    width: 100%;
    font-weight: 500;
    font-size: 0.95rem;
    color: var(--career-text-dark);
}
.career-control:focus { outline: none; }

.career-select {
    border: none !important;
    background: transparent !important;
    padding: 12px 10px 12px 0;
    width: 100%;
    font-weight: 500;
    color: var(--career-text-dark);
    font-size: 0.95rem;
    cursor: pointer;
}
.career-select:focus { outline: none; }

.border-bottom-only {
    border-radius: 0 !important;
    border: none !important;
    border-bottom: 2px solid var(--career-primary) !important;
    padding-left: 5px !important;
}

/* Button */
.btn-career-primary {
    background: var(--career-primary);
    background: linear-gradient(135deg, var(--career-primary), var(--career-secondary));
    color: white;
    border: none;
    border-radius: 16px;
    transition: all 0.3s;
    box-shadow: 0 10px 25px rgba(30, 64, 175, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-career-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(30, 64, 175, 0.3);
}

.career-link-bold { color: var(--career-link); font-weight: 800; text-decoration: none; }
.career-link-bold:hover { text-decoration: underline; }

.career-error-msg { color: #EF4444; font-size: 0.75rem; font-weight: 700; }

/* RTL */
[dir="rtl"] .career-control, [dir="rtl"] .career-select { padding: 12px 0 12px 10px; }
[dir="rtl"] .section-number { margin-inline-end: 0; margin-inline-start: 15px; }

@media (max-width: 768px) {
    .modern-card { border-radius: 0; border: none; padding: 2.5rem 1.5rem; }
    .career-auth-container { background: white; padding-top: 0 !important; }
}
</style>
@endsection