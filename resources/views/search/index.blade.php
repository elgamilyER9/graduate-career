@extends('layouts.app')

@section('content')

    {{-- ══════════════════════════════════════════════════════ --}}
    {{-- HERO SEARCH BAR --}}
    {{-- ══════════════════════════════════════════════════════ --}}
    <div class="search-hero position-relative overflow-hidden py-5 mb-0"
        style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);">

        {{-- Decorative blobs --}}
        <div class="position-absolute"
            style="top:-80px;right:-80px;width:350px;height:350px;background:rgba(99,102,241,0.08);filter:blur(80px);border-radius:50%;pointer-events:none;">
        </div>
        <div class="position-absolute"
            style="bottom:-60px;left:-60px;width:280px;height:280px;background:rgba(16,185,129,0.06);filter:blur(70px);border-radius:50%;pointer-events:none;">
        </div>

        <div class="container position-relative" style="z-index:2;">

            {{-- Title --}}
            <div class="text-center mb-4">
                <span class="badge rounded-pill px-3 py-2 mb-3 fw-bold text-uppercase d-inline-block"
                    style="background:rgba(99,102,241,0.2);color:#a5b4fc;border:1px solid rgba(99,102,241,0.3);font-size:0.7rem;letter-spacing:0.08em;">
                    <i class="bi bi-search me-1"></i>{{ __('Advanced Search') }}
                </span>
                <h1 class="display-5 fw-black text-white mb-2" style="letter-spacing:-1px;">
                    {{ __('Find What You\'re Looking For') }}
                </h1>
                <p class="text-white-50 mb-0 fs-6">
                    {{ __('Search across jobs, training programs, mentors and skills') }}
                </p>
            </div>

            {{-- Search Box --}}
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('search.advanced') }}" method="GET" id="searchForm">
                        <div class="search-box d-flex rounded-4 overflow-hidden shadow-lg"
                            style="background:rgba(255,255,255,0.07);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.12);">
                            <div class="flex-grow-1 d-flex align-items-center px-4">
                                <i class="bi bi-search text-white-50 me-3 fs-5"></i>
                                <input type="text" name="q" id="searchInput"
                                    class="border-0 bg-transparent text-white fw-semibold w-100"
                                    placeholder="{{ __('Type keywords...') }}" value="{{ $query }}" autocomplete="off"
                                    style="outline:none;font-size:1.05rem;color:white !important;">
                            </div>
                            <select name="type" id="typeSelect" class="border-0 bg-transparent text-white fw-semibold px-3"
                                style="outline:none;cursor:pointer;min-width:130px;border-left:1px solid rgba(255,255,255,0.12) !important;">
                                <option value="all" class="text-dark" {{ $type === 'all' ? 'selected' : '' }}>{{ __('All') }}
                                </option>
                                <option value="jobs" class="text-dark" {{ $type === 'jobs' ? 'selected' : '' }}>
                                    {{ __('Jobs') }}</option>
                                <option value="trainings" class="text-dark" {{ $type === 'trainings' ? 'selected' : '' }}>
                                    {{ __('Trainings') }}</option>
                                <option value="mentors" class="text-dark" {{ $type === 'mentors' ? 'selected' : '' }}>
                                    {{ __('Mentors') }}</option>
                                <option value="skills" class="text-dark" {{ $type === 'skills' ? 'selected' : '' }}>
                                    {{ __('Skills') }}</option>
                            </select>
                            <button type="submit" class="btn fw-bold px-5 rounded-0"
                                style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;border:none;min-width:120px;">
                                <i class="bi bi-search me-2"></i>{{ __('Search') }}
                            </button>
                        </div>
                    </form>

                    {{-- Quick filters --}}
                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                        @foreach(['jobs', 'trainings', 'mentors', 'skills'] as $cat)
                            @php
                                $icons = ['jobs' => 'bi-briefcase-fill', 'trainings' => 'bi-mortarboard-fill', 'mentors' => 'bi-person-badge-fill', 'skills' => 'bi-star-fill'];
                                $labels = ['jobs' => __('Jobs'), 'trainings' => __('Trainings'), 'mentors' => __('Mentors'), 'skills' => __('Skills')];
                                $colors = ['jobs' => '#f59e0b', 'trainings' => '#06b6d4', 'mentors' => '#8b5cf6', 'skills' => '#ec4899'];
                            @endphp
                            <a href="{{ route('search.advanced') }}?q={{ urlencode($query ?: 'a') }}&type={{ $cat }}"
                                class="quick-filter-pill {{ $type === $cat ? 'active-pill' : '' }}"
                                style="--pill-color:{{ $colors[$cat] }}">
                                <i class="bi {{ $icons[$cat] }} me-1"></i>{{ $labels[$cat] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════ --}}
    {{-- RESULTS AREA --}}
    {{-- ══════════════════════════════════════════════════════ --}}
    <div class="container-fluid px-4 py-5">

        @if($query)

            {{-- ── Result Summary Bar ── --}}
            @php
                $totalResults =
                    (isset($results['jobs']) ? (is_object($results['jobs']) ? $results['jobs']->total() : count($results['jobs'])) : 0) +
                    (isset($results['trainings']) ? (is_object($results['trainings']) ? $results['trainings']->total() : count($results['trainings'])) : 0) +
                    (isset($results['mentors']) ? (is_object($results['mentors']) ? $results['mentors']->total() : count($results['mentors'])) : 0);
            @endphp
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                <div>
                    <h5 class="fw-bolder mb-1">
                        @if($totalResults > 0)
                            <span style="color:#6366f1;">{{ $totalResults }}</span> {{ __('results for') }}
                            <span class="text-dark">"{{ $query }}"</span>
                        @else
                            {{ __('No results for') }} <span class="text-danger">"{{ $query }}"</span>
                        @endif
                    </h5>
                    <small class="text-muted">{{ __('Showing results across all categories') }}</small>
                </div>
                <a href="{{ route('search.advanced') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                    <i class="bi bi-x-lg me-1"></i>{{ __('Clear search') }}
                </a>
            </div>

            @if($totalResults > 0)

                {{-- ── Category Tabs ── --}}
                <ul class="nav nav-pills mb-4 gap-2 flex-wrap" id="resultTabs">
                    <li class="nav-item">
                        <button class="nav-tab-btn active" data-target="all-results">
                            <i class="bi bi-grid-fill me-1"></i>{{ __('All') }}
                            <span class="tab-count">{{ $totalResults }}</span>
                        </button>
                    </li>
                    @if(isset($results['jobs']) && (is_object($results['jobs']) ? $results['jobs']->total() : count($results['jobs'])) > 0)
                        <li class="nav-item">
                            <button class="nav-tab-btn" data-target="jobs-results" style="--tab-color:#f59e0b;">
                                <i class="bi bi-briefcase-fill me-1"></i>{{ __('Jobs') }}
                                <span
                                    class="tab-count">{{ is_object($results['jobs']) ? $results['jobs']->total() : count($results['jobs']) }}</span>
                            </button>
                        </li>
                    @endif
                    @if(isset($results['trainings']) && (is_object($results['trainings']) ? $results['trainings']->total() : count($results['trainings'])) > 0)
                        <li class="nav-item">
                            <button class="nav-tab-btn" data-target="trainings-results" style="--tab-color:#06b6d4;">
                                <i class="bi bi-mortarboard-fill me-1"></i>{{ __('Trainings') }}
                                <span
                                    class="tab-count">{{ is_object($results['trainings']) ? $results['trainings']->total() : count($results['trainings']) }}</span>
                            </button>
                        </li>
                    @endif
                    @if(isset($results['mentors']) && (is_object($results['mentors']) ? $results['mentors']->total() : count($results['mentors'])) > 0)
                        <li class="nav-item">
                            <button class="nav-tab-btn" data-target="mentors-results" style="--tab-color:#8b5cf6;">
                                <i class="bi bi-person-badge-fill me-1"></i>{{ __('Mentors') }}
                                <span
                                    class="tab-count">{{ is_object($results['mentors']) ? $results['mentors']->total() : count($results['mentors']) }}</span>
                            </button>
                        </li>
                    @endif
                </ul>

                {{-- ── Results Sections ── --}}
                <div id="all-results" class="result-section active-section">
                    <div class="row g-4">

                        {{-- JOBS --}}
                        @if(isset($results['jobs']) && (is_object($results['jobs']) ? $results['jobs']->count() : count($results['jobs'])) > 0)
                            <div class="col-12" id="jobs-results">
                                <div class="section-label mb-3">
                                    <span class="section-badge" style="background:#fff7ed;color:#f59e0b;border:1px solid #fed7aa;">
                                        <i class="bi bi-briefcase-fill me-2"></i>{{ __('Jobs') }}
                                        <span
                                            class="ms-2 fw-black">{{ is_object($results['jobs']) ? $results['jobs']->total() : count($results['jobs']) }}</span>
                                    </span>
                                </div>
                                <div class="row g-3">
                                    @foreach($results['jobs'] as $job)
                                        <div class="col-lg-6 col-xl-4">
                                            <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none">
                                                <div class="result-card result-card-job">
                                                    <div class="result-card-accent"
                                                        style="background:linear-gradient(135deg,#f59e0b,#d97706);"></div>
                                                    <div class="result-card-body">
                                                        <div class="d-flex align-items-start justify-content-between mb-3">
                                                            <div class="result-icon" style="background:#fff7ed;color:#f59e0b;">
                                                                <i class="bi bi-briefcase-fill"></i>
                                                            </div>
                                                            <span class="result-badge"
                                                                style="background:#fff7ed;color:#d97706;">{{ __('Job') }}</span>
                                                        </div>
                                                        <h6 class="fw-bold text-dark mb-1">{{ $job->title }}</h6>
                                                        <p class="text-muted small mb-2">
                                                            <i class="bi bi-building me-1"></i>{{ $job->company }}
                                                        </p>
                                                        @if($job->mentor)
                                                            <p class="small mb-0" style="color:#9ca3af;">
                                                                <i class="bi bi-person-circle me-1"></i>{{ $job->mentor->name }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="result-card-footer">
                                                        <span class="text-muted small">{{ $job->created_at->diffForHumans() }}</span>
                                                        <span class="result-arrow"><i class="bi bi-arrow-right"></i></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- TRAININGS --}}
                        @if(isset($results['trainings']) && (is_object($results['trainings']) ? $results['trainings']->count() : count($results['trainings'])) > 0)
                            <div class="col-12" id="trainings-results">
                                <div class="section-label mb-3">
                                    <span class="section-badge" style="background:#ecfeff;color:#0891b2;border:1px solid #a5f3fc;">
                                        <i class="bi bi-mortarboard-fill me-2"></i>{{ __('Training Programs') }}
                                        <span
                                            class="ms-2 fw-black">{{ is_object($results['trainings']) ? $results['trainings']->total() : count($results['trainings']) }}</span>
                                    </span>
                                </div>
                                <div class="row g-3">
                                    @foreach($results['trainings'] as $training)
                                        <div class="col-lg-6 col-xl-4">
                                            <a href="{{ route('trainings.show', $training) }}" class="text-decoration-none">
                                                <div class="result-card result-card-training">
                                                    <div class="result-card-accent"
                                                        style="background:linear-gradient(135deg,#06b6d4,#0891b2);"></div>
                                                    <div class="result-card-body">
                                                        <div class="d-flex align-items-start justify-content-between mb-3">
                                                            <div class="result-icon" style="background:#ecfeff;color:#06b6d4;">
                                                                <i class="bi bi-mortarboard-fill"></i>
                                                            </div>
                                                            <span class="result-badge"
                                                                style="background:#ecfeff;color:#0891b2;">{{ __('Training') }}</span>
                                                        </div>
                                                        <h6 class="fw-bold text-dark mb-1">{{ $training->title }}</h6>
                                                        <p class="text-muted small mb-2">{{ Str::limit($training->description, 80) }}</p>
                                                        @if($training->mentor)
                                                            <p class="small mb-0" style="color:#9ca3af;">
                                                                <i class="bi bi-person-circle me-1"></i>{{ $training->mentor->name }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="result-card-footer">
                                                        <span class="text-muted small">{{ $training->created_at->diffForHumans() }}</span>
                                                        <span class="result-arrow"><i class="bi bi-arrow-right"></i></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- MENTORS --}}
                        @if(isset($results['mentors']) && (is_object($results['mentors']) ? $results['mentors']->count() : count($results['mentors'])) > 0)
                            <div class="col-12" id="mentors-results">
                                <div class="section-label mb-3">
                                    <span class="section-badge" style="background:#f5f3ff;color:#7c3aed;border:1px solid #ddd6fe;">
                                        <i class="bi bi-person-badge-fill me-2"></i>{{ __('Mentors') }}
                                        <span
                                            class="ms-2 fw-black">{{ is_object($results['mentors']) ? $results['mentors']->total() : count($results['mentors']) }}</span>
                                    </span>
                                </div>
                                <div class="row g-3">
                                    @foreach($results['mentors'] as $mentor)
                                        <div class="col-lg-6 col-xl-4">
                                            <a href="{{ route('users.show', $mentor) }}" class="text-decoration-none">
                                                <div class="result-card result-card-mentor">
                                                    <div class="result-card-accent"
                                                        style="background:linear-gradient(135deg,#8b5cf6,#7c3aed);"></div>
                                                    <div class="result-card-body">
                                                        <div class="d-flex align-items-center gap-3 mb-3">
                                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=8B5CF6&color=fff&size=56&bold=true"
                                                                class="rounded-circle shadow-sm" style="width:52px;height:52px;"
                                                                alt="{{ $mentor->name }}">
                                                            <div>
                                                                <h6 class="fw-bold text-dark mb-0">{{ $mentor->name }}</h6>
                                                                <small class="text-muted">{{ $mentor->email }}</small>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-1 mt-auto">
                                                            @if($mentor->faculty)
                                                                <span class="small-tag" style="background:#f5f3ff;color:#7c3aed;">
                                                                    <i class="bi bi-bank2 me-1"></i>{{ $mentor->faculty->name }}
                                                                </span>
                                                            @endif
                                                            @if($mentor->university)
                                                                <span class="small-tag" style="background:#eff6ff;color:#1d4ed8;">
                                                                    <i class="bi bi-building-fill me-1"></i>{{ $mentor->university->name }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="result-card-footer">
                                                        <span class="result-badge"
                                                            style="background:#f5f3ff;color:#7c3aed;">{{ __('Mentor') }}</span>
                                                        <span class="result-arrow"><i class="bi bi-arrow-right"></i></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            @else
                {{-- ── No Results ── --}}
                <div class="text-center py-5 my-4">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                            style="width:100px;height:100px;background:linear-gradient(135deg,#f8fafc,#f1f5f9);">
                            <i class="bi bi-search" style="font-size:2.8rem;color:#cbd5e1;"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">{{ __('No results found') }}</h4>
                    <p class="text-muted mb-4">{{ __('Try different keywords or remove filters') }}</p>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="small text-muted">{{ __('Suggestions:') }}</span>
                        <a href="{{ route('jobs.index') }}"
                            class="badge rounded-pill bg-warning-subtle text-warning px-3 py-2 text-decoration-none fw-semibold">{{ __('Browse Jobs') }}</a>
                        <a href="{{ route('trainings.index') }}"
                            class="badge rounded-pill bg-info-subtle text-info px-3 py-2 text-decoration-none fw-semibold">{{ __('Browse Trainings') }}</a>
                        <a href="{{ route('mentors.index') }}"
                            class="badge rounded-pill bg-purple-subtle text-purple px-3 py-2 text-decoration-none fw-semibold">{{ __('Browse Mentors') }}</a>
                    </div>
                </div>
            @endif

        @else
            {{-- ── Empty State (no query yet) ── --}}
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    {{-- Popular Searches --}}
                    <div class="text-center mb-5">
                        <p class="text-muted fw-semibold mb-3">{{ __('Popular searches') }}</p>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @foreach(['PHP Developer', 'Data Science', 'Machine Learning', 'UI/UX Designer', 'Project Manager', 'Java', 'Python', 'React'] as $term)
                                <a href="{{ route('search.advanced') }}?q={{ urlencode($term) }}&type=all"
                                    class="popular-term">{{ $term }}</a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Category Cards --}}
                    <div class="row g-4">
                        @php
                            $categories = [
                                ['title' => __('Jobs'), 'desc' => __('Find your dream job'), 'icon' => 'bi-briefcase-fill', 'color' => '#f59e0b', 'bg' => '#fff7ed', 'link' => route('jobs.index')],
                                ['title' => __('Trainings'), 'desc' => __('Upgrade your skills'), 'icon' => 'bi-mortarboard-fill', 'color' => '#06b6d4', 'bg' => '#ecfeff', 'link' => route('trainings.index')],
                                ['title' => __('Mentors'), 'desc' => __('Connect with experts'), 'icon' => 'bi-person-badge-fill', 'color' => '#8b5cf6', 'bg' => '#f5f3ff', 'link' => route('mentors.index')],
                                ['title' => __('Skills'), 'desc' => __('Explore skill paths'), 'icon' => 'bi-star-fill', 'color' => '#ec4899', 'bg' => '#fdf4ff', 'link' => route('skills.index')],
                            ];
                        @endphp
                        @foreach($categories as $cat)
                            <div class="col-sm-6 col-md-3">
                                <a href="{{ $cat['link'] }}" class="text-decoration-none">
                                    <div class="category-card text-center p-4">
                                        <div class="category-icon mx-auto mb-3"
                                            style="background:{{ $cat['bg'] }};color:{{ $cat['color'] }};">
                                            <i class="bi {{ $cat['icon'] }}"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">{{ $cat['title'] }}</h6>
                                        <p class="text-muted small mb-0">{{ $cat['desc'] }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        @endif

    </div>

    {{-- ══════════════════════════════════════════════════════ --}}
    {{-- STYLES --}}
    {{-- ══════════════════════════════════════════════════════ --}}
    <style>
        /* ── Hero Search Input ── */
        .search-hero {
            min-height: 280px;
            display: flex;
            align-items: center;
        }

        #searchInput::placeholder {
            color: rgba(255, 255, 255, 0.4) !important;
        }

        #searchInput {
            caret-color: #a5b4fc;
        }

        select#typeSelect option {
            color: #1e293b;
            background: white;
        }

        /* ── Quick Filter Pills ── */
        .quick-filter-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.12);
            transition: all 0.2s ease;
        }

        .quick-filter-pill:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-color: rgba(255, 255, 255, 0.25);
        }

        .quick-filter-pill.active-pill {
            background: var(--pill-color, #6366f1);
            color: white !important;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* ── Tab Buttons ── */
        .nav-tab-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.83rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            background: #f1f5f9;
            color: #64748b;
            transition: all 0.2s ease;
        }

        .nav-tab-btn:hover {
            background: #e2e8f0;
            color: #334155;
        }

        .nav-tab-btn.active {
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
        }

        .tab-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 22px;
            height: 20px;
            border-radius: 10px;
            font-size: 0.72rem;
            font-weight: 800;
            background: rgba(0, 0, 0, 0.08);
            padding: 0 6px;
        }

        .nav-tab-btn.active .tab-count {
            background: rgba(255, 255, 255, 0.25);
        }

        /* ── Section Badges ── */
        .section-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 700;
        }

        /* ── Result Cards ── */
        .result-card {
            border-radius: 16px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: all 0.25s ease;
            position: relative;
        }

        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
            border-color: transparent;
        }

        .result-card-accent {
            height: 4px;
            width: 100%;
        }

        .result-card-body {
            padding: 20px 20px 12px;
        }

        .result-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            border-top: 1px solid #f8fafc;
            background: #fafbfc;
        }

        .result-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .result-badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .result-arrow {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #94a3b8;
            transition: all 0.2s ease;
        }

        .result-card:hover .result-arrow {
            background: #6366f1;
            color: white;
            transform: translateX(2px);
        }

        /* ── Small Tags ── */
        .small-tag {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        /* ── Popular Terms ── */
        .popular-term {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 50px;
            background: #f8fafc;
            color: #475569;
            font-size: 0.83rem;
            font-weight: 600;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .popular-term:hover {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
        }

        /* ── Category Cards ── */
        .category-card {
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            background: white;
            transition: all 0.25s ease;
        }

        .category-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.1);
            border-color: transparent;
        }

        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* ── Subtle variants ── */
        .bg-warning-subtle {
            background-color: #fef3c7 !important;
        }

        .bg-info-subtle {
            background-color: #e0f2fe !important;
        }

        .bg-purple-subtle {
            background-color: #f5f3ff !important;
        }

        .text-purple {
            color: #7c3aed !important;
        }

        .text-info {
            color: #0891b2 !important;
        }
    </style>

    {{-- ══════════════════════════════════════════════════════ --}}
    {{-- SCRIPTS --}}
    {{-- ══════════════════════════════════════════════════════ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ── Tab switching ──
            const tabBtns = document.querySelectorAll('.nav-tab-btn');
            const sections = {
                'all-results': document.getElementById('all-results'),
                'jobs-results': document.getElementById('jobs-results'),
                'trainings-results': document.getElementById('trainings-results'),
                'mentors-results': document.getElementById('mentors-results'),
            };

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    tabBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const target = this.dataset.target;

                    if (target === 'all-results') {
                        // Show all sections inside the main container
                        Object.values(sections).forEach(s => { if (s) s.style.display = ''; });
                    } else {
                        // In "all-results" mode the sections are nested, so scroll to them
                        const el = document.getElementById(target);
                        if (el) {
                            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                });
            });

            // ── Auto-submit on type change ──
            const typeSelect = document.getElementById('typeSelect');
            if (typeSelect) {
                typeSelect.addEventListener('change', function () {
                    const form = document.getElementById('searchForm');
                    if (form && document.getElementById('searchInput').value.length > 0) {
                        form.submit();
                    }
                });
            }

            // ── Submit on Enter ──
            document.getElementById('searchInput')?.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    document.getElementById('searchForm').submit();
                }
            });
        });
    </script>

@endsection