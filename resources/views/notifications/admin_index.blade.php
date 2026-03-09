@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        {{-- Header --}}
        <div class="rounded-5 p-4 mb-5 position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%); color:white; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
            <div class="row align-items-center g-4">
                <div class="col-md-8">
                    <span class="badge rounded-pill px-3 py-2 mb-3 fw-bold text-uppercase"
                        style="background:rgba(99,102,241,0.2);color:#a5b4fc;border:1px solid rgba(99,102,241,0.3);font-size:0.7rem;">
                        <i class="bi bi-shield-fill-check me-1"></i>{{ __('Admin Panel') }}
                    </span>
                    <h2 class="display-6 fw-bolder mb-2">
                        <i class="bi bi-bell-fill me-2 text-warning"></i>{{ __('All Notifications') }}
                    </h2>
                    <p class="text-white-50 mb-0">{{ __('Manage all platform notifications') }}</p>
                </div>
                <div class="col-md-4 text-end d-none d-md-block">
                    <i class="bi bi-bell-fill text-warning opacity-10" style="font-size:7rem;"></i>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card border-0 rounded-4 shadow-sm p-3"
                    style="background:#f8f9ff;border-left:4px solid #6366f1 !important;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;background:#e0e7ff;">
                            <i class="bi bi-bell-fill text-primary"></i>
                        </div>
                        <div>
                            <div class="fw-black fs-4" style="color:#6366f1;">{{ $totalCount }}</div>
                            <div class="text-muted small fw-semibold">{{ __('Total') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 rounded-4 shadow-sm p-3"
                    style="background:#fff7ed;border-left:4px solid #f97316 !important;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;background:#fed7aa;">
                            <i class="bi bi-envelope-fill" style="color:#f97316;"></i>
                        </div>
                        <div>
                            <div class="fw-black fs-4" style="color:#f97316;">{{ $unreadCount }}</div>
                            <div class="text-muted small fw-semibold">{{ __('Unread') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 rounded-4 shadow-sm p-3"
                    style="background:#f0fdf4;border-left:4px solid #10b981 !important;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;background:#d1fae5;">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        <div>
                            <div class="fw-black fs-4 text-success">{{ $totalCount - $unreadCount }}</div>
                            <div class="text-muted small fw-semibold">{{ __('Read') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('home') }}"
                    class="card border-0 rounded-4 shadow-sm p-3 text-decoration-none h-100 d-flex align-items-center"
                    style="background:#eff6ff;">
                    <div class="d-flex align-items-center gap-3 w-100">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;background:#dbeafe;">
                            <i class="bi bi-arrow-left-circle-fill text-primary"></i>
                        </div>
                        <div class="fw-bold text-primary">{{ __('Back to Dashboard') }}</div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center gap-3"
                style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);border-left:4px solid #10b981 !important;">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <span class="fw-semibold text-success">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Filters --}}
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('admin.notifications.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">{{ __('Search') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 shadow-none"
                                placeholder="{{ __('Title, description or user name...') }}"
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small text-muted">{{ __('Status') }}</label>
                        <select name="read" class="form-select shadow-none">
                            <option value="">{{ __('All') }}</option>
                            <option value="0" {{ request('read') === '0' ? 'selected' : '' }}>{{ __('Unread') }}</option>
                            <option value="1" {{ request('read') === '1' ? 'selected' : '' }}>{{ __('Read') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-3 flex-grow-1">
                            <i class="bi bi-funnel me-1"></i>{{ __('Filter') }}
                        </button>
                        <a href="{{ route('admin.notifications.index') }}" class="btn btn-outline-secondary rounded-3">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Notifications Table --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bolder d-flex align-items-center gap-2">
                    <i class="bi bi-bell-fill text-primary"></i>
                    {{ __('Notifications') }}
                    <span
                        class="badge bg-primary-subtle text-primary rounded-pill ms-1">{{ $notifications->total() }}</span>
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Notification') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('User') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-center">{{ __('Status') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Date') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notifications as $notification)
                                <tr style="{{ !$notification->read ? 'background:#fafbff;' : '' }}">
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width:40px;height:40px;background:{{ !$notification->read ? '#e0e7ff' : '#f3f4f6' }};">
                                                <i class="bi {{ \App\Services\NotificationService::getIcon($notification->type) }}"
                                                    style="color:{{ !$notification->read ? '#6366f1' : '#9ca3af' }};font-size:1.1rem;"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark mb-0" style="font-size:0.88rem;">
                                                    {{ $notification->title }}
                                                </div>
                                                <small
                                                    class="text-muted">{{ Str::limit($notification->description, 60) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($notification->user->name ?? '?') }}&background=EBF4FF&color=1E40AF&size=30"
                                                class="rounded-circle" style="width:30px;height:30px;" alt="">
                                            <div>
                                                <div class="fw-semibold text-dark" style="font-size:0.83rem;">
                                                    {{ $notification->user->name ?? '—' }}</div>
                                                <small class="text-muted">{{ $notification->user->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-center">
                                        @if(!$notification->read)
                                            <span class="badge rounded-pill px-3 py-1 fw-bold"
                                                style="background:#e0e7ff;color:#6366f1;">
                                                <i class="bi bi-circle-fill me-1"
                                                    style="font-size:6px;vertical-align:middle;"></i>{{ __('Unread') }}
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-light text-muted rounded-pill px-3 py-1 fw-bold">{{ __('Read') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-1">
                                            @if(!$notification->read)
                                                <form action="{{ route('notifications.read', $notification) }}" method="POST"
                                                    class="m-0">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn-mini-view" title="{{ __('Mark as read') }}">
                                                        <i class="bi bi-check2"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('notifications.destroy', $notification) }}" method="POST"
                                                class="m-0" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-mini-delete" title="{{ __('Delete') }}">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox-fill" style="font-size:3rem;opacity:0.3;"></i>
                                        <p class="mt-2 mb-0 fw-semibold">{{ __('No notifications found') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($notifications->hasPages())
                <div class="card-footer bg-white border-0 py-3 px-4">
                    {{ $notifications->withQueryString()->links() }}
                </div>
            @endif
        </div>

    </div>

    <style>
        .btn-mini-view,
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
            color: #6366f1;
        }

        .btn-mini-view:hover {
            background: #6366f1;
            color: white;
        }

        .btn-mini-delete {
            color: #ef4444;
        }

        .btn-mini-delete:hover {
            background: #ef4444;
            color: white;
        }

        .bg-primary-subtle {
            background-color: #dbeafe !important;
        }
    </style>
@endsection