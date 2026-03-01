@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Welcome Header -->
        <div class="row mb-4 animate__animated animate__fadeInDown">
            <div class="col-12">
                <div class="p-5 bg-white rounded-4 shadow-sm border-0 d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); color: white;">
                    <div>
                        <h2 class="fw-bold mb-2">{{ __('My Dashboard') }}</h2>
                        <p class="mb-0 text-white-50">{{ __('Welcome back, :name! Start Your Career Journey 🚀', ['name' => Auth::user()->name]) }}</p>
                    </div>
                    <div class="d-none d-md-block">
                        <a href="{{ route('jobs.index') }}"
                            class="btn btn-light rounded-3 px-4 py-2 fw-semibold shadow-sm">
                            <i class="bi bi-search me-2"></i> {{ __('Browse Jobs') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 text-primary">
                                <i class="bi bi-briefcase fs-4"></i>
                            </div>
                            <span class="badge bg-light text-dark fw-bold">{{ __('Total') }}</span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $jobsCount }}</h3>
                        <p class="text-muted small mb-0">{{ __('Available Jobs') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-success bg-opacity-10 p-3 rounded-3 text-success">
                                <i class="bi bi-book fs-4"></i>
                            </div>
                            <span class="badge bg-light text-dark fw-bold">{{ __('Total') }}</span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $trainingsCount }}</h3>
                        <p class="text-muted small mb-0">{{ __('Available Trainings') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-warning bg-opacity-10 p-3 rounded-3 text-warning">
                                <i class="bi bi-envelope fs-4"></i>
                            </div>
                            <span class="badge bg-light text-dark fw-bold">{{ __('Total') }}</span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ count($myRequests) }}</h3>
                        <p class="text-muted small mb-0">{{ __('Mentorship Requests') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded-3 text-info">
                                <i class="bi bi-clock-history fs-4"></i>
                            </div>
                            <span class="badge bg-light text-dark fw-bold">{{ __('Pending') }}</span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $pendingRequestsCount }}</h3>
                        <p class="text-muted small mb-0">{{ __('Awaiting Response') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications Alert Row -->
        @php
            $unreadNotifications = Auth::user()->notifications()->where('read', false)->count();
            $recentNotifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->take(5)->get();
        @endphp
        @if($unreadNotifications > 0 || $recentNotifications->count() > 0)
            <div class="row g-4 mb-5 animate__animated animate__fadeInUp">
                <div class="col-12">
                    <div class="card rounded-4 border-0 shadow-sm overflow-hidden"
                        style="background: linear-gradient(135deg, #f8f9ff 0%, #eef2ff 100%); border-left: 5px solid #6366f1 !important;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-3 shadow-sm"
                                        style="width:45px;height:45px;background:linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);color:white;">
                                        <i class="bi bi-bell-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bolder text-dark">{{ __('Recent Notifications') }}</h6>
                                        <small class="text-muted">{{ __('You have :count unread notifications', ['count' => $unreadNotifications]) }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                    {{ __('View All') }} <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                            @if($recentNotifications->count() > 0)
                                <div class="notification-items" style="max-height: 300px; overflow-y: auto;">
                                    @foreach($recentNotifications as $notification)
                                        <div class="d-flex gap-3 p-3 mb-2 rounded-3 {{ !$notification->read ? 'bg-white shadow-sm' : '' }}" style="border-left: 3px solid {{ !$notification->read ? '#6366f1' : '#e5e7eb' }};">
                                            <div class="small fw-bold text-primary" style="min-width: 40px; text-align: center;">
                                                        <i class="bi {{ \App\Services\NotificationService::getIcon($notification->type) }} fs-5"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-1 {{ !$notification->read ? 'fw-bold text-dark' : 'text-muted' }}">{{ $notification->title }}</p>
                                                        <small class="text-muted d-block">{{ $notification->message }}</small>
                                                        <small class="text-muted d-block mt-1">{{ $notification->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    @if(!$notification->read)
                                                        <div class="d-flex align-items-center gap-2">
                                                            <form action="{{ route('notifications.read', $notification) }}" method="POST" class="m-0">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-2" title="{{ __('Mark as read') }}">
                                                                    <i class="bi bi-check2"></i>
                                                                </button>
                                                            </form>
                                                            <span class="badge rounded-pill bg-primary" style="width: 8px; height: 8px; padding: 0;"></span>
                                                        </div>
                                                    @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-12 col-lg-8">
                <!-- Available Trainings/Programs Section -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 animate__animated animate__fadeInUp">
                    <div class="card-header bg-white py-3 border-0 p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0 text-dark">{{ __('Available Training Programs') }}</h5>
                            <a href="{{ route('trainings.index') }}" class="btn btn-sm btn-outline-success rounded-pill">
                                {{ __('View All') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($availableTrainings) && $availableTrainings->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light border-bottom">
                                        <tr>
                                            <th class="px-4 py-3 text-muted small fw-bold border-0">{{ __('PROGRAM NAME') }}</th>
                                            <th class="px-4 py-3 text-muted small fw-bold border-0">{{ __('MENTOR') }}</th>
                                            <th class="px-4 py-3 text-muted small fw-bold text-end border-0">{{ __('ACTION') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($availableTrainings as $training)
                                            <tr class="border-bottom">
                                                <td class="px-4 py-4 border-0">
                                                    <h6 class="mb-0 fw-bold">{{ $training->name }}</h6>
                                                    <small class="text-muted">{{ Str::limit($training->description, 50) }}</small>
                                                </td>
                                                <td class="px-4 py-4 border-0">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 30px; height: 30px;">
                                                            {{ strtoupper(substr($training->mentor->name ?? 'N', 0, 1)) }}
                                                        </span>
                                                        <span class="small fw-bold">{{ $training->mentor->name ?? __('Unknown') }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 border-0 text-end">
                                                    <a href="{{ route('trainings.show', $training) }}" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold">
                                                        <i class="bi bi-arrow-right me-1"></i> {{ __('View') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-book fs-3 mb-3 d-block opacity-50"></i>
                                {{ __('No training programs available at the moment.') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Job Opportunities Section -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card-header bg-white py-3 border-0 p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0 text-dark">{{ __('Job Opportunities') }}</h5>
                            <a href="{{ route('jobs.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                {{ __('Browse All') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light border-bottom">
                                    <tr>
                                        <th class="px-4 py-3 text-muted small fw-bold border-0">{{ __('POSITION') }}</th>
                                        <th class="px-4 py-3 text-muted small fw-bold border-0">{{ __('LOCATION') }}</th>
                                        <th class="px-4 py-3 text-muted small fw-bold border-0">{{ __('COMPANY') }}</th>
                                        <th class="px-4 py-3 text-muted small fw-bold text-end border-0">{{ __('ACTION') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($recentJobs) && $recentJobs->count() > 0)
                                        @foreach($recentJobs as $job)
                                            <tr class="border-bottom">
                                                <td class="px-4 py-4 border-0">
                                                    <h6 class="mb-0 fw-bold">{{ $job->title }}</h6>
                                                </td>
                                                <td class="px-4 py-4 border-0">
                                                    <small class="text-muted">{{ $job->location ?? __('Remote') }}</small>
                                                </td>
                                                <td class="px-4 py-4 border-0">
                                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">{{ $job->company ?? __('N/A') }}</span>
                                                </td>
                                                <td class="px-4 py-4 border-0 text-end">
                                                    @php
                                                        $status = $myApplications[$job->id] ?? null;
                                                    @endphp
                                                    @if($status)
                                                        @php
                                                            $badgeClass = 'bg-secondary';
                                                            $statusText = __('Applied');
                                                            if($status == 'approved') {
                                                                $badgeClass = 'bg-success';
                                                                $statusText = __('Accepted');
                                                            } elseif($status == 'rejected') {
                                                                $badgeClass = 'bg-danger';
                                                                $statusText = __('Rejected');
                                                            } elseif($status == 'pending') {
                                                                $badgeClass = 'bg-warning text-dark';
                                                                $statusText = __('Pending');
                                                            }
                                                        @endphp
                                                        <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2">
                                                            {{ $statusText }}
                                                        </span>
                                                    @else
                                                        <form action="{{ route('job_applications.store', $job) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                                                <i class="bi bi-send-fill me-1"></i> {{ __('Apply') }}
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center py-5 text-muted">
                                                <i class="bi bi-briefcase fs-3 mb-3 d-block opacity-50"></i>
                                                {{ __('No job opportunities available at the moment.') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="col-12 col-lg-4">
                <!-- Profile Completion Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 animate__animated animate__fadeInRight">
                    <div class="text-center mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d6efd&color=fff&size=80"
                            alt="Profile" class="rounded-circle shadow-sm border border-3 border-primary" style="width: 80px; height: 80px;">
                    </div>
                    <h6 class="fw-bold text-center mb-1">{{ Auth::user()->name }}</h6>
                    <p class="text-muted text-center small mb-3">{{ __('Graduate Student') }}</p>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-primary rounded-pill" style="width: 45%"></div>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-3">
                        <span>{{ __('Profile Completion') }}</span>
                        <span class="fw-bold">45%</span>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm w-100 rounded-3 fw-bold">
                        {{ __('Complete Profile') }}
                    </a>
                </div>

                <!-- Mentorship Requests Status -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold mb-3">{{ __('My Mentorship Requests') }}</h6>
                    @if($myRequests && count($myRequests) > 0)
                        <div class="space-y-2">
                            @foreach($myRequests as $req)
                                <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded-3 mb-2">
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px;">
                                            {{ strtoupper(substr($req->mentor->name ?? 'M', 0, 1)) }}
                                        </span>
                                        <div>
                                            <h6 class="mb-0 small fw-bold">{{ $req->mentor->name ?? __('Unknown') }}</h6>
                                            <small class="text-muted">{{ __('Mentor') }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($req->status === 'pending')
                                            <span class="badge bg-warning rounded-pill px-2 py-1 small fw-bold">{{ __('Pending') }}</span>
                                            <form action="{{ route('mentorship_requests.destroy', $req) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0" title="{{ __('Cancel') }}">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                </button>
                                            </form>
                                        @elseif($req->status === 'approved')
                                            <span class="badge bg-success rounded-pill px-2 py-1 small fw-bold">✓ {{ __('Approved') }}</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-2 py-1 small fw-bold">✕ {{ __('Rejected') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center small mb-0">
                            <i class="bi bi-info-circle me-1"></i> {{ __('You haven\'t sent any mentorship requests yet.') }}
                        </p>
                    @endif
                </div>

                <!-- My Training Programs -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold mb-3">{{ __('My Training Programs') }}</h6>
                    @if(isset($myTrainings) && $myTrainings->count() > 0)
                        <div class="space-y-2">
                            @foreach($myTrainings as $enrollment)
                                <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded-3 mb-2">
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <div class="ms-1">
                                            <h6 class="mb-0 small fw-bold">{{ $enrollment->training->name }}</h6>
                                            <small class="text-muted">{{ $enrollment->training->mentor->name ?? __('No Mentor') }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        @php
                                            $st = $enrollment->status;
                                            $badge = 'bg-secondary';
                                            if($st == 'pending') $badge = 'bg-warning text-dark';
                                            elseif($st == 'enrolled') $badge = 'bg-success';
                                            elseif($st == 'completed') $badge = 'bg-primary';
                                            elseif($st == 'dropped') $badge = 'bg-danger';
                                        @endphp
                                        <span class="badge {{ $badge }} rounded-pill px-2 py-1 small fw-bold">
                                            {{ __($st === 'pending' ? 'Pending' : ($st === 'enrolled' ? 'Enrolled' : ucfirst($st))) }}
                                        </span>
                                        @if($st === 'pending')
                                            <form action="{{ route('training_enrollments.update', $enrollment) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="dropped">
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0" title="{{ __('Cancel') }}">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center small mb-0">
                            <i class="bi bi-info-circle me-1"></i> {{ __('You haven\'t applied for any trainings yet.') }}
                        </p>
                    @endif
                </div>

                <!-- Find a Mentor Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary bg-opacity-10 border-primary border-2">
                    <h6 class="fw-bold mb-2 text-primary">🎯 {{ __('Find a Mentor') }}</h6>
                    <p class="small text-muted mb-3">{{ __('Connect with experienced professionals to guide your career path.') }}</p>
                    <a href="{{ route('mentors.index') }}" class="btn btn-primary btn-sm w-100 rounded-3 fw-bold">
                        <i class="bi bi-search me-1"></i> {{ __('Browse Mentors') }}
                    </a>
                </div>

                <!-- Quick Tips -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
                    <h6 class="fw-bold mb-3">💡 {{ __('Quick Tips') }}</h6>
                    <ul class="small text-muted list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-star-fill text-warning me-2"></i>
                            {{ __('Update your skills regularly') }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            {{ __('Complete your CV profile') }}
                        </li>
                        <li>
                            <i class="bi bi-person-check-fill text-info me-2"></i>
                            {{ __('Connect with mentors') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection