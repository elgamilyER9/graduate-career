@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="display-6 fw-bolder mb-2">
                    <i class="bi bi-bell-fill me-2 text-primary"></i>{{ __('Notifications') }}
                </h2>
                <p class="text-muted">{{ __('Stay updated with all your activities') }}</p>
            </div>
            @if($notifications->count() > 0)
                <div class="d-flex gap-2">
                    <form action="{{ route('notifications.read.all') }}" method="POST" class="d-inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill" title="{{ __('Mark all as read') }}">
                            <i class="bi bi-check-all me-1"></i>{{ __('Mark all as read') }}
                        </button>
                    </form>
                    <form action="{{ route('notifications.clear') }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" title="{{ __('Clear all') }}">
                            <i class="bi bi-trash3 me-1"></i>{{ __('Clear all') }}
                        </button>
                    </form>
                </div>
            @endif
        </div>

        {{-- Notifications List --}}
        <div class="row">
            <div class="col-lg-8">
                @forelse($notifications as $notification)
                    <div class="card border-0 rounded-4 shadow-sm mb-3 notification-item {{ $notification->read ? 'opacity-75' : 'bg-light' }}" 
                         style="border-left: 4px solid #{{ $notification->read ? 'ddd' : '0d6efd' }} !important;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-start gap-3 flex-grow-1">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:48px;height:48px;background:{{ $notification->read ? '#e9ecef' : '#e7f1ff' }};">
                                        <i class="bi {!! \App\Services\NotificationService::getIcon($notification->type) !!}" 
                                           style="font-size:1.5rem;color:{{ $notification->read ? '#6c757d' : '#0d6efd' }};"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <h5 class="mb-0 fw-bold">{{ $notification->title }}</h5>
                                            @if(!$notification->read)
                                                <span class="badge bg-primary rounded-pill">{{ __('New') }}</span>
                                            @endif
                                        </div>
                                        <p class="text-muted mb-1">{{ $notification->description }}</p>
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                                <div class="dropdown flex-shrink-0">
                                    <button class="btn btn-sm btn-ghost" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if(!$notification->read)
                                            <li>
                                                <form action="{{ route('notifications.read', $notification) }}" method="POST" class="d-inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bi bi-check-circle me-2"></i>{{ __('Mark as read') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                        <li>
                                            <form action="{{ route('notifications.destroy', $notification) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bi bi-trash3 me-2"></i>{{ __('Delete') }}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- Show related data if exists --}}
                            @if($notification->data && count($notification->data) > 0)
                                <div class="alert alert-sm alert-light border-0 mt-2 p-2 mb-0">
                                    @if(isset($notification->data['job_id']))
                                        <a href="{{ route('jobs.show', $notification->data['job_id']) }}" class="text-decoration-none">
                                            <i class="bi bi-arrow-right me-1"></i>{{ __('View Details') }}
                                        </a>
                                    @elseif(isset($notification->data['mentorship_id']))
                                        <a href="#" class="text-decoration-none">
                                            <i class="bi bi-arrow-right me-1"></i>{{ __('View Details') }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="card border-0 rounded-4 shadow-sm p-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-inbox-fill" style="font-size:4rem;color:#d3d3d3;"></i>
                        </div>
                        <h5 class="fw-bold text-muted mb-2">{{ __('No notifications') }}</h5>
                        <p class="text-muted small mb-0">{{ __('You\'re all caught up! Check back later for updates.') }}</p>
                    </div>
                @endforelse

                {{-- Pagination --}}
                @if($notifications->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="card border-0 rounded-4 shadow-sm p-4 sticky-top" style="top: 20px;">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-funnel me-2"></i>{{ __('Filter') }}
                    </h6>
                    <div class="list-group list-group-flush">
                        @php
                            $types = \App\Services\NotificationService::types();
                        @endphp
                        @foreach($types as $key => $label)
                            <a href="#" class="list-group-item list-group-item-action border-0 px-0 py-2">
                                <i class="bi {!! \App\Services\NotificationService::getIcon($key) !!} me-2 opacity-50"></i>
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-ghost {
            background: transparent;
            border: none;
            color: #6c757d;
            padding: 0.25rem 0.5rem;
            cursor: pointer;
        }

        .btn-ghost:hover {
            color: #495057;
        }

        .notification-item {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notification-item:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .dropdown-menu {
            border-radius: 0.75rem;
            border: 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            border-radius: 0.5rem;
            margin: 0.25rem 0.5rem;
            padding: 0.5rem 0.75rem;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection
