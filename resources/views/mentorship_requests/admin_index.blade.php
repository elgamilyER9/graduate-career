@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">
        {{-- Header --}}
        <div class="rounded-5 p-5 mb-5 position-relative overflow-hidden animate__animated animate__fadeIn"
            style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%); color:white; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
            <div class="position-relative">
                <h2 class="display-6 fw-bolder mb-2">
                    <i class="bi bi-person-heart-fill me-2 text-warning"></i>{{ __('Mentorship Requests Management') }}
                </h2>
                <p class="text-white-50 mb-0">
                    {{ __('Manage and monitor all mentorship connections across the platform.') }}
                </p>
            </div>
        </div>

        {{-- Stats Row --}}
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-xl-4 col-12">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3"
                    style="background:#fffbeb; border:1px solid #f59e0b20 !important;">
                    <div class="card-body d-flex align-items-center gap-4">
                        <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                            style="width:54px;height:54px;background:#fef3c7;">
                            <i class="bi bi-clock-history fs-2 text-warning"></i>
                        </div>
                        <div>
                            <h2 class="fw-black text-warning mb-0">{{ $pendingCount }}</h2>
                            <p class="text-muted small mb-0 fw-semibold">{{ __('Pending Requests') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 col-12">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3"
                    style="background:#f0fdf4; border:1px solid #10b98120 !important;">
                    <div class="card-body d-flex align-items-center gap-4">
                        <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                            style="width:54px;height:54px;background:#d1fae5;">
                            <i class="bi bi-check-all fs-2 text-success"></i>
                        </div>
                        <div>
                            <h2 class="fw-black text-success mb-0">{{ $requests->where('status', 'approved')->count() }}
                            </h2>
                            <p class="text-muted small mb-0 fw-semibold">{{ __('Approved Requests (This Page)') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 col-12">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3"
                    style="background:#eff6ff; border:1px solid #3b82f620 !important;">
                    <div class="card-body d-flex align-items-center gap-4">
                        <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                            style="width:54px;height:54px;background:#dbeafe;">
                            <i class="bi bi-collection-fill fs-2 text-primary"></i>
                        </div>
                        <div>
                            <h2 class="fw-black text-primary mb-0">{{ $totalCount }}</h2>
                            <p class="text-muted small mb-0 fw-semibold">{{ __('Total Requests') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Table Section --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-4 px-4">
                <form action="{{ route('admin.mentorship_requests.index') }}" method="GET"
                    class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-0"
                                placeholder="{{ __('Search for Student or Mentor Name...') }}"
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select bg-light border-0">
                            <option value="">{{ __('All Statuses') }}</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                {{ __('Pending') }}</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>
                                {{ __('Approved') }}</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>
                                {{ __('Rejected') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">
                            <i class="bi bi-filter me-1"></i> {{ __('Filter') }}
                        </button>
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="{{ route('admin.mentorship_requests.index') }}"
                            class="btn btn-link text-muted fw-bold text-decoration-none">
                            {{ __('Clear All') }}
                        </a>
                    </div>
                </form>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-uppercase">{{ __('Student') }}
                                </th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-uppercase">{{ __('Mentor') }}
                                </th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-uppercase text-center">
                                    {{ __('Status') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-uppercase">{{ __('Message') }}
                                </th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-uppercase">{{ __('Date') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-uppercase text-end">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                                <tr>
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($request->student->name ?? '?') }}&background=EBF4FF&color=1E40AF&size=36"
                                                class="rounded-circle shadow-sm" style="width:36px;height:36px;" alt="">
                                            <div>
                                                <div class="fw-bold text-dark mb-0">{{ $request->student->name ?? '—' }}</div>
                                                <small class="text-muted">{{ $request->student->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($request->mentor->name ?? '?') }}&background=F5F3FF&color=5B21B6&size=36"
                                                class="rounded-circle shadow-sm" style="width:36px;height:36px;" alt="">
                                            <div>
                                                <div class="fw-bold text-dark mb-0 text-nowrap">
                                                    {{ $request->mentor->name ?? '—' }}</div>
                                                <small class="text-muted">{{ __('Mentor') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-center">
                                        @php
                                            $sc = ['approved' => 'success', 'rejected' => 'danger', 'pending' => 'warning'];
                                            $si = $sc[$request->status] ?? 'secondary';
                                        @endphp
                                        <span
                                            class="badge bg-{{ $si }}-subtle text-{{ $si }} border border-{{ $si }} border-opacity-25 rounded-pill px-3 py-1 fw-bold">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <small class="text-muted" title="{{ $request->message }}">
                                            {{ Str::limit($request->message, 40) ?: '—' }}
                                        </small>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <small class="text-muted fw-medium">{{ $request->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-1">
                                            @if($request->status === 'pending')
                                                <form action="{{ route('mentorship_requests.update', $request) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button class="btn btn-sm btn-outline-success border-0 rounded-3 p-2"
                                                        title="{{ __('Approve') }}">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('mentorship_requests.update', $request) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-sm btn-outline-danger border-0 rounded-3 p-2"
                                                        title="{{ __('Reject') }}">
                                                        <i class="bi bi-x-circle-fill"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('mentorship_requests.destroy', $request) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('{{ __('Are you sure you want to delete this request?') }}')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-dark border-0 rounded-3 p-2"
                                                    title="{{ __('Delete') }}">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="p-4 rounded-4"
                                            style="background:#f8fafc; display:inline-block; min-width:300px;">
                                            <i class="bi bi-inbox-fill text-muted opacity-25" style="font-size:3rem;"></i>
                                            <h6 class="mt-3 fw-bold text-muted">
                                                {{ __('No requests found matching your filters.') }}</h6>
                                            <a href="{{ route('admin.mentorship_requests.index') }}"
                                                class="btn btn-sm btn-link mt-2 text-decoration-none fw-bold">
                                                {{ __('Show all requests') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($requests->hasPages())
                <div class="card-footer bg-white border-0 py-4 px-4">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .bg-success-subtle {
            background-color: #d1fae5 !important;
        }

        .bg-danger-subtle {
            background-color: #fee2e2 !important;
        }

        .bg-warning-subtle {
            background-color: #fef3c7 !important;
        }

        .text-success {
            color: #059669 !important;
        }

        .text-danger {
            color: #dc2626 !important;
        }

        .text-warning {
            color: #d97706 !important;
        }

        .fw-black {
            font-weight: 900;
        }

        .btn-outline-success:hover {
            background-color: #059669 !important;
            color: white !important;
        }

        .btn-outline-danger:hover {
            background-color: #dc2626 !important;
            color: white !important;
        }

        .btn-outline-dark:hover {
            background-color: #1e293b !important;
            color: white !important;
        }
    </style>
@endsection