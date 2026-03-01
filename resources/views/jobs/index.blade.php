@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="row align-items-center mb-5 animate__animated animate__fadeIn">
            <div class="col-12 col-md-4">
                <h2 class="fw-bold text-dark mb-1">{{ __('Job Listings') }}</h2>
                <p class="text-muted mb-0 small">{{ __('Manage and browse all job opportunities.') }}</p>
            </div>
            <div class="col-12 col-md-8 mt-3 mt-md-0">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-md-end align-items-center">
                    <!-- Premium Search Bar -->
                    <form action="{{ route('jobs.index') }}" method="GET" class="flex-grow-1 w-100"
                        style="max-width: 500px;">
                        <div class="input-group bg-white shadow-sm rounded-pill overflow-hidden border">
                            <span class="input-group-text bg-white border-0 ps-3">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-0 shadow-none py-2"
                                placeholder="{{ __('Search for jobs or companies...') }}" value="{{ $search ?? '' }}">
                            @if($search)
                                <a href="{{ route('jobs.index') }}" class="btn btn-white border-0 text-muted px-2">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                            <button class="btn btn-primary px-4 fw-bold" type="submit">{{ __('Search') }}</button>
                        </div>
                    </form>

                    <!-- Add Job Button (Restricted) -->
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'mentor')
                        <a href="{{ route('jobs.create') }}"
                            class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm hover-translate-y-n2 transition-all">
                            <i class="bi bi-plus-lg me-2"></i> {{ __('Add New Job') }}
                        </a>
                    @endif
                </div>
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
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('JOB TITLE') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('COMPANY') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('MENTOR') }}</th>
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
                                        <div class="d-flex align-items-center">
                                            @php
                                                $mentorName = $job->mentor->name ?? __('Admin');
                                                $initial = strtoupper(mb_substr($mentorName, 0, 1));
                                            @endphp
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2 flex-shrink-0"
                                                style="width: 32px; height: 32px; font-size: 0.8rem;">
                                                {{ $initial }}
                                            </div>
                                            <span class="fw-medium text-dark small">{{ $mentorName }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <span
                                            class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium">
                                            {{ $job->careerPath->name ?? __('N/A') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-2 align-items-center">
                                            @if(auth()->user()->role === 'user')
                                                @php
                                                    $status = $myApplications[$job->id] ?? null;
                                                @endphp
                                                @if($status)
                                                    @php
                                                        $badgeClass = 'bg-secondary';
                                                        $statusText = __('Applied');
                                                        if ($status == 'approved') {
                                                            $badgeClass = 'bg-success';
                                                            $statusText = __('Accepted');
                                                        } elseif ($status == 'rejected') {
                                                            $badgeClass = 'bg-danger';
                                                            $statusText = __('Rejected');
                                                        } elseif ($status == 'pending') {
                                                            $badgeClass = 'bg-warning text-dark';
                                                            $statusText = __('Pending');
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 small me-2">
                                                        {{ $statusText }}
                                                    </span>
                                                @endif
                                            @endif

                                            @if(auth()->user()->role === 'user' && !isset($myApplications[$job->id]))
                                                <form action="{{ route('job_applications.store', $job) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm rounded-3 px-3 py-1 shadow-sm"
                                                        title="{{ __('Apply') }}">
                                                        <i class="bi bi-send me-1"></i> {{ __('Apply') }}
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('jobs.show', $job) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-primary border-0 shadow-sm"
                                                title="{{ __('View') }}">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'mentor' && auth()->user()->id === $job->mentor_id))
                                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-light btn-sm rounded-3 p-2 text-danger border-0 shadow-sm"
                                                        onclick="return confirm('{{ __('Are you sure?') }}')"
                                                        title="{{ __('Delete') }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'mentor' && auth()->user()->id === $job->mentor_id))
                                                <a href="{{ route('jobs.edit', $job) }}"
                                                    class="btn btn-light btn-sm rounded-3 p-2 text-warning border-0 shadow-sm"
                                                    title="{{ __('Edit') }}">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted small">{{ __('No jobs found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection