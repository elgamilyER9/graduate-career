@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
            <div>
                <h2 class="fw-bold text-dark mb-1">{{ __('Trainings & Courses') }}</h2>
                <p class="text-muted mb-0">{{ __('Manage specialized trainings and courses for students.') }}</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <form action="{{ route('trainings.index') }}" method="GET" class="d-flex align-items-center gap-2">
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                        <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-0 px-2"
                            placeholder="{{ __('Search trainings...') }}" value="{{ request('search') }}"
                            style="min-width: 250px;">
                        @if(request('search'))
                            <a href="{{ route('trainings.index') }}" class="btn btn-white border-0 bg-white text-muted"
                                title="{{ __('Clear search') }}">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                        <button class="btn btn-primary px-3 border-0" type="submit">{{ __('Search') }}</button>
                    </div>
                </form>
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'mentor')
                    <a href="{{ route('trainings.create') }}"
                        class="btn btn-primary rounded-3 px-4 py-2 fw-semibold shadow-sm text-nowrap">
                        <i class="bi bi-plus-lg me-2"></i> {{ __('Add New Training') }}
                    </a>
                @endif
            </div>
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
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('TITLE') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('MENTOR') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('PROVIDER') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('CAREER PATH') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('ACTIONS') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trainings as $training)
                                <tr>
                                    <td class="px-4 py-3 border-0 fw-bold text-dark">
                                        <a href="{{ route('trainings.show', $training) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $training->name ?? $training->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-muted">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">
                                            {{ $training->mentor->name ?? __('N/A') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-muted small">{{ $training->provider ?? __('N/A') }}</td>
                                    <td class="px-4 py-3 border-0">
                                        <span
                                            class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2 fw-medium">
                                            {{ $training->careerPath->name ?? __('N/A') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('trainings.show', $training) }}"
                                                class="btn btn-light rounded-start-3 p-2 text-primary border-0 shadow-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if(auth()->user()->id === $training->mentor_id || auth()->user()->role === 'admin')
                                                <a href="{{ route('trainings.edit', $training) }}"
                                                    class="btn btn-light p-2 text-warning border-0 shadow-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('trainings.destroy', $training) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-light rounded-end-3 p-2 text-danger border-0 shadow-sm"
                                                        onclick="return confirm('{{ __('Are you sure?') }}')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted small">{{ __('No trainings found.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection