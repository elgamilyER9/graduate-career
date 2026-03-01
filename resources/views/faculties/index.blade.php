@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">

        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <h2 class="fw-bolder text-dark mb-1">{{ __('Faculties') }}</h2>
                <p class="text-muted mb-0 small">{{ __('Manage faculties for universities.') }}</p>
            </div>
            <a href="{{ route('faculties.create') }}"
                class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm hover-scale">
                <i class="bi bi-plus-lg me-2"></i>{{ __('Add Faculty') }}
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">{{ session('success') }}</div>
        @endif

        {{-- Filter Bar --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    {{-- All tab --}}
                    <a href="{{ route('faculties.index', $search ? ['search' => $search] : []) }}"
                        class="d-flex align-items-center gap-2 px-4 py-2 rounded-pill text-decoration-none fw-semibold transition-all"
                        style="background: {{ !$universityId ? '#10b981' : '#f8fafc' }};
                              color: {{ !$universityId ? 'white' : '#64748b' }};
                              border: 1.5px solid {{ !$universityId ? '#10b981' : '#e2e8f0' }};
                              font-size:0.88rem;">
                        <i class="bi bi-bank2"></i>
                        {{ __('All Faculties') }}
                        <span class="badge rounded-pill fw-bold" style="background: {{ !$universityId ? 'rgba(255,255,255,0.25)' : '#d1fae520' }};
                                     color: {{ !$universityId ? 'white' : '#10b981' }};
                                     font-size:0.72rem;">{{ $counts['all'] }}</span>
                    </a>
                    {{-- Per university tabs --}}
                    @foreach($universities as $uni)
                        @php $uActive = (string) $universityId === (string) $uni->id; @endphp
                        <a href="{{ route('faculties.index', array_merge($search ? ['search' => $search] : [], ['university_id' => $uni->id])) }}"
                            class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill text-decoration-none fw-semibold transition-all"
                            style="background: {{ $uActive ? '#3b82f6' : '#f8fafc' }};
                                      color: {{ $uActive ? 'white' : '#64748b' }};
                                      border: 1.5px solid {{ $uActive ? '#3b82f6' : '#e2e8f0' }};
                                      font-size:0.82rem;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            <i class="bi bi-building flex-shrink-0"></i>
                            <span class="text-truncate">{{ Str::limit($uni->name, 22) }}</span>
                            <span class="badge rounded-pill fw-bold flex-shrink-0" style="background: {{ $uActive ? 'rgba(255,255,255,0.25)' : '#dbeafe' }};
                                             color: {{ $uActive ? 'white' : '#3b82f6' }};
                                             font-size:0.68rem;">{{ $counts[$uni->id] ?? 0 }}</span>
                        </a>
                    @endforeach

                    {{-- Search --}}
                    <form action="{{ route('faculties.index') }}" method="GET" class="ms-auto d-flex gap-2">
                        @if($universityId)<input type="hidden" name="university_id" value="{{ $universityId }}">@endif
                        <div class="input-group input-group-sm shadow-sm" style="min-width:200px;">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 shadow-none"
                                placeholder="{{ __('Search faculty name...') }}" value="{{ $search ?? '' }}">
                            @if($search)
                                <a href="{{ route('faculties.index', $universityId ? ['university_id' => $universityId] : []) }}"
                                    class="btn btn-outline-secondary border-0"><i class="bi bi-x"></i></a>
                            @endif
                            <button class="btn btn-primary px-3" type="submit">{{ __('Go') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('FACULTY NAME') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('UNIVERSITY') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('ACTIONS') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faculties as $faculty)
                                <tr>
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width:36px;height:36px;background:#d1fae5;">
                                                <i class="bi bi-mortarboard-fill text-success"></i>
                                            </div>
                                            <span class="fw-bold text-dark">{{ $faculty->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <span class="badge rounded-pill px-3 py-2 fw-medium"
                                            style="background:#dbeafe;color:#1d4ed8;font-size:0.78rem;">
                                            <i class="bi bi-building me-1"></i>{{ $faculty->university->name ?? '—' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('faculties.edit', $faculty) }}"
                                                class="btn btn-light btn-sm rounded-3 p-2 text-warning border-0 shadow-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if(auth()->user()->role === 'admin')
                                                <form action="{{ route('faculties.destroy', $faculty) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                    @csrf @method('DELETE')
                                                    <button
                                                        class="btn btn-light btn-sm rounded-3 p-2 text-danger border-0 shadow-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <div class="mb-2 opacity-50"><i class="bi bi-bank2 fs-2 text-muted"></i></div>
                                        <p class="text-muted mb-2">{{ __('No faculties found.') }}</p>
                                        @if($search || $universityId)
                                            <a href="{{ route('faculties.index') }}"
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
    </style>
@endsection