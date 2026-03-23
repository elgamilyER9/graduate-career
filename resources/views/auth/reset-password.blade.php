@extends('layouts.app')

@section('content')
<div class="career-auth-container py-5">
    <div class="career-bg-glow"></div>
    
    <div class="container container-auth position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 col-12">
                <!-- Header -->
                <div class="text-center mb-4 animate__animated animate__fadeInDown">
                    <div class="auth-logo-badge mb-3 mx-auto">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h1 class="logo-text h3 mb-1">graduate<span> career</span></h1>
                    <p class="text-muted small fw-bold text-uppercase letter-spacing-1">{{ __('Set New Password') }}</p>
                </div>

                <!-- Modern Card -->
                <div class="modern-card animate__animated animate__zoomIn">
                    <div class="auth-card-header mb-4">
                        <h2 class="h4 fw-bold mb-2">{{ __('Create New Password') }}</h2>
                        <p class="text-muted small">{{ __('Choose a strong password to ensure your professional account remains secure.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}" class="career-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Input (Disabled/Readonly ideally, but Laravel needs it) -->
                        <div class="mb-4">
                            <label class="career-label">{{ __('Email Address') }}</label>
                            <div class="career-input-wrapper @error('email') has-error @enderror">
                                <span class="input-icon"><i class="bi bi-envelope-at"></i></span>
                                <input type="email" name="email" class="career-control" 
                                       value="{{ old('email', $request->email) }}" required readonly>
                            </div>
                            @error('email') <div class="career-error-msg mt-2"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div> @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label class="career-label">{{ __('New Security Password') }}</label>
                            <div class="career-input-wrapper @error('password') has-error @enderror">
                                <span class="input-icon"><i class="bi bi-key-fill"></i></span>
                                <input type="password" name="password" class="career-control" 
                                       placeholder="••••••••" required autofocus>
                            </div>
                            @error('password') <div class="career-error-msg mt-2"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-5">
                            <label class="career-label">{{ __('Confirm New Password') }}</label>
                            <div class="career-input-wrapper">
                                <span class="input-icon"><i class="bi bi-check2-circle"></i></span>
                                <input type="password" name="password_confirmation" class="career-control" 
                                       placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn-career-primary py-3">
                                <span>{{ __('Update Password & Login') }}</span>
                                <i class="bi bi-arrow-right-short ms-2 fs-5"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
    overflow: hidden;
    min-height: calc(100vh - 150px);
    font-family: 'Outfit', 'Cairo', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
}

.career-bg-glow {
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.05) 0%, transparent 70%);
    top: -100px;
    right: -100px;
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
    border-radius: 24px;
    padding: 3rem 2.5rem;
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
    position: relative;
    z-index: 10;
}

/* Input Styles */
.career-label {
    display: block;
    font-size: 0.82rem;
    font-weight: 800;
    color: var(--career-text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.6rem;
}

.career-input-wrapper {
    display: flex;
    align-items: center;
    background: #FFFFFF;
    border: 1.5px solid #F1F5F9;
    border-radius: 12px;
    padding: 1px;
    transition: all 0.2s;
}

.career-input-wrapper:focus-within {
    border-color: var(--career-primary);
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
}

.input-icon { padding: 0 15px; color: #94A3B8; font-size: 1.1rem; }

.career-control {
    border: none !important;
    background: transparent !important;
    padding: 12px 0;
    width: 100%;
    font-weight: 500;
    font-size: 0.95rem;
    color: #0F172A;
}
.career-control:focus { outline: none; }

/* Primary Button */
.btn-career-primary {
    background: linear-gradient(135deg, var(--career-primary), var(--career-secondary));
    color: white;
    border: none;
    border-radius: 14px;
    font-weight: 700;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 8px 20px rgba(30, 64, 175, 0.15);
}

.btn-career-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(30, 64, 175, 0.25);
}

.career-error-msg { color: #EF4444; font-size: 0.8rem; font-weight: 700; }

/* RTL */
[dir="rtl"] .career-control { padding: 12px 0 12px 10px; }

@media (max-width: 576px) {
    .modern-card { padding: 2.5rem 1.5rem; border-radius: 20px; }
}
</style>
@endsection
