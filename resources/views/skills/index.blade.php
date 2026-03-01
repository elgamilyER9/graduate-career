@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">Skills Database</h2>
                <p class="text-muted mb-0">Manage technical and soft skills required for different career paths.</p>
            </div>
            <a href="{{ route('skills.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Add New Skill
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">SKILL NAME</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">CAREER PATH</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($skills as $skill)
                                <tr>
                                    <td class="px-4 py-3 border-0 fw-bold text-dark">{{ $skill->name }}</td>
                                    <td class="px-4 py-3 border-0">
                                        <span
                                            class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3 py-2 fw-medium">
                                            {{ $skill->careerPath->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('skills.edit', $skill) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-warning border-0 shadow-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if(auth()->user()->role === 'admin')
                                            <form action="{{ route('skills.destroy', $skill) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-light btn-sm rounded-3 p-2 text-danger border-0 shadow-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted small">No skills found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection