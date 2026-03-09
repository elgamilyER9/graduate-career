@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Premium Header Section -->
        <div class="row align-items-center mb-5 animate__animated animate__fadeIn">
            <div class="col-12 col-lg-5">
                <h1 class="display-5 fw-black text-dark mb-2 position-relative d-inline-block">
                    {{ __('Job Opportunities') }}
                    <div class="position-absolute bottom-0 start-0 w-50" style="height: 4px; background: #f59e0b; border-radius: 2px; bottom: -10px;"></div>
                </h1>
                <p class="text-muted mt-3 mb-0 fw-medium">{{ __('Discover your next career move with our curated premium listings.') }}</p>
            </div>
            
            <div class="col-12 col-lg-7 mt-4 mt-lg-0">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-lg-end align-items-center">
                    <!-- Advanced Search Bar -->
                    <form action="{{ route('jobs.index') }}" method="GET" class="flex-grow-1 w-100" style="max-width: 550px;">
                        <div class="search-glass rounded-pill p-1 shadow-lg border border-white border-opacity-20 d-flex position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0 w-100 h-100 backdrop-blur-md z-0" style="background: rgba(255,255,255,0.6);"></div>
                            <span class="d-flex align-items-center ps-4 position-relative z-1">
                                <i class="bi bi-search text-indigo-900 opacity-50"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none py-3 px-3 position-relative z-1 fw-bold text-dark"
                                placeholder="{{ __('Search by title, company, or role...') }}" value="{{ $search ?? '' }}">
                            @if($search)
                                <a href="{{ route('jobs.index') }}" class="btn btn-link text-muted border-0 p-0 me-2 position-relative z-1 d-flex align-items-center">
                                    <i class="bi bi-x-circle-fill"></i>
                                </a>
                            @endif
                            <button class="btn btn-dark rounded-pill px-5 fw-black position-relative z-1 shadow-lg hover-lift" type="submit" style="background: #1e1b4b; letter-spacing: 1px;">
                                {{ __('FIND') }}
                            </button>
                        </div>
                    </form>

                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'mentor')
                        <a href="{{ route('jobs.create') }}" class="btn btn-indigo-gold rounded-pill px-4 py-3 fw-black shadow-lg hover-lift d-flex align-items-center gap-2">
                            <i class="bi bi-plus-circle-fill fs-5"></i> <span>{{ __('POST JOB') }}</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-glass border-0 shadow-lg rounded-5 mb-5 p-4 animate__animated animate__fadeInDown">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <span class="fw-bold text-dark">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Job Grid -->
        <div class="row g-4 pt-2">
            @forelse($jobs as $job)
                <div class="col-12 col-md-6 col-xxl-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.05 }}s">
                    <div class="advanced-job-card h-100 p-4 rounded-5 border border-light bg-white shadow-soft transition-all hover-glow group position-relative overflow-hidden">
                        
                        <!-- Floating Background Decoration -->
                        <div class="position-absolute top-0 end-0 p-3 opacity-5 group-hover-opacity-10 transition-all text-indigo-900" style="font-size: 8rem; margin-right: -2rem; margin-top: -1rem;">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>

                        <div class="position-relative z-1 h-100 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="job-brand-icon p-3 rounded-4 bg-soft-primary shadow-sm group-hover-bg transition-all text-primary d-flex align-items-center justify-content-center" 
                                         style="background: #eef2ff; width: 64px; height: 64px; font-size: 1.5rem; font-weight: 900;">
                                        {{ strtoupper(substr($job->company, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="fw-black mb-1 text-indigo-950">{{ $job->title }}</h4>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span class="small fw-bold text-muted"><i class="bi bi-building me-1 text-indigo-600"></i> {{ $job->company }}</span>
                                            <span class="badge rounded-pill bg-soft-primary text-primary small border border-primary border-opacity-10">{{ $job->type ?? 'Full-time' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-muted small fw-medium mb-4 line-clamp-2">
                                {{ $job->description ?? __('Join our team and help us build the next generation of solutions in a dynamic and fast-paced environment.') }}
                            </p>

                            <div class="mt-auto">
                                <!-- Meta Info Strip -->
                                <div class="p-3 bg-light bg-opacity-50 rounded-4 d-flex flex-wrap gap-4 mb-4">
                                    <div class="small fw-bold text-muted d-flex align-items-center">
                                        <i class="bi bi-geo-alt-fill me-2 text-danger"></i> {{ $job->location ?? __('Remote') }}
                                    </div>
                                    @if($job->careerPath)
                                        <div class="small fw-bold text-muted d-flex align-items-center">
                                            <i class="bi bi-mortarboard-fill me-2 text-warning"></i> {{ $job->careerPath->name }}
                                        </div>
                                    @endif
                                    <div class="small fw-bold text-muted d-flex align-items-center">
                                        <i class="bi bi-clock-fill me-2 text-primary"></i> 3d ago
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-dark rounded-pill px-4 py-3 fw-black shadow-sm flex-grow-1 border-2 hover-soft-bg">
                                        {{ __('DETAILS') }}
                                    </a>

                                    @if(auth()->user()->role === 'user')
                                        @php $status = $myApplications[$job->id] ?? null; @endphp
                                        @if($status)
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-light rounded-pill px-4 py-3 fw-black shadow-sm" style="pointer-events: none; background: #f8fafc; color: #64748b;">
                                                    <i class="bi bi-check2-circle me-1"></i> {{ strtoupper(__($status)) }}
                                                </button>
                                                @if($status == 'pending')
                                                    @php 
                                                        $application = \App\Models\JobApplication::where('user_id', auth()->id())->where('job_id', $job->id)->first();
                                                    @endphp
                                                    @if($application)
                                                        <form action="{{ route('job_applications.destroy', $application) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');" class="m-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-soft-danger rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm" title="{{ __('Cancel') }}">
                                                                <i class="bi bi-trash3-fill fs-5"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
                                        @else
                                            <form action="{{ route('job_applications.store', $job) }}" method="POST" class="flex-grow-1 m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-dark w-100 rounded-pill px-4 py-3 fw-black shadow-lg hover-lift border-0" style="background: #1e1b4b; letter-spacing: 1px;">
                                                    {{ __('APPLY NOW') }} <i class="bi bi-send-fill ms-2"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                    <!-- Admin/Mentor Controls -->
                                    @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'mentor' && auth()->user()->id === $job->mentor_id))
                                        <div class="btn-group gap-2">
                                            <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm text-white border-0" title="{{ __('Edit') }}">
                                                <i class="bi bi-pencil-square fs-5"></i>
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm border-0" 
                                                        onclick="return confirm('{{ __('Are you sure?') }}')" title="{{ __('Delete') }}">
                                                    <i class="bi bi-trash-fill fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 animate__animated animate__fadeIn">
                    <div class="search-glass p-5 rounded-5 border border-dashed text-center">
                        <i class="bi bi-search text-muted display-1 mb-3 opacity-25"></i>
                        <h3 class="fw-black text-dark">{{ __('No matching jobs found') }}</h3>
                        <p class="text-muted mb-4">{{ __('Try adjusting your filters or search terms.') }}</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">{{ __('Reset Search') }}</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .fw-black { font-weight: 900; }
        .text-indigo-900 { color: #1e1b4b; }
        .text-indigo-950 { color: #0f172a; }
        .bg-soft-primary { background: rgba(30, 27, 75, 0.05); }
        .shadow-soft { box-shadow: 0 10px 30px -5px rgba(0,0,0,0.05); }
        
        .search-glass {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }

        .alert-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
        }

        .advanced-job-card {
            border-radius: 2.5rem;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: white;
        }

        .advanced-job-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 30px 60px -15px rgba(30, 27, 75, 0.1), 0 0 20px rgba(0,0,0,0.02) !important;
        }

        .hover-glow:hover {
            border-color: rgba(30, 27, 75, 0.1) !important;
        }

        .btn-indigo-gold {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            color: #f59e0b;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-indigo-gold:hover {
            background: linear-gradient(135deg, #312e81 0%, #1e1b4b 100%);
            color: #fbbf24;
            transform: translateY(-2px);
        }

        .btn-soft-danger {
            background: #fff1f2;
            color: #e11d48;
            border: none;
        }

        .btn-soft-danger:hover {
            background: #e11d48;
            color: white;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .backdrop-blur-md {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .hover-soft-bg:hover {
            background: #f8fafc;
        }
    </style>
@endsection
