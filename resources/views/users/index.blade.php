@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="d-flex align-items-center justify-content-between mb-4 animate__animated animate__fadeInDown">
            <div>
                <h2 class="fw-bold text-dark mb-1">User Management</h2>
                <p class="text-muted mb-0">Manage all registered users and their details.</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Add New User
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 animate__animated animate__fadeInUp">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">USER</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">ROLE</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">UNIVERSITY / FACULTY</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">CAREER PATH</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3 d-flex align-items-center justify-content-center"
                                                style="width: 48px; height: 48px;">
                                                <i class="bi bi-person h4 mb-0"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                                <div class="text-muted small">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <span
                                            class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'info' }}-subtle text-{{ $user->role == 'admin' ? 'danger' : 'info' }} border border-{{ $user->role == 'admin' ? 'danger' : 'info' }}-subtle rounded-pill px-3 py-2 fw-medium">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        @if($user->university)
                                            <div class="fw-semibold text-dark">{{ $user->university->name }}</div>
                                            <div class="text-muted small">{{ $user->faculty->name ?? 'N/A' }}</div>
                                        @else
                                            <span class="text-muted">Not Set</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <span class="text-dark">{{ $user->careerPath->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('users.show', $user) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-primary border-0 shadow-sm transition-hover">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-warning border-0 shadow-sm transition-hover">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-light btn-sm rounded-3 p-2 text-danger border-0 shadow-sm transition-hover"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted small">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .rounded-4 {
            border-radius: 1rem !important;
        }

        .transition-hover {
            transition: all 0.3s ease;
        }

        .transition-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1) !important;
        }

        .bg-primary-subtle {
            background-color: #cfe2ff !important;
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