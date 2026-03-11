@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        {{-- ── HERO HEADER ── --}}
        <div class="rounded-5 p-5 mb-5 position-relative overflow-hidden animate__animated animate__fadeIn"
            style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%); color:white; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
            <div class="position-absolute"
                style="top:-60px;right:-60px;width:260px;height:260px;background:rgba(59,130,246,0.07);filter:blur(60px);border-radius:50%;">
            </div>
            <div class="position-absolute"
                style="bottom:-40px;left:-40px;width:200px;height:200px;background:rgba(16,185,129,0.07);filter:blur(50px);border-radius:50%;">
            </div>
            <div class="row align-items-center g-4 position-relative">
                <div class="col-md-8">
                    <span class="badge rounded-pill px-3 py-2 mb-3 fw-bold text-uppercase"
                        style="background:rgba(239,68,68,0.2);color:#fca5a5;border:1px solid rgba(239,68,68,0.3);font-size:0.7rem;letter-spacing:0.08em;">
                        <i class="bi bi-shield-fill-check me-1"></i>{{ __('Admin Control Panel') }}
                    </span>
                    <h2 class="display-6 fw-bolder mb-2">
                        <i
                            class="bi bi-stars me-2 text-warning"></i>{{ __('Welcome back, :name', ['name' => Auth::user()->name]) }}
                    </h2>
                    <p class="text-white-50 mb-4 fw-medium">
                        {{ __('Full platform visibility and management. All systems operational.') }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('users.create') }}"
                            class="btn btn-primary rounded-pill px-4 fw-bold shadow hover-scale">
                            <i class="bi bi-person-plus me-2"></i>{{ __('Add User') }}
                        </a>
                        <a href="{{ route('jobs.create') }}"
                            class="btn btn-success rounded-pill px-4 fw-bold shadow hover-scale">
                            <i class="bi bi-plus-circle me-2"></i>{{ __('Add New Job') }}
                        </a>
                        <a href="{{ route('trainings.create') }}"
                            class="btn btn-warning text-dark rounded-pill px-4 fw-bold shadow hover-scale">
                            <i class="bi bi-mortarboard me-2"></i>{{ __('New Training') }}
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center d-none d-md-block">
                    <i class="bi bi-shield-lock-fill text-primary opacity-20"
                        style="font-size:9rem;filter:drop-shadow(0 0 30px rgba(59,130,246,0.3));"></i>
                </div>
            </div>
        </div>

        {{-- ── NOTIFICATIONS BANNER ── --}}
        @if($unreadAdminNotifications > 0)
            <div class="rounded-4 p-3 mb-4 d-flex align-items-center gap-3 animate__animated animate__fadeIn"
                style="background:linear-gradient(135deg,#f0f4ff,#e8eeff);border:1px solid #c7d2fe;">
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width:44px;height:44px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;">
                    <i class="bi bi-bell-fill fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <span class="fw-bold"
                        style="color:#4338ca;">{{ __('You have :count unread notifications!', ['count' => $unreadAdminNotifications]) }}</span>
                    <small class="text-muted d-block">{{ __('Review and manage your notifications below.') }}</small>
                </div>
                <a href="{{ route('admin.notifications.index') }}" class="btn btn-sm rounded-pill px-3 fw-bold"
                    style="background:#6366f1;color:white;border:none;">
                    <i class="bi bi-arrow-right me-1"></i>{{ __('Manage All') }}
                </a>
                <button type="button" class="btn-close" onclick="this.closest('.rounded-4').remove()"
                    aria-label="Close"></button>
            </div>
        @endif

        {{-- ── PRIMARY STAT CARDS ── --}}
        <div class="row g-4 mb-5">
            @php
                $statCards = [
                    ['label' => __('Total Users'), 'value' => $usersCount, 'icon' => 'bi-people-fill', 'color' => '#3b82f6', 'bg' => '#eff6ff', 'link' => route('users.index')],
                    ['label' => __('Mentors'), 'value' => $mentorsCount, 'icon' => 'bi-person-badge-fill', 'color' => '#8b5cf6', 'bg' => '#f5f3ff', 'link' => route('users.index')],
                    ['label' => __('Students'), 'value' => $studentsCount, 'icon' => 'bi-mortarboard-fill', 'color' => '#10b981', 'bg' => '#f0fdf4', 'link' => route('users.index')],
                    ['label' => __('Active Jobs'), 'value' => $jobsCount, 'icon' => 'bi-briefcase-fill', 'color' => '#f59e0b', 'bg' => '#fffbeb', 'link' => route('jobs.index')],
                    ['label' => __('Training Programs'), 'value' => $trainingsCount, 'icon' => 'bi-book-fill', 'color' => '#06b6d4', 'bg' => '#ecfeff', 'link' => route('trainings.index')],
                    ['label' => __('Job Applications'), 'value' => $applicationsCount, 'icon' => 'bi-send-fill', 'color' => '#ef4444', 'bg' => '#fef2f2', 'link' => route('job_applications.index')],
                    ['label' => __('Career Paths'), 'value' => $careerPathsCount, 'icon' => 'bi-signpost-split-fill', 'color' => '#f97316', 'bg' => '#fff7ed', 'link' => route('career_paths.index')],
                    ['label' => __('Skills'), 'value' => $skillsCount, 'icon' => 'bi-star-fill', 'color' => '#ec4899', 'bg' => '#fdf4ff', 'link' => route('skills.index')],
                    ['label' => __('Uploaded Files'), 'value' => $filesCount, 'icon' => 'bi-folder-fill', 'color' => '#10b981', 'bg' => '#f0fdf4', 'link' => route('admin.files.index')],
                    ['label' => __('Notifications'), 'value' => $totalNotificationsCount, 'icon' => 'bi-bell-fill', 'color' => '#6366f1', 'bg' => '#f5f3ff', 'link' => route('admin.notifications.index')],
                ];
            @endphp
            @foreach($statCards as $i => $card)
                <div class="col-6 col-sm-4 col-lg-3 animate__animated animate__fadeInUp"
                    style="animation-delay:{{ $i * 0.07 }}s">
                    <a href="{{ $card['link'] }}" class="text-decoration-none">
                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-lift transition-all"
                            style="background: {{ $card['bg'] }}; border: 1px solid {{ $card['color'] }}18 !important;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center"
                                        style="width:46px;height:46px;background:{{ $card['color'] }}20;">
                                        <i class="bi {{ $card['icon'] }} fs-4" style="color:{{ $card['color'] }};"></i>
                                    </div>
                                </div>
                                <h3 class="fw-black mb-1" style="font-size:2rem;color:{{ $card['color'] }};">
                                    {{ $card['value'] }}
                                </h3>
                                <p class="text-muted small fw-semibold mb-0">{{ $card['label'] }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- ── PENDING ALERTS ROW ── --}}
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-xl-3">
                <a href="{{ route('job_applications.index', ['status' => 'pending']) }}" class="text-decoration-none">
                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden hover-lift transition-all"
                        style="border-top:4px solid #ef4444 !important;background:#fef2f2;">
                        <div class="card-body p-4 d-flex align-items-center gap-4">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:50px;height:50px;background:#fee2e2;">
                                <i class="bi bi-clock-fill fs-3 text-danger"></i>
                            </div>
                            <div>
                                <h2 class="fw-black text-danger mb-0">{{ $pendingAppsCount }}</h2>
                                <p class="text-muted small mb-0 fw-semibold">{{ __('Pending Job Applications') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a href="{{ route('admin.mentorship_requests.index', ['status' => 'pending']) }}"
                    class="text-decoration-none">
                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden hover-lift transition-all"
                        style="border-top:4px solid #f59e0b !important;background:#fffbeb;">
                        <div class="card-body p-4 d-flex align-items-center gap-4">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:50px;height:50px;background:#fef3c7;">
                                <i class="bi bi-person-heart fs-3 text-warning"></i>
                            </div>
                            <div>
                                <h2 class="fw-black text-warning mb-0">{{ $pendingMentorshipCount }}</h2>
                                <p class="text-muted small mb-0 fw-semibold">{{ __('Pending Mentorship Requests') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a href="{{ route('job_applications.index', ['status' => 'approved']) }}" class="text-decoration-none">
                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden hover-lift transition-all"
                        style="border-top:4px solid #10b981 !important;background:#f0fdf4;">
                        <div class="card-body p-4 d-flex align-items-center gap-4">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:50px;height:50px;background:#d1fae5;">
                                <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                            </div>
                            <div>
                                <h2 class="fw-black text-success mb-0">{{ $approvedAppsCount }}</h2>
                                <p class="text-muted small mb-0 fw-semibold">{{ __('Approved Applications') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a href="{{ route('connections.index') }}" class="text-decoration-none">
                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden hover-lift transition-all"
                        style="border-top:4px solid #3b82f6 !important;background:#eff6ff;">
                        <div class="card-body p-4 d-flex align-items-center gap-4">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:50px;height:50px;background:#dbeafe;">
                                <i class="bi bi-chat-dots-fill fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h2 class="fw-black text-primary mb-0">{{ $unreadMessagesCount }}</h2>
                                <p class="text-muted small mb-0 fw-semibold">{{ __('Unread Messages') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- ── NOTIFICATIONS MANAGEMENT SECTION ── --}}
        <div class="row g-4 mb-5 animate__animated animate__fadeInUp">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header border-0 py-4 px-4 d-flex justify-content-between align-items-center"
                        style="background:linear-gradient(135deg,#f8f9ff,#eef2ff);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 shadow-sm"
                                style="width:45px;height:45px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;">
                                <i class="bi bi-bell-fill fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bolder text-dark">{{ __('Notifications Management') }}</h5>
                                <small class="text-muted">
                                    <span class="fw-bold"
                                        style="color:#6366f1;">{{ $allNotifications->where('read', false)->count() }}</span>
                                    {{ __('unread') }} / {{ $totalNotificationsCount }} {{ __('total') }}
                                </small>
                            </div>
                        </div>
                        <a href="{{ route('admin.notifications.index') }}" class="btn btn-sm rounded-pill px-4 fw-bold"
                            style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;border:none;">
                            {{ __('View All') }} <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                    {{-- In-page Notification Alert Messages --}}
                    @if($allNotifications->where('read', false)->count() > 0)
                        @foreach($allNotifications->where('read', false)->take(3) as $unread)
                            <div class="mx-4 mt-3 rounded-3 p-3 d-flex align-items-center gap-3 animate__animated animate__pulse"
                                style="background:#faf5ff;border:1px solid #ddd6fe;">
                                <i class="bi {{ \App\Services\NotificationService::getIcon($unread->type) }} fs-5"
                                    style="color:#8b5cf6;"></i>
                                <div class="flex-grow-1">
                                    <span class="fw-bold text-dark" style="font-size:0.87rem;">{{ $unread->title }}</span>
                                    <small class="text-muted d-block">{{ __('From') }}: {{ $unread->user->name ?? '—' }} ·
                                        {{ $unread->created_at->diffForHumans() }}</small>
                                </div>
                                <form action="{{ route('notifications.read', $unread) }}" method="POST" class="m-0">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm rounded-pill px-3 fw-bold"
                                        style="background:#8b5cf6;color:white;border:none;font-size:0.78rem;">
                                        <i class="bi bi-check2 me-1"></i>{{ __('Mark read') }}
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @endif

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Notification') }}
                                        </th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('User') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-center">
                                            {{ __('Status') }}
                                        </th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Time') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allNotifications as $notification)
                                        <tr style="{{ !$notification->read ? 'background:#fafbff;' : '' }}">
                                            <td class="px-4 py-3 border-0">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                        style="width:38px;height:38px;background:{{ !$notification->read ? '#e0e7ff' : '#f3f4f6' }};">
                                                        <i class="bi {{ \App\Services\NotificationService::getIcon($notification->type) }}"
                                                            style="color:{{ !$notification->read ? '#6366f1' : '#9ca3af' }};"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark" style="font-size:0.85rem;">
                                                            {{ $notification->title }}
                                                        </div>
                                                        <small
                                                            class="text-muted">{{ Str::limit($notification->description, 50) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($notification->user->name ?? '?') }}&background=EBF4FF&color=1E40AF&size=28"
                                                        class="rounded-circle" style="width:28px;height:28px;" alt="">
                                                    <small
                                                        class="fw-semibold text-dark">{{ $notification->user->name ?? '—' }}</small>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-center">
                                                @if(!$notification->read)
                                                    <span class="badge rounded-pill px-2 fw-bold"
                                                        style="background:#e0e7ff;color:#6366f1;font-size:0.72rem;">
                                                        <i class="bi bi-circle-fill me-1"
                                                            style="font-size:5px;vertical-align:middle;"></i>{{ __('Unread') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-light text-muted rounded-pill px-2 fw-bold"
                                                        style="font-size:0.72rem;">{{ __('Read') }}</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                <small
                                                    class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-end">
                                                <div class="d-flex justify-content-end gap-1">
                                                    @if(!$notification->read)
                                                        <form action="{{ route('notifications.read', $notification) }}"
                                                            method="POST" class="m-0">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="btn-mini-view"
                                                                title="{{ __('Mark as read') }}">
                                                                <i class="bi bi-check2"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('notifications.destroy', $notification) }}"
                                                        method="POST" class="m-0"
                                                        onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn-mini-delete"
                                                            title="{{ __('Delete') }}">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox-fill opacity-25 fs-1"></i>
                                                <p class="mt-2 mb-0">{{ __('No notifications yet') }}</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── MAIN CONTENT: Users + Chart ── --}}
        <div class="row g-4 mb-5">
            {{-- Recent Users Table --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;background:#eff6ff;">
                                <i class="bi bi-people-fill text-primary"></i>
                            </div>
                            <h5 class="mb-0 fw-bolder">{{ __('Recent Users') }}</h5>
                        </div>
                        <a href="{{ route('users.index') }}"
                            class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                            {{ __('View All') }} <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    {{-- Filter Bar --}}
                    <div class="px-4 pb-3 pt-1 border-bottom">
                        <div class="d-flex gap-2 flex-wrap">
                            <div class="input-group input-group-sm flex-grow-1" style="min-width:160px;max-width:280px;">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-search text-muted"></i></span>
                                <input type="text" id="userSearch" class="form-control border-start-0 shadow-none"
                                    placeholder="{{ __('Search by name or email...') }}"
                                    oninput="filterTable('usersTable','userSearch','userRoleFilter')">
                            </div>
                            <select id="userRoleFilter" class="form-select form-select-sm shadow-none"
                                style="max-width:140px;" onchange="filterTable('usersTable','userSearch','userRoleFilter')">
                                <option value="">{{ __('All Roles') }}</option>
                                <option value="admin">{{ __('Admin') }}</option>
                                <option value="mentor">{{ __('Mentor') }}</option>
                                <option value="user">{{ __('Student') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Name') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Role') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Faculty') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="usersTable">
                                    @foreach($recentUsers as $u)
                                        <tr data-search="{{ strtolower($u->name . ' ' . $u->email) }}"
                                            data-role="{{ $u->role }}">
                                            <td class="px-4 py-3 border-0">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}&background=EBF4FF&color=1E40AF&size=36"
                                                        class="rounded-circle shadow-sm" style="width:36px;height:36px;" alt="">
                                                    <div>
                                                        <div class="fw-bold text-dark mb-0" style="font-size:0.88rem;">
                                                            {{ $u->name }}
                                                        </div>
                                                        <small class="text-muted">{{ $u->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                @php
                                                    $rc = ['admin' => 'danger', 'mentor' => 'warning', 'user' => 'primary'];
                                                    $ri = $rc[$u->role] ?? 'secondary';
                                                @endphp
                                                <span
                                                    class="badge bg-{{ $ri }}-subtle text-{{ $ri }} rounded-pill px-2 fw-bold">{{ ucfirst($u->role) }}</span>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                <small class="text-muted">{{ $u->faculty->name ?? '—' }}</small>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-end">
                                                <div class="d-flex justify-content-end gap-1">
                                                    <a href="{{ route('users.show', $u) }}" class="btn-mini-view"
                                                        title="{{ __('View') }}"><i class="bi bi-eye"></i></a>
                                                    <a href="{{ route('users.edit', $u) }}" class="btn-mini-edit"
                                                        title="{{ __('Edit') }}"><i class="bi bi-pencil"></i></a>
                                                    <form action="{{ route('users.destroy', $u) }}" method="POST"
                                                        class="d-inline" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn-mini-delete" title="{{ __('Delete') }}"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Statistics Chart --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bolder mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-bar-chart-fill text-primary"></i> {{ __('Platform Overview') }}
                    </h6>
                    <canvas id="overviewChart" height="220"></canvas>
                </div>
                <div class="card border-0 shadow-sm rounded-4 p-4"
                    style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);">
                    <h6 class="fw-bolder mb-3 text-success">
                        <i class="bi bi-activity me-2"></i>{{ __('System Status') }}
                    </h6>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small">{{ __('Status') }}</span>
                        <span class="badge bg-success rounded-pill px-3">{{ __('Online') }} ✅</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small">{{ __('Last Updated') }}</span>
                        <span class="small fw-bold text-dark">{{ now()->format('H:i') }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted small">{{ __('Universities') }}</span>
                        <span class="small fw-bold text-dark">{{ $universitiesCount }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── JOBS + APPLICATIONS TABLES ── --}}
        <div class="row g-4 mb-5">
            {{-- Recent Jobs --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;background:#fffbeb;">
                                <i class="bi bi-briefcase-fill text-warning"></i>
                            </div>
                            <h5 class="mb-0 fw-bolder">{{ __('Recent Jobs') }}</h5>
                        </div>
                        <a href="{{ route('jobs.index') }}"
                            class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-bold">
                            {{ __('View All') }}
                        </a>
                    </div>
                    {{-- Jobs Filter Bar --}}
                    <div class="px-4 pb-3 pt-1 border-bottom">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="bi bi-search text-muted"></i></span>
                            <input type="text" id="jobSearch" class="form-control border-start-0 shadow-none"
                                placeholder="{{ __('Search by title or company...') }}"
                                oninput="filterTable('jobsTable','jobSearch',null)">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Job Title') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Company') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="jobsTable">
                                    @foreach($recentJobs as $job)
                                        <tr data-search="{{ strtolower($job->title . ' ' . $job->company) }}">
                                            <td class="px-4 py-3 border-0">
                                                <div class="fw-bold text-dark" style="font-size:0.88rem;">
                                                    {{ Str::limit($job->title, 30) }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                <small class="text-muted">{{ $job->company }}</small>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-end">
                                                <div class="d-flex justify-content-end gap-1">
                                                    <a href="{{ route('jobs.show', $job) }}" class="btn-mini-view"
                                                        title="{{ __('View') }}"><i class="bi bi-eye"></i></a>
                                                    <a href="{{ route('jobs.edit', $job) }}" class="btn-mini-edit"
                                                        title="{{ __('Edit') }}"><i class="bi bi-pencil"></i></a>
                                                    <form action="{{ route('jobs.destroy', $job) }}" method="POST"
                                                        class="d-inline" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn-mini-delete" title="{{ __('Delete') }}"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Applications --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;background:#fef2f2;">
                                <i class="bi bi-send-fill text-danger"></i>
                            </div>
                            <h5 class="mb-0 fw-bolder">{{ __('Recent Applications') }}</h5>
                        </div>
                        <a href="{{ route('job_applications.index') }}"
                            class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold">
                            {{ __('View All') }}
                        </a>
                    </div>
                    {{-- Applications Filter Bar --}}
                    <div class="px-4 pb-3 pt-1 border-bottom">
                        <div class="d-flex gap-2 flex-wrap">
                            <div class="input-group input-group-sm flex-grow-1" style="min-width:130px;">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-search text-muted"></i></span>
                                <input type="text" id="appSearch" class="form-control border-start-0 shadow-none"
                                    placeholder="{{ __('Search applicant or job...') }}"
                                    oninput="filterTable('appsTable','appSearch','appStatusFilter')">
                            </div>
                            <select id="appStatusFilter" class="form-select form-select-sm shadow-none"
                                style="max-width:140px;" onchange="filterTable('appsTable','appSearch','appStatusFilter')">
                                <option value="">{{ __('All Statuses') }}</option>
                                <option value="pending">{{ __('Pending') }}</option>
                                <option value="approved">{{ __('Approved') }}</option>
                                <option value="rejected">{{ __('Rejected') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Applicant') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Job') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-center">
                                            {{ __('Status') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="appsTable">
                                    @foreach($recentApplications as $app)
                                        @php
                                            $sc = ['approved' => 'success', 'rejected' => 'danger', 'pending' => 'warning'];
                                            $si = $sc[$app->status] ?? 'secondary';
                                        @endphp
                                        <tr data-search="{{ strtolower(($app->user->name ?? '') . ' ' . ($app->job->title ?? '')) }}"
                                            data-role="{{ $app->status }}">
                                            <td class="px-4 py-3 border-0">
                                                <div class="fw-bold text-dark" style="font-size:0.85rem;">
                                                    {{ $app->user->name ?? '—' }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                <small class="text-muted">{{ Str::limit($app->job->title ?? '—', 22) }}</small>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-center">
                                                <span
                                                    class="badge bg-{{ $si }}-subtle text-{{ $si }} rounded-pill fw-bold">{{ __(ucfirst($app->status)) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── FILES MANAGEMENT SECTION ── --}}
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header border-0 py-4 px-4 d-flex justify-content-between align-items-center"
                        style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 shadow-sm"
                                style="width:45px;height:45px;background:linear-gradient(135deg,#10b981,#059669);color:white;">
                                <i class="bi bi-folder-fill fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bolder text-dark">{{ __('Files Management') }}</h5>
                                <small class="text-muted">{{ $filesCount }} {{ __('total files uploaded') }}</small>
                            </div>
                        </div>
                        <a href="{{ route('admin.files.index') }}" class="btn btn-sm rounded-pill px-4 fw-bold"
                            style="background:linear-gradient(135deg,#10b981,#059669);color:white;border:none;">
                            {{ __('View All') }} <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('File') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Uploaded By') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-center">{{ __('Type') }}
                                        </th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-center">{{ __('Size') }}
                                        </th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Date') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allFiles as $file)
                                        <tr>
                                            <td class="px-4 py-3 border-0">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                        style="width:38px;height:38px;background:#f0f4f8;">
                                                        @if(strpos($file->mime_type, 'pdf') !== false)
                                                            <i class="bi bi-file-pdf text-danger"></i>
                                                        @elseif(strpos($file->mime_type, 'word') !== false || strpos($file->mime_type, 'document') !== false)
                                                            <i class="bi bi-file-word text-primary"></i>
                                                        @elseif(strpos($file->mime_type, 'image') !== false)
                                                            <i class="bi bi-image text-info"></i>
                                                        @else
                                                            <i class="bi bi-file-earmark text-muted"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark" style="font-size:0.85rem;">
                                                            {{ Str::limit($file->name, 30) }}
                                                        </div>
                                                        <small class="text-muted">{{ $file->mime_type }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($file->user->name ?? '?') }}&background=EBF4FF&color=1E40AF&size=28"
                                                        class="rounded-circle" style="width:28px;height:28px;" alt="">
                                                    <div>
                                                        <small
                                                            class="fw-semibold text-dark d-block">{{ $file->user->name ?? '—' }}</small>
                                                        @if($file->user)
                                                            <span class="badge rounded-pill px-2 fw-bold"
                                                                style="font-size:0.68rem;background:{{ $file->user->role === 'mentor' ? '#fef3c7' : '#dbeafe' }};color:{{ $file->user->role === 'mentor' ? '#d97706' : '#1d4ed8' }};">
                                                                {{ ucfirst($file->user->role) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-center">
                                                <span class="badge rounded-pill px-2 fw-bold"
                                                    style="background:#f3f4f6;color:#374151;font-size:0.72rem;">
                                                    {{ ucfirst(str_replace('_', ' ', $file->type)) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-center">
                                                @php
                                                    $bytes = $file->size;
                                                    $sizes = ['B', 'KB', 'MB', 'GB'];
                                                    $i = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
                                                    $humanSize = round($bytes / pow(1024, $i), 1) . ' ' . $sizes[$i];
                                                @endphp
                                                <small class="text-muted fw-semibold">{{ $humanSize }}</small>
                                            </td>
                                            <td class="px-4 py-3 border-0">
                                                <small class="text-muted">{{ $file->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td class="px-4 py-3 border-0 text-end">
                                                <div class="d-flex justify-content-end gap-1">
                                                    <a href="{{ route('files.show', $file) }}" target="_blank"
                                                        class="btn-mini-view" title="{{ __('View') }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('files.download', $file) }}" class="btn-mini-edit"
                                                        title="{{ __('Download') }}">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <form action="{{ route('files.destroy', $file) }}" method="POST" class="m-0"
                                                        onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn-mini-delete"
                                                            title="{{ __('Delete') }}">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox-fill opacity-25 fs-1"></i>
                                                <p class="mt-2 mb-0">{{ __('No files uploaded yet') }}</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── QUICK MANAGEMENT LINKS ── --}}
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h5 class="fw-bolder mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-lightning-fill text-warning"></i> {{ __('Quick Management') }}
                    </h5>
                    <div class="row g-3">
                        @php
                            $mgmt = [
                                ['label' => __('Users'), 'icon' => 'bi-people-fill', 'color' => '#3b82f6', 'bg' => '#eff6ff', 'link' => route('users.index'), 'count' => $usersCount],
                                ['label' => __('Jobs'), 'icon' => 'bi-briefcase-fill', 'color' => '#f59e0b', 'bg' => '#fffbeb', 'link' => route('jobs.index'), 'count' => $jobsCount],
                                ['label' => __('Trainings'), 'icon' => 'bi-book-fill', 'color' => '#06b6d4', 'bg' => '#ecfeff', 'link' => route('trainings.index'), 'count' => $trainingsCount],
                                ['label' => __('Career Paths'), 'icon' => 'bi-signpost-split-fill', 'color' => '#f97316', 'bg' => '#fff7ed', 'link' => route('career_paths.index'), 'count' => $careerPathsCount],
                                ['label' => __('Skills'), 'icon' => 'bi-star-fill', 'color' => '#ec4899', 'bg' => '#fdf4ff', 'link' => route('skills.index'), 'count' => $skillsCount],
                                ['label' => __('Universities'), 'icon' => 'bi-building-fill', 'color' => '#8b5cf6', 'bg' => '#f5f3ff', 'link' => route('universities.index'), 'count' => $universitiesCount],
                                ['label' => __('Faculties'), 'icon' => 'bi-bank2', 'color' => '#10b981', 'bg' => '#f0fdf4', 'link' => route('faculties.index'), 'count' => $facultiesCount],
                                ['label' => __('Applications'), 'icon' => 'bi-send-fill', 'color' => '#ef4444', 'bg' => '#fef2f2', 'link' => route('job_applications.index'), 'count' => $applicationsCount],
                                ['label' => __('Files'), 'icon' => 'bi-folder-fill', 'color' => '#10b981', 'bg' => '#f0fdf4', 'link' => route('admin.files.index'), 'count' => $filesCount],
                                ['label' => __('Notifications'), 'icon' => 'bi-bell-fill', 'color' => '#6366f1', 'bg' => '#f5f3ff', 'link' => route('admin.notifications.index'), 'count' => $totalNotificationsCount],
                            ];
                        @endphp
                        @foreach($mgmt as $m)
                            <div class="col-6 col-md-3">
                                <a href="{{ $m['link'] }}"
                                    class="d-flex align-items-center gap-3 p-3 rounded-4 text-decoration-none hover-lift transition-all"
                                    style="background:{{ $m['bg'] }};border:1px solid {{ $m['color'] }}15;">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:42px;height:42px;background:{{ $m['color'] }}20;">
                                        <i class="bi {{ $m['icon'] }} fs-5" style="color:{{ $m['color'] }};"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size:0.88rem;">{{ $m['label'] }}</div>
                                        <div class="fw-black" style="font-size:1.2rem;color:{{ $m['color'] }};">
                                            {{ $m['count'] }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('overviewChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['{{ __('Students') }}', '{{ __('Mentors') }}', '{{ __('Jobs') }}', '{{ __('Trainings') }}'],
                    datasets: [{
                        data: [{{ $studentsCount }}, {{ $mentorsCount }}, {{ $jobsCount }}, {{ $trainingsCount }}],
                        backgroundColor: ['#3b82f6', '#8b5cf6', '#f59e0b', '#06b6d4'],
                        borderWidth: 0,
                        hoverOffset: 6,
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '68%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { padding: 16, font: { size: 11, weight: 'bold' } }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        /**
         * filterTable(tableId, searchId, selectId)
         * ──────────────────────────────────────────
         * Instantly shows/hides <tr> rows based on:
         *   - A text input (data-search attr on each row)
         *   - An optional <select> (data-role attr on each row)
         */
        function filterTable(tableId, searchId, selectId) {
            const tbody = document.getElementById(tableId);
            if (!tbody) return;

            const query = document.getElementById(searchId)?.value.trim().toLowerCase() || '';
            const role = selectId ? (document.getElementById(selectId)?.value.toLowerCase() || '') : '';
            const rows = tbody.querySelectorAll('tr');
            let visible = 0;

            rows.forEach(row => {
                const rowSearch = (row.dataset.search || '').toLowerCase();
                const rowRole = (row.dataset.role || '').toLowerCase();

                const matchesSearch = !query || rowSearch.includes(query);
                const matchesRole = !role || rowRole === role;

                if (matchesSearch && matchesRole) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show / hide "no results" placeholder
            let noRow = tbody.querySelector('.no-results-row');
            if (visible === 0) {
                if (!noRow) {
                    noRow = document.createElement('tr');
                    noRow.className = 'no-results-row';
                    const cols = rows[0]?.querySelectorAll('td,th').length || 3;
                    noRow.innerHTML = `<td colspan="${cols}" class="text-center py-4 text-muted small">
                                            <i class="bi bi-search me-2 opacity-50"></i>{{ __('No results found.') }}
                                        </td>`;
                    tbody.appendChild(noRow);
                }
                noRow.style.display = '';
            } else if (noRow) {
                noRow.style.display = 'none';
            }
        }
    </script>

    <style>
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08) !important;
        }

        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .transition-all {
            transition: all 0.2s ease;
        }

        /* Mini action buttons */
        .btn-mini-view,
        .btn-mini-edit,
        .btn-mini-delete {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
            background: #f8fafc;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .btn-mini-view {
            color: #3b82f6;
        }

        .btn-mini-view:hover {
            background: #3b82f6;
            color: white;
        }

        .btn-mini-edit {
            color: #f59e0b;
        }

        .btn-mini-edit:hover {
            background: #f59e0b;
            color: white;
        }

        .btn-mini-delete {
            color: #ef4444;
        }

        .btn-mini-delete:hover {
            background: #ef4444;
            color: white;
        }

        /* Badge subtle variants */
        .bg-danger-subtle {
            background-color: #fee2e2 !important;
        }

        .bg-warning-subtle {
            background-color: #fef3c7 !important;
        }

        .bg-success-subtle {
            background-color: #d1fae5 !important;
        }

        .bg-primary-subtle {
            background-color: #dbeafe !important;
        }

        .text-warning {
            color: #d97706 !important;
        }

        .text-danger {
            color: #dc2626 !important;
        }

        .text-success {
            color: #059669 !important;
        }

        .fw-black {
            font-weight: 900;
        }
    </style>
@endsection