@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center animate__animated animate__fadeIn">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('users.index') }}"
                        class="btn btn-light rounded-circle p-2 me-3 shadow-sm transition-hover">
                        <i class="bi bi-arrow-left h5 mb-0"></i>
                    </a>
                    <h2 class="fw-bold text-dark mb-0">{{ __('User Details') }}</h2>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="p-5 text-center" style="background: linear-gradient(135deg, #0D6EFD 0%, #0043a8 100%);">
                        <div class="avatar-container mb-3 position-relative d-inline-block">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=fff&color=0D6EFD&size=120"
                                alt="Profile" class="rounded-circle shadow border border-4 border-white">
                            @if($user->role == 'admin')
                                <span
                                    class="position-absolute bottom-0 end-0 bg-danger text-white border border-2 border-white rounded-circle p-2"
                                    title="Admin">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                            @endif
                        </div>
                        <h3 class="fw-bold text-white mb-1">{{ $user->name }}</h3>
                        <p class="text-white-50 mb-0">{{ $user->email }}</p>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">ROLE</label>
                                <div class="p-3 bg-light rounded-3">
                                    <span
                                        class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'info' }}-subtle text-{{ $user->role == 'admin' ? 'danger' : 'info' }} border border-{{ $user->role == 'admin' ? 'danger' : 'info' }}-subtle rounded-pill px-3 py-2 fw-medium">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-muted small mb-1">MEMBER SINCE</label>
                                <div class="p-3 bg-light rounded-3 text-dark fw-semibold">
                                    <i class="bi bi-calendar-event me-2 text-primary"></i>
                                    {{ $user->created_at->format('M d, Y') }}
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="my-2 opacity-10">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('UNIVERSITY') }}</label>
                                <div class="p-3 bg-light rounded-3 text-dark fw-semibold h-100">
                                    <i class="bi bi-bank me-2 text-primary"></i>
                                    {{ $user->university->name ?? __('Not Set') }}
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('FACULTY') }}</label>
                                <div class="p-3 bg-light rounded-3 text-dark fw-semibold h-100">
                                    <i class="bi bi-mortarboard me-2 text-primary"></i>
                                    {{ $user->faculty->name ?? __('Not Set') }}
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold text-muted small mb-1">{{ __('CAREER PATH') }}</label>
                                <div class="p-3 bg-light rounded-3 text-dark fw-semibold h-100">
                                    <i class="bi bi-signpost-split me-2 text-primary"></i>
                                    {{ $user->careerPath->name ?? __('Not Set') }}
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="my-2 opacity-10">
                            </div>

                            {{-- LinkedIn --}}
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="bi bi-linkedin me-1 text-primary"></i> LINKEDIN
                                </label>
                                @if(!empty($user->linkedin_url))
                                    <a href="{{ $user->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                                        class="d-flex align-items-center gap-3 p-3 rounded-4 text-decoration-none"
                                        style="background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%); border: 1px solid rgba(10,102,194,0.15); transition: all 0.2s ease;"
                                        onmouseover="this.style.boxShadow='0 6px 20px rgba(10,102,194,0.15)'; this.style.transform='translateY(-2px)'"
                                        onmouseout="this.style.boxShadow=''; this.style.transform=''">
                                        <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                            style="width:44px;height:44px;background:#0A66C2;">
                                            <i class="bi bi-linkedin text-white fs-4"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <div class="fw-bold text-dark" style="font-size:0.9rem;">{{ $user->name }}</div>
                                            <div class="text-muted text-truncate" style="font-size:0.78rem;">
                                                {{ $user->linkedin_url }}</div>
                                        </div>
                                        <i class="bi bi-box-arrow-up-right text-primary ms-auto"></i>
                                    </a>
                                @else
                                    <div class="p-3 bg-light rounded-3 text-muted fw-medium">
                                        <i class="bi bi-linkedin me-2 opacity-50"></i> {{ __('Not Set') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-5">
                            <a href="{{ route('messages.show', $user) }}"
                                class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                <i class="bi bi-chat-dots-fill me-2"></i> {{ __('Send Message') }}
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger rounded-pill px-4 fw-bold"
                                        onclick="return confirm('{{ __('Are you sure?') }}')">
                                        <i class="bi bi-trash me-2"></i> {{ __('Delete User') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .rounded-4 {
            border-radius: 1rem !important;
        }

        .transition-hover:hover {
            transform: scale(1.1);
            background-color: #f8f9fa;
        }

        .bg-info-subtle {
            background-color: #cff4fc !important;
        }

        .bg-danger-subtle {
            background-color: #f8d7da !important;
        }

        @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
    </style>
@endsection