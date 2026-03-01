@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-5 animate__animated animate__fadeIn">
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
                    <h2 class="fw-bold text-dark">{{ __('Welcome') }} <span class="text-primary">{{ __('Back') }}</span>
                    </h2>
                    <p class="text-muted small">{{ __('Please enter your credentials to access your account.') }}</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden p-4 p-md-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email"
                                class="form-label fw-bold text-muted small mb-1">{{ __('EMAIL ADDRESS') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="bi bi-envelope text-muted"></i></span>
                                <input id="email" type="email"
                                    class="form-control bg-light border-0 py-2 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="name@example.com">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label for="password"
                                    class="form-label fw-bold text-muted small mb-1">{{ __('PASSWORD') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="text-primary small fw-semibold text-decoration-none"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="bi bi-lock text-muted"></i></span>
                                <input id="password" type="password"
                                    class="form-control bg-light border-0 py-2 @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch custom-switch">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="remember">
                                    {{ __('Keep me logged in') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold">
                                {{ __('Login') }}
                            </button>


                        </div>

                        @if (Route::has('register'))
                            <div class="text-center mt-4">
                                <p class="text-muted small mb-0">{{ __("Don't have an account?") }}
                                    <a href="{{ route('register') }}"
                                        class="text-primary fw-bold text-decoration-none">{{ __('Create Account') }}</a>
                                </p>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

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

        [dir="rtl"] .input-group-text {
            border-radius: 0 0.5rem 0.5rem 0;
        }

        [dir="rtl"] .form-control {
            border-radius: 0.5rem 0 0 0.5rem;
        }
    </style>
@endsection