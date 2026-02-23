@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">{{ __('Job Listings') }}</h2>
                <p class="text-muted mb-0">{{ __('Manage and browse all job opportunities.') }}</p>
            </div>
            <a href="{{ route('jobs.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> {{ __('Add New Job') }}
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
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('JOB TITLE') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('COMPANY') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('CAREER PATH') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('ACTIONS') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jobs as $job)
                                <tr>
                                    <td class="px-4 py-3 border-0 fw-bold text-dark">{{ $job->title }}</td>
                                    <td class="px-4 py-3 border-0 text-muted">{{ $job->company }}</td>
                                    <td class="px-4 py-3 border-0">
                                        <span
                                            class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium">
                                            {{ $job->careerPath->name ?? __('N/A') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('jobs.show', $job) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-primary border-0 shadow-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('jobs.edit', $job) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-warning border-0 shadow-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-light btn-sm rounded-3 p-2 text-danger border-0 shadow-sm"
                                                    onclick="return confirm('{{ __('Are you sure?') }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted small">{{ __('No jobs found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection