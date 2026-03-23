@extends('layouts.app')

@section('content')
<div class="career-auth-container py-5">
    <div class="career-bg-glow"></div>
    
    <div class="row justify-content-center position-relative">
        <div class="col-xl-9 col-lg-11 col-12 text-center mb-5 animate__animated animate__fadeInDown">
            <h1 class="career-title display-4 fw-bold mb-3">
                {{ __('Find Your Place in the') }} <span class="text-primary-gradient">{{ __('Professional World') }}</span>
            </h1>
            <p class="career-subtitle lead text-muted mx-auto">
                {{ __('Whether you are starting your journey or looking to guide others, we have the right platform for you.') }}
            </p>
        </div>

        <div class="row g-4 justify-content-center px-lg-5">
            <!-- Student/Graduate Card -->
            <div class="col-md-5 col-12 animate__animated animate__fadeInLeft">
                <div class="modern-card career-card student-card h-100">
                    <div class="card-badge bg-primary-soft text-primary">{{ __('Talent') }}</div>
                    <div class="career-card-icon mb-4">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <h2 class="h3 fw-bold mb-3">{{ __("I'm a Student / Graduate") }}</h2>
                    <p class="text-muted mb-4 small">
                        {{ __('Accelerate your career by connecting with mentors and discovering real-world opportunities.') }}
                    </p>
                    <ul class="career-features mb-5">
                        <li><i class="bi bi-check-circle-fill"></i> {{ __('Discover career paths') }}</li>
                        <li><i class="bi bi-check-circle-fill"></i> {{ __('Learn new skills') }}</li>
                        <li><i class="bi bi-check-circle-fill"></i> {{ __('Find jobs & training') }}</li>
                    </ul>
                    <a href="{{ route('register', ['role' => 'user']) }}" class="btn-career-primary w-100">
                        <span>{{ __('Join as Talent') }}</span>
                        <i class="bi bi-arrow-right-short ms-2"></i>
                    </a>
                </div>
            </div>

            <!-- Mentor Card -->
            <div class="col-md-5 col-12 animate__animated animate__fadeInRight">
                <div class="modern-card career-card mentor-card h-100">
                    <div class="card-badge bg-success-soft text-success">{{ __('Expert') }}</div>
                    <div class="career-card-icon mentor-icon mb-4">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <h2 class="h3 fw-bold mb-3">{{ __("I'm a Professional Mentor") }}</h2>
                    <p class="text-muted mb-4 small">
                        {{ __('Give back to the community and help the next generation of professionals achieve their goals.') }}
                    </p>
                    <ul class="career-features mb-5">
                        <li><i class="bi bi-check-circle-fill"></i> {{ __('Offer professional guidance') }}</li>
                        <li><i class="bi bi-check-circle-fill"></i> {{ __('Share industry experience') }}</li>
                        <li><i class="bi bi-check-circle-fill"></i> {{ __('Build your network') }}</li>
                    </ul>
                    <a href="{{ route('register', ['role' => 'mentor']) }}" class="btn-career-success w-100">
                        <span>{{ __('Become a Mentor') }}</span>
                        <i class="bi bi-arrow-right-short ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 text-center mt-5 pt-3 animate__animated animate__fadeInUp">
            <p class="text-muted">
                {{ __('Already have an account?') }}
                <a href="{{ route('login') }}" class="text-primary-link fw-bold ms-1 text-decoration-none">
                    {{ __('Login instead') }}
                </a>
            </p>
        </div>
    </div>
</div>

<style>
/* PROFESSIONAL CAREER HUB STYLES */
:root {
    --career-primary: #1E40AF;
    --career-primary-soft: rgba(30, 64, 175, 0.08);
    --career-success: #059669;
    --career-success-soft: rgba(5, 150, 105, 0.08);
    --career-bg: #F8FAFC;
    --career-card-border: #E2E8F0;
    --career-text-dark: #0F172A;
    --career-text-muted: #64748B;
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

/* Background Glow Effect */
.career-bg-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgba(37, 99, 235, 0.05) 0%, transparent 70%);
    z-index: 0;
}

.career-title { font-weight: 850; color: var(--career-text-dark); letter-spacing: -1.5px; }
.career-subtitle { max-width: 650px; font-weight: 500; }

.text-primary-gradient {
    background: linear-gradient(135deg, #2563EB, #4F46E2);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.modern-card {
    background: white;
    border: 1px solid var(--career-card-border);
    border-radius: 30px;
    padding: 3rem 2.5rem;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    z-index: 10;
}

.career-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.12);
    border-color: #2563EB;
}

.card-badge {
    position: absolute;
    top: 25px;
    right: 25px;
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.career-card-icon {
    width: 80px;
    height: 80px;
    background: var(--career-primary-soft);
    color: var(--career-primary);
    border-radius: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.2rem;
    margin-bottom: 2rem;
}

.mentor-icon { background: var(--career-success-soft); color: var(--career-success); }

.career-features { list-style: none; padding: 0; text-align: left; }
.career-features li {
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    color: var(--career-text-muted);
    font-weight: 600;
    font-size: 0.95rem;
}

.career-features li i {
    font-size: 1.1rem;
    margin-inline-end: 12px;
    display: flex;
}

.student-card .career-features li i { color: #3B82F6; }
.mentor-card .career-features li i { color: #10B981; }

.btn-career-primary, .btn-career-success {
    padding: 16px;
    border-radius: 16px;
    font-weight: 700;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: none;
    color: white;
}

.btn-career-primary { background: var(--career-primary); box-shadow: 0 10px 20px rgba(30, 64, 175, 0.2); }
.btn-career-primary:hover { background: #1D4ED8; box-shadow: 0 15px 30px rgba(30, 64, 175, 0.3); transform: scale(1.02); }

.btn-career-success { background: var(--career-success); box-shadow: 0 10px 20px rgba(5, 150, 105, 0.2); }
.btn-career-success:hover { background: #047857; box-shadow: 0 15px 30px rgba(5, 150, 105, 0.3); transform: scale(1.02); }

.text-primary-link { color: var(--career-primary); transition: all 0.2s; }
.text-primary-link:hover { color: #2563EB; text-decoration: underline !important; }

/* RTL Adjustments */
[dir="rtl"] .card-badge { right: auto; left: 25px; }
[dir="rtl"] .career-card { text-align: right; }
[dir="rtl"] .career-features { text-align: right; }
[dir="rtl"] .career-features li i { margin-inline-end: 12px; }

@media (max-width: 991px) {
    .modern-card { padding: 2.5rem 2rem; }
    .display-4 { font-size: 2.8rem; }
}

@media (max-width: 576px) {
    .modern-card { border-radius: 25px; padding: 2rem 1.5rem; }
    .career-card-icon { width: 70px; height: 70px; font-size: 1.8rem; }
}
</style>
@endsection