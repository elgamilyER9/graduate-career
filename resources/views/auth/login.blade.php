@extends('layouts.app')

@section('content')
<div class="career-auth-container py-5">
    <div class="career-bg-glow"></div>
    
    <div class="container container-auth position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 col-12">
                <!-- Header / Branding -->
                <div class="text-center mb-4 animate__animated animate__fadeInDown">
                    <div class="auth-logo-badge mb-3 mx-auto">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h1 class="logo-text h3 mb-1">graduate<span> career</span></h1>
                    <p class="text-muted small fw-bold text-uppercase letter-spacing-1">{{ __('Professional Portal') }}</p>
                </div>

                <!-- Modern Card -->
                <div class="modern-card animate__animated animate__zoomIn">
                    <div class="auth-card-header mb-4">
                        <h2 class="h4 fw-bold mb-2">{{ __('Welcome Back') }}</h2>
                        <p class="text-muted small">{{ __('Log in to manage your professional journey and discover new opportunities.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="career-form">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label class="career-label">{{ __('Email Address') }}</label>
                            <div class="career-input-wrapper @error('email') has-error @enderror">
                                <span class="input-icon"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="career-control" 
                                       placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                                <div class="career-error-msg mt-2 animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="career-label mb-0">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="career-link-small" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="career-input-wrapper @error('password') has-error @enderror">
                                <span class="input-icon"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" class="career-control" 
                                       placeholder="••••••••" required>
                                <button type="button" class="btn-toggle-pass" onclick="togglePassword(this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="career-error-msg mt-2 animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-5 d-flex align-items-center">
                            <div class="career-checkbox-group">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">{{ __('Keep me signed in on this device') }}</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn-career-primary">
                                <span>{{ __('Secure Login') }}</span>
                                <i class="bi bi-arrow-right-short ms-2"></i>
                            </button>
                        </div>

                        <!-- Alternative Link -->
                        @if (Route::has('register'))
                            <div class="text-center pt-2">
                                <span class="text-muted small">{{ __("New to the platform?") }}</span>
                                <a href="{{ route('register') }}" class="career-link-bold ms-2">
                                    {{ __('Create Professional Account') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Trust Footer -->
                <div class="mt-5 text-center text-muted small animate__animated animate__fadeInUp animate__delay-1s">
                    <p><i class="bi bi-lock-fill me-1"></i> {{ __('Your professional data is encrypted and secure.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(btn) {
        const input = btn.previousElementSibling;
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
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
    background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, transparent 70%);
    top: -200px;
    right: -200px;
    z-index: 0;
}

.auth-logo-badge {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, var(--career-primary), var(--career-accent));
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    box-shadow: 0 10px 25px rgba(30, 64, 175, 0.25);
}

.logo-text { font-weight: 850; color: var(--career-text-dark); letter-spacing: -1px; }
.logo-text span { color: var(--career-primary); }

.letter-spacing-1 { letter-spacing: 1px; }

.modern-card {
    background: white;
    border: 1px solid var(--career-card-border);
    border-radius: 24px;
    padding: 3rem 2.5rem;
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
    position: relative;
    z-index: 10;
}

.auth-card-header h2 { color: var(--career-text-dark); letter-spacing: -0.5px; }

/* Input Styles */
.career-label {
    display: block;
    font-size: 0.8rem;
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
    border-radius: 14px;
    padding: 1px;
    transition: all 0.3s ease;
}

.career-input-wrapper:focus-within {
    border-color: var(--career-primary);
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
}

.career-input-wrapper.has-error { border-color: #EF4444; }

.input-icon { padding: 0 16px; color: var(--career-text-muted); font-size: 1.1rem; }

.career-control {
    border: none !important;
    background: transparent !important;
    padding: 12px 0;
    width: 100%;
    font-weight: 500;
    color: var(--career-text-dark);
    font-size: 0.95rem;
}

.career-control:focus { outline: none; }

.btn-toggle-pass {
    border: none;
    background: none;
    padding: 0 16px;
    color: var(--career-text-muted);
    transition: color 0.2s;
}

.btn-toggle-pass:hover { color: var(--career-primary); }

/* Checkbox */
.career-checkbox-group {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    user-select: none;
}

.career-checkbox-group input {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--career-primary);
}

.career-checkbox-group label {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--career-text-muted);
    cursor: pointer;
}

/* Links */
.career-link-small { font-size: 0.8rem; font-weight: 700; color: var(--career-link); text-decoration: none; }
.career-link-bold { font-weight: 800; color: var(--career-link); text-decoration: none; }
.career-link-small:hover, .career-link-bold:hover { text-decoration: underline; }

/* Primary Button */
.btn-career-primary {
    background: linear-gradient(135deg, var(--career-primary), var(--career-secondary));
    color: white;
    border: none;
    padding: 16px;
    border-radius: 16px;
    font-weight: 700;
    font-size: 1.05rem;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 10px 25px rgba(30, 64, 175, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-career-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(30, 64, 175, 0.3);
}

.career-error-msg { color: #EF4444; font-size: 0.8rem; font-weight: 700; }

/* RTL Adjustments */
[dir="rtl"] .career-control { padding: 12px 0 12px 10px; }
[dir="rtl"] .auth-logo-badge { box-shadow: -5px 10px 25px rgba(30, 64, 175, 0.25); }

@media (max-width: 576px) {
    .modern-card { padding: 2.5rem 1.5rem; border-radius: 20px; }
}
</style>
@endsection