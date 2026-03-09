@extends('layouts.app')

@php
    if (!function_exists('formatBytes')) {
        function formatBytes($bytes, $decimals = 2)
        {
            if ($bytes === 0)
                return '0 Bytes';
            $k = 1024;
            $sizes = ['Bytes', 'KB', 'MB', 'GB'];
            $i = floor(log($bytes, $k));
            return round($bytes / pow($k, $i), $decimals) . ' ' . $sizes[$i];
        }
    }
@endphp

@section('content')
    <div class="container-fluid px-4 py-4">

        {{-- Header --}}
        <div class="rounded-5 p-4 mb-5 position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%); color:white; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
            <div class="row align-items-center g-4">
                <div class="col-md-8">
                    <span class="badge rounded-pill px-3 py-2 mb-3 fw-bold text-uppercase"
                        style="background:rgba(16,185,129,0.2);color:#6ee7b7;border:1px solid rgba(16,185,129,0.3);font-size:0.7rem;">
                        <i class="bi bi-shield-fill-check me-1"></i>{{ __('Admin Panel') }}
                    </span>
                    <h2 class="display-6 fw-bolder mb-2">
                        <i class="bi bi-folder-fill me-2 text-success"></i>{{ __('All Files') }}
                    </h2>
                    <p class="text-white-50 mb-0">{{ __('Manage all uploaded files from users and mentors') }}</p>
                </div>
                <div class="col-md-4 text-end d-none d-md-block">
                    <i class="bi bi-folder-fill text-success opacity-10" style="font-size:7rem;"></i>
                </div>
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

        {{-- Back + Filters --}}
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('admin.files.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small text-muted">{{ __('Search') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 shadow-none"
                                placeholder="{{ __('File name or user name...') }}" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small text-muted">{{ __('File Type') }}</label>
                        <select name="type" class="form-select shadow-none">
                            <option value="">{{ __('All Types') }}</option>
                            <option value="resume" {{ request('type') === 'resume' ? 'selected' : '' }}>{{ __('Resume') }}
                            </option>
                            <option value="certificate" {{ request('type') === 'certificate' ? 'selected' : '' }}>
                                {{ __('Certificate') }}</option>
                            <option value="portfolio" {{ request('type') === 'portfolio' ? 'selected' : '' }}>
                                {{ __('Portfolio') }}</option>
                            <option value="cover_letter" {{ request('type') === 'cover_letter' ? 'selected' : '' }}>
                                {{ __('Cover Letter') }}</option>
                            <option value="document" {{ request('type') === 'document' ? 'selected' : '' }}>
                                {{ __('Document') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-success rounded-3 flex-grow-1">
                            <i class="bi bi-funnel me-1"></i>{{ __('Filter') }}
                        </button>
                        <a href="{{ route('admin.files.index') }}" class="btn btn-outline-secondary rounded-3">
                            <i class="bi bi-x-lg"></i>
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-dark rounded-3">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Files Table --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bolder d-flex align-items-center gap-2">
                    <i class="bi bi-folder-fill text-success"></i>
                    {{ __('Files') }}
                    <span class="badge rounded-pill px-2 fw-bold ms-1" style="background:#d1fae5;color:#059669;">
                        {{ $files->total() }}
                    </span>
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('File') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Uploaded By') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-center">{{ __('Type') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-center">{{ __('Size') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('Date') }}</th>
                                <th class="px-4 py-3 border-0 text-muted small fw-bold text-end">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($files as $file)
                                <tr>
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width:44px;height:44px;background:#f0f4f8;">
                                                @if(strpos($file->mime_type, 'pdf') !== false)
                                                    <i class="bi bi-file-pdf fs-4 text-danger"></i>
                                                @elseif(strpos($file->mime_type, 'word') !== false || strpos($file->mime_type, 'document') !== false)
                                                    <i class="bi bi-file-word fs-4 text-primary"></i>
                                                @elseif(strpos($file->mime_type, 'sheet') !== false || strpos($file->mime_type, 'excel') !== false)
                                                    <i class="bi bi-file-earmark-spreadsheet fs-4 text-success"></i>
                                                @elseif(strpos($file->mime_type, 'image') !== false)
                                                    <i class="bi bi-image fs-4 text-info"></i>
                                                @else
                                                    <i class="bi bi-file-earmark fs-4 text-muted"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark mb-0" style="font-size:0.87rem;">
                                                    {{ Str::limit($file->name, 35) }}
                                                </div>
                                                <small class="text-muted">{{ $file->mime_type }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($file->user->name ?? '?') }}&background=EBF4FF&color=1E40AF&size=30"
                                                class="rounded-circle" style="width:30px;height:30px;" alt="">
                                            <div>
                                                <div class="fw-semibold text-dark" style="font-size:0.83rem;">
                                                    {{ $file->user->name ?? '—' }}</div>
                                                <small class="text-muted">
                                                    @if($file->user)
                                                        <span
                                                            class="badge rounded-pill px-2 fw-bold
                                                                    {{ $file->user->role === 'mentor' ? 'bg-warning-subtle text-warning' : 'bg-primary-subtle text-primary' }}"
                                                            style="font-size:0.7rem;">
                                                            {{ ucfirst($file->user->role) }}
                                                        </span>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-center">
                                        <span class="badge rounded-pill px-3 fw-bold"
                                            style="background:#f3f4f6;color:#374151;font-size:0.75rem;">
                                            {{ ucfirst(str_replace('_', ' ', $file->type)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-center">
                                        <small class="text-muted fw-semibold">{{ formatBytes($file->size) }}</small>
                                    </td>
                                    <td class="px-4 py-3 border-0">
                                        <small class="text-muted">{{ $file->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td class="px-4 py-3 border-0 text-end">
                                        <div class="d-flex justify-content-end gap-1">
                                            <a href="{{ route('files.show', $file) }}" target="_blank" class="btn-mini-view"
                                                title="{{ __('View') }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('files.download', $file) }}" class="btn-mini-edit"
                                                title="{{ __('Download') }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            <form action="{{ route('files.destroy', $file) }}" method="POST" class="m-0"
                                                onsubmit="return confirm('{{ __('Are you sure?') }}')">
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
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox-fill" style="font-size:3rem;opacity:0.3;"></i>
                                        <p class="mt-2 mb-0 fw-semibold">{{ __('No files found') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($files->hasPages())
                <div class="card-footer bg-white border-0 py-3 px-4">
                    {{ $files->withQueryString()->links() }}
                </div>
            @endif
        </div>

    </div>

    <style>
        .btn-mini-view,
        .btn-mini-edit,
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
            color: #3b82f6;
        }

        .btn-mini-view:hover {
            background: #3b82f6;
            color: white;
        }

        .btn-mini-edit {
            color: #10b981;
        }

        .btn-mini-edit:hover {
            background: #10b981;
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

        .bg-warning-subtle {
            background-color: #fef3c7 !important;
        }

        .text-warning {
            color: #d97706 !important;
        }
    </style>
@endsection