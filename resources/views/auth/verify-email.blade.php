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
                        <i class="bi bi-envelope-check-fill"></i>
                    </div>
                    <h1 class="logo-text h3 mb-1">graduate<span> career</span></h1>
                    <p class="text-muted small fw-bold text-uppercase letter-spacing-1">{{ __('Step 2: Verification') }}</p>
                </div>

                <!-- Modern Card -->
                <div class="modern-card animate__animated animate__zoomIn">
                    <div class="auth-card-header mb-5 text-center">
                        <h2 class="h4 fw-bold mb-3">{{ __('Verify Your Email') }}</h2>
                        <div class="career-status-indicator mx-auto mb-4">
                            <div class="pulse-ring"></div>
                            <i class="bi bi-send-check"></i>
                        </div>
                        <p class="text-muted small px-3">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
                        </p>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success border-0 rounded-4 mb-4 animate__animated animate__fadeIn" style="background: rgba(16, 185, 129, 0.1); color: #059669; font-weight: 600;">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <div class="d-flex flex-column gap-3">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn-career-primary w-100 py-3">
                                <span>{{ __('Resend Verification Email') }}</span>
                                <i class="bi bi-arrow-repeat ms-2"></i>
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}" class="text-center mt-2">
                            @csrf
                            <button type="submit" class="career-link-small bg-transparent border-0 p-0 text-decoration-underline">
                                {{ __('Sign Out and try later') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Assistance Footer -->
                <div class="mt-5 text-center text-muted small animate__animated animate__fadeInUp animate__delay-1s">
                    <p>{{ __("Didn't receive the email? Check your spam folder or contact professional support.") }}</p>
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
    left: -100px;
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
    padding: 3.5rem 2.5rem;
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
    position: relative;
    z-index: 10;
}

/* Status Indicator */
.career-status-indicator {
    width: 72px;
    height: 72px;
    background: var(--career-primary-soft, rgba(30, 64, 175, 0.05));
    color: var(--career-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    position: relative;
}

.pulse-ring {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 3px solid var(--career-primary);
    opacity: 0.2;
    animation: ringPulse 2s infinite ease-out;
}

@keyframes ringPulse {
    0% { transform: scale(0.95); opacity: 0.5; }
    100% { transform: scale(1.5); opacity: 0; }
}

/* Links */
.career-link-small { font-weight: 700; color: var(--career-text-muted); text-decoration: none; font-size: 0.9rem; transition: color 0.2s; }
.career-link-small:hover { color: var(--career-primary); }

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

@media (max-width: 576px) {
    .modern-card { padding: 2.5rem 1.5rem; border-radius: 20px; }
}
</style>
@endsection
