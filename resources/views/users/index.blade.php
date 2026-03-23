@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">

        {{-- Header --}}
        <div
            class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3 animate__animated animate__fadeInDown">
            <div>
                <h2 class="fw-bolder text-dark mb-1">{{ __('User Management') }}</h2>
                <p class="text-muted mb-0 small">{{ __('Manage all registered users and their details.') }}</p>
            </div>
            <a href="{{ route('users.create') }}"
                class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm hover-scale">
                <i class="bi bi-person-plus me-2"></i>{{ __('Add New User') }}
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 animate__animated animate__fadeIn mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Role Filter Tabs --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 animate__animated animate__fadeInUp">
            <div class="card-body p-3">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    {{-- Stats tabs --}}
                    @php
                        $tabs = [
                            ['key' => '', 'label' => __('All Users'), 'icon' => 'bi-people-fill', 'color' => '#3b82f6', 'count' => $counts['all']],
                            ['key' => 'admin', 'label' => __('Admins'), 'icon' => 'bi-shield-fill-check', 'color' => '#ef4444', 'count' => $counts['admin']],
                            ['key' => 'mentor', 'label' => __('Mentors'), 'icon' => 'bi-person-badge-fill', 'color' => '#8b5cf6', 'count' => $counts['mentor']],
                            ['key' => 'user', 'label' => __('Students'), 'icon' => 'bi-mortarboard-fill', 'color' => '#10b981', 'count' => $counts['user']],
                        ];
                    @endphp
                    @foreach($tabs as $tab)
                        @php $active = ($role ?? '') === $tab['key']; @endphp
                        <a href="{{ route('users.index', array_merge(request()->except('role', 'page'), $tab['key'] ? ['role' => $tab['key']] : [])) }}"
                            class="d-flex align-items-center gap-2 px-4 py-2 rounded-pill text-decoration-none fw-semibold transition-all"
                            style="background: {{ $active ? $tab['color'] : '#f8fafc' }};
                                      color:{{ $active ? 'white' : '#64748b' }};
                                      border: 1.5px solid {{ $active ? $tab['color'] : '#e2e8f0' }};
                                      font-size:0.88rem;">
                            <i class="bi {{ $tab['icon'] }}"></i>
                            {{ $tab['label'] }}
                            <span class="badge rounded-pill fw-bold" style="background:{{ $active ? 'rgba(255,255,255,0.25)' : $tab['color'] . '20' }};
                                             color:{{ $active ? 'white' : $tab['color'] }};
                                             font-size:0.72rem;">
                                {{ $tab['count'] }}
                            </span>
                        </a>
                    @endforeach

                    {{-- Search --}}
                    <form action="{{ route('users.index') }}" method="GET" class="ms-auto d-flex gap-2 align-items-center">
                        @if($role)<input type="hidden" name="role" value="{{ $role }}">@endif
                        <div class="input-group input-group-sm shadow-sm" style="min-width:220px;">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 shadow-none"
                                placeholder="{{ __('Search by name or email...') }}" value="{{ $search ?? '' }}">
                            @if($search ?? false)
                                <a href="{{ route('users.index', $role ? ['role' => $role] : []) }}"
                                    class="btn btn-outline-secondary border-0"><i class="bi bi-x"></i></a>
                            @endif
                            <button class="btn btn-primary px-3" type="submit">{{ __('Go') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Users Table --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate__animated animate__fadeInUp">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('USER') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('ROLE') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('UNIVERSITY / FACULTY') }}
                                </th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('CAREER PATH') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('ACTIONS') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                @php
                                    $roleColors = ['admin' => '#ef4444', 'mentor' => '#8b5cf6', 'user' => '#10b981'];
                                    $roleBgs = ['admin' => '#fee2e2', 'mentor' => '#f5f3ff', 'user' => '#d1fae5'];
                                    $rc = $roleColors[$user->role] ?? '#64748b';
                                    $rb = $roleBgs[$user->role] ?? '#f1f5f9';
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=EBF4FF&color=1E40AF&size=40"
                                                class="rounded-circle shadow-sm flex-shrink-0" style="width:40px;height:40px;"
                                                alt="">
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size:0.9rem;">{{ $user->name }}</div>
                                                <div class="text-muted small">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <span class="badge rounded-pill fw-bold px-3 py-2"
                                            style="background:{{ $rb }};color:{{ $rc }};font-size:0.75rem;">
                                            <i
                                                class="bi {{ $user->role === 'admin' ? 'bi-shield-fill-check' : ($user->role === 'mentor' ? 'bi-person-badge-fill' : 'bi-mortarboard-fill') }} me-1"></i>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        @if($user->university)
                                            <div class="fw-semibold text-dark small">{{ $user->university->name }}</div>
                                            <div class="text-muted small">{{ $user->faculty->name ?? __('N/A') }}</div>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        @if($user->careerPath)
                                            <span class="badge bg-primary-subtle text-primary rounded-pill px-2 fw-medium"
                                                style="font-size:0.75rem;">
                                                {{ $user->careerPath->name }}
                                            </span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('users.show', $user) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-primary border-0 shadow-sm transition-hover"
                                                title="{{ __('View') }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if(auth()->user()->role === 'admin')
                                                <a href="{{ route('users.edit', $user) }}"
                                                    class="btn btn-light btn-sm rounded-3 p-2 text-warning border-0 shadow-sm transition-hover"
                                                    title="{{ __('Edit') }}">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('messages.show', $user) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-info border-0 shadow-sm transition-hover"
                                                title="{{ __('Message') }}">
                                                <i class="bi bi-chat-dots"></i>
                                            </a>
                                            @if(auth()->user()->role === 'admin')
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                    @csrf @method('DELETE')
                                                    <button
                                                        class="btn btn-light btn-sm rounded-3 p-2 text-danger border-0 shadow-sm transition-hover"
                                                        title="{{ __('Delete') }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle"
                                            style="width:60px;height:60px;background:#f1f5f9;">
                                            <i class="bi bi-people fs-3 text-muted opacity-50"></i>
                                        </div>
                                        <p class="text-muted fw-medium mb-1">{{ __('No users found.') }}</p>
                                        @if($search || $role)
                                            <a href="{{ route('users.index') }}"
                                                class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                <i class="bi bi-x me-1"></i>{{ __('Clear filters') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <style>
        .hover-scale {
            transition: transform 0.18s ease;
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .transition-all {
            transition: all 0.18s ease;
        }

        .transition-hover {
            transition: all 0.2s ease;
        }

        .transition-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
        }

        .bg-primary-subtle {
            background-color: #dbeafe !important;
        }
    </style>
@endsection