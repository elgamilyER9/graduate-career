@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Welcome Header -->
        <div class="row mb-4 animate__animated animate__fadeInDown">
            <div class="col-12">
                <div class="p-4 bg-white rounded-4 shadow-sm border-0 d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">{{ __('Mentor Dashboard') }} | {{ __('Welcome, :name! 👋', ['name' => Auth::user()->name]) }}</h2>
                        <p class="text-muted mb-0">{{ __("Help graduates find their professional path.") }}</p>
                    </div>
                    <div class="d-none d-md-block">
                        <button class="btn btn-success rounded-3 px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-chat-dots me-2"></i> {{ __('Message Graduates') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="background: linear-gradient(135deg, #0f172a 0%, #334155 100%); color: white;">
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-white bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-people-fill fs-2"></i>
                            </div>
                            <span class="badge bg-primary rounded-pill px-3">{{ __('Total Students') }}</span>
                        </div>
                        <h2 class="fw-bold mb-0 display-5">{{ $totalStudents }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">{{ __('Potential mentees in our system.') }}</p>
                    </div>
                    <div class="position-absolute top-0 end-0 opacity-10 translate-middle-y me-n3 mt-3">
                         <i class="bi bi-people-fill" style="font-size: 120px;"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white;">
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-white bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-check-circle-fill fs-2"></i>
                            </div>
                            <span class="badge bg-white bg-opacity-25 rounded-pill px-3">{{ __('My Mentees') }}</span>
                        </div>
                        <h2 class="fw-bold mb-0 display-5">{{ $myMenteesCount }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">{{ __('Graduates you are currently guiding.') }}</p>
                    </div>
                    <div class="position-absolute top-0 end-0 opacity-10 translate-middle-y me-n3 mt-3">
                         <i class="bi bi-mortarboard-fill" style="font-size: 120px;"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="background: linear-gradient(135deg, #ea580c 0%, #f97316 100%); color: white;">
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-white bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-clock-history fs-2"></i>
                            </div>
                            <span class="badge bg-white bg-opacity-25 rounded-pill px-3">{{ __('Pending Requests') }}</span>
                        </div>
                        <h2 class="fw-bold mb-0 display-5">{{ $pendingRequestsCount }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">{{ __('New messages waiting for your response.') }}</p>
                    </div>
                    <div class="position-absolute top-0 end-0 opacity-10 translate-middle-y me-n3 mt-3">
                         <i class="bi bi-envelope-open-fill" style="font-size: 120px;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mentor Content -->
        <div class="row g-4">
            <div class="col-12 col-lg-8 animate__animated animate__fadeInLeft">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 animate__animated animate__fadeInUp">
                    <div class="card-header bg-white py-3 border-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0 text-dark">{{ __('Incoming Mentorship Requests') }}</h5>
                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">{{ $pendingRequests->count() }} {{ __('Pending') }}</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('NAME') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('MESSAGE') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('ACTION') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingRequests as $request)
                                        <tr>
                                            <td class="px-4 py-3 border-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle-sm bg-primary-subtle text-primary me-3">
                                                        {{ strtoupper(substr($request->student->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $request->student->name }}</h6>
                                                        <small class="text-muted">{{ $request->student->faculty->name ?? __('Unknown Faculty') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-muted small">
                                                {{ Str::limit($request->message, 50) ?: __('No message provided.') }}
                                            </td>
                                            <td class="px-4 py-3 border-0 text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <form action="{{ route('mentorship_requests.update', $request) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="btn btn-success btn-sm rounded-pill px-3">{{ __('Approve') }}</button>
                                                    </form>
                                                    <form action="{{ route('mentorship_requests.update', $request) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">{{ __('Reject') }}</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5 text-muted small">
                                                {{ __('No pending requests at the moment.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Latest Graduate Profiles -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card-header bg-white py-3 border-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0 text-dark">{{ __('Latest Graduate Profiles') }}</h5>
                            <a href="#" class="btn btn-link text-primary text-decoration-none p-0 small fw-bold">{{ __('View All') }}</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('NAME') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('FACULTY') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('ACTION') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestGraduates as $grad)
                                        <tr>
                                            <td class="px-4 py-3 border-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle-sm bg-primary-subtle text-primary me-3">
                                                        {{ strtoupper(substr($grad->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $grad->name }}</h6>
                                                        <small class="text-muted">{{ $grad->university->name ?? __('Unknown') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                <span class="badge bg-light text-dark rounded-pill px-3 fw-medium">
                                                    {{ $grad->faculty->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-end">
                                                <button class="btn btn-light btn-sm rounded-3 p-2 text-primary border-0 shadow-sm">
                                                    <i class="bi bi-chat-dots-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5 text-muted small">
                                                {{ __('No new graduates at the moment.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-4 animate__animated animate__fadeInRight">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-primary text-white">
                    <h5 class="fw-bold mb-3">{{ __('Mentorship Tip') }}</h5>
                    <p class="small mb-0">{{ __('Regular feedback on CVs and career paths significantly increases employment rates for graduates.') }}</p>
                </div>
                
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold mb-3">{{ __('My Profile') }}</h5>
                    <div class="d-flex align-items-center mb-3">
                         <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&size=50" alt="Mentor" class="rounded-circle me-3">
                         <div>
                             <h6 class="fw-bold mb-0">{{ Auth::user()->name }}</h6>
                             <span class="text-muted small">{{ __('Verified Mentor') }}</span>
                         </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm w-100 rounded-pill">{{ __('Edit Profile') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
