@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="display-6 fw-bolder mb-2">
                    <i class="bi bi-folder-fill me-2 text-primary"></i>{{ __('My Files') }}
                </h2>
                <p class="text-muted">{{ __('Manage your documents and files') }}</p>
            </div>
        </div>

        <div class="row g-4">
            {{-- Upload Section --}}
            <div class="col-lg-4 mb-4">
                <div class="card border-0 rounded-4 shadow-sm h-100" style="border-top: 4px solid #0d6efd !important;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-cloud-arrow-up me-2 text-primary"></i>{{ __('Upload New File') }}
                        </h5>

                        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf

                            <div class="mb-3">
                                <label for="fileType" class="form-label fw-semibold">{{ __('File Type') }}</label>
                                <select name="type" id="fileType" class="form-select rounded-2" required>
                                    <option value="">{{ __('Select type...') }}</option>
                                    <option value="resume">{{ __('Resume') }}</option>
                                    <option value="certificate">{{ __('Certificate') }}</option>
                                    <option value="portfolio">{{ __('Portfolio') }}</option>
                                    <option value="cover_letter">{{ __('Cover Letter') }}</option>
                                    <option value="document">{{ __('Document') }}</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="fileInput" class="form-label fw-semibold">{{ __('Choose File') }}</label>
                                <div class="input-group">
                                    <input type="file" name="file" id="fileInput" class="form-control rounded-2" 
                                           accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.png,.gif" required>
                                </div>
                                <small class="text-muted d-block mt-2">
                                    {{ __('Max size: 5MB') }}<br>
                                    {{ __('Formats: PDF, Word, Excel, Images') }}
                                </small>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-2">
                                <i class="bi bi-upload me-2"></i>{{ __('Upload') }}
                            </button>
                        </form>

                        {{-- File Info Box --}}
                        <div class="alert alert-light border mt-4 rounded-3">
                            <h6 class="fw-bold mb-2">
                                <i class="bi bi-info-circle me-2 text-info"></i>{{ __('Supported Types') }}
                            </h6>
                            <ul class="mb-0 small">
                                <li><strong>Resume:</strong> CV, تلخيص مهاراتك</li>
                                <li><strong>Certificate:</strong> شهادات التدريب والانجازات</li>
                                <li><strong>Portfolio:</strong> أعمالك وما أنجزته</li>
                                <li><strong>Cover Letter:</strong> خطاب التقديم</li>
                                <li><strong>Document:</strong> ملفات أخرى</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Files List --}}
            <div class="col-lg-8">
                <div class="card border-0 rounded-4 shadow-sm">
                    <div class="card-header bg-transparent border-0 p-4">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-file-earmark me-2"></i>{{ __('Your Files') }} ({{ $files->count() }})
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @forelse($files as $file)
                            <div class="border-bottom p-4 d-flex justify-content-between align-items-start hover-item">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        {{-- File Icon --}}
                                        <div class="rounded-3 d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px; background: #f0f4f8;">
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

                                        {{-- File Info --}}
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1">{{ $file->name }}</h6>
                                            <small class="text-muted d-block">
                                                <span class="badge bg-light text-dark me-2">{{ $file->type }}</span>
                                                <span>{{ formatBytes($file->size) }}</span>
                                                <span class="ms-2">{{ $file->created_at->diffForHumans() }}</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="d-flex gap-2 flex-shrink-0 ms-3">
                                    <a href="{{ route('files.download', $file) }}" class="btn btn-sm btn-outline-primary rounded-2" title="{{ __('Download') }}">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <form action="{{ route('files.destroy', $file) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-2" title="{{ __('Delete') }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center">
                                <div class="mb-3">
                                    <i class="bi bi-inbox-fill" style="font-size: 3rem; color: #d3d3d3;"></i>
                                </div>
                                <p class="text-muted fw-medium">{{ __('No files uploaded yet') }}</p>
                                <small class="text-muted">{{ __('Start by uploading your resume or other documents') }}</small>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-item {
            transition: all 0.2s ease;
            background-color: transparent;
        }

        .hover-item:hover {
            background-color: #f8fafc;
        }
    </style>

    <script>
        // Helper function to format file size
        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        // Form submission
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('fileInput');
            if (fileInput.files.length === 0) {
                e.preventDefault();
                alert('{{ __('Please select a file') }}');
            }
        });

        // Drag and drop
        const dropZone = document.querySelector('.card');
        if (dropZone) {
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.style.background = '#f0f4f8';
            });

            dropZone.addEventListener('dragleave', () => {
                dropZone.style.background = '';
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    document.getElementById('fileInput').files = files;
                }
            });
        }
    </script>
@endsection

@php
if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $decimals = 2) {
        if ($bytes === 0) return '0 Bytes';
        $k = 1024;
        $dm = $decimals < 0 ? 0 : $decimals;
        $sizes = ['Bytes', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes, $k));
        return round($bytes / pow($k, $i), $dm) . ' ' . $sizes[$i];
    }
}
@endphp
