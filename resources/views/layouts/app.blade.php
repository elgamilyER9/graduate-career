<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') | {{ config('app.name', 'Graduate Career') }}@else{{ config('app.name', 'Graduate Career') }}@endif</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #0D6EFD;
            --primary-hover: #0056b3;
            --bg-light: #f8fafc;

            --scrollbar-size: 8px;
            --scrollbar-track: #eef2f7;
            --scrollbar-thumb: #0f4cff;
            --scrollbar-thumb-hover: #0036cc;
            --scrollbar-border: #eef2f7;
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: var(--scrollbar-thumb) var(--scrollbar-track);
        }

        ::-webkit-scrollbar {
            width: var(--scrollbar-size);
            height: var(--scrollbar-size);
        }

        ::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
            border-radius: 999px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #5b9cff 0%, var(--scrollbar-thumb) 100%);
            border-radius: 999px;
            border: 2px solid var(--scrollbar-border);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #3b7aed 0%, var(--scrollbar-thumb-hover) 100%);
        }

        ::-webkit-scrollbar-corner {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: var(--scrollbar-size);
            height: var(--scrollbar-size);
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
            border-radius: 999px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #5b9cff 0%, var(--scrollbar-thumb) 100%);
            border-radius: 999px;
            border: 2px solid var(--scrollbar-border);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #3b7aed 0%, var(--scrollbar-thumb-hover) 100%);
        }

        body {
            font-family: 'Cairo', 'Outfit', sans-serif;
            background-color: var(--bg-light);
            color: #1e293b;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8) !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 0.75rem 0;
            z-index: 1030;
            /* ensure navbar stays above other elements */
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            color: #0f172a !important;
            display: flex;
            align-items: center;
        }

        .navbar-toggler {
            z-index: 1040;
            /* ensure toggler is above dropdowns */
        }

        .brand-logo {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #00d2ff 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-inline-end: 12px;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }

        .nav-link {
            font-weight: 500;
            color: #64748b !important;
            padding: 0.5rem 1rem !important;
            transition: all 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .dropdown-menu {
            border: 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border-radius: 14px;
            padding: 0.75rem;
            margin-top: 10px;
        }

        .dropdown-item {
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(13, 110, 253, 0.05);
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: 0;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.25);
        }

        main {
            min-height: calc(100vh - 150px);
        }

        .footer {
            padding: 2rem 0;
            background-color: #fff;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            margin-top: 4rem;
        }

        /* Navbar Logo Styling */
        .brand-logo {
            background: linear-gradient(135deg, var(--primary-color) 0%, #00d2ff 100%);
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-inline-end: 12px;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover .brand-logo {
            transform: rotate(-5deg) scale(1.05);
        }

        .brand-logo svg {
            width: 20px;
            height: 20px;
            color: #fff;
        }

        /* Generic Utilities */
        .transition-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .group:hover .group-hover-bg {
            background-color: var(--primary-color) !important;
            color: white !important;
        }

        /* RTL Specific Adjustments */
        [dir="rtl"] .me-1,
        [dir="rtl"] .me-2,
        [dir="rtl"] .me-3,
        [dir="rtl"] .me-4 {
            margin-right: 0 !important;
        }

        [dir="rtl"] .ms-1,
        [dir="rtl"] .ms-2,
        [dir="rtl"] .ms-3,
        [dir="rtl"] .ms-4 {
            margin-left: 0 !important;
        }

        [dir="rtl"] .me-1 {
            margin-left: 0.25rem !important;
        }

        [dir="rtl"] .me-2 {
            margin-left: 0.5rem !important;
        }

        [dir="rtl"] .me-3 {
            margin-left: 1rem !important;
        }

        [dir="rtl"] .me-4 {
            margin-left: 1.5rem !important;
        }

        [dir="rtl"] .ms-1 {
            margin-right: 0.25rem !important;
        }

        [dir="rtl"] .ms-2 {
            margin-right: 0.5rem !important;
        }

        [dir="rtl"] .ms-3 {
            margin-right: 1rem !important;
        }

        [dir="rtl"] .ms-4 {
            margin-right: 1.5rem !important;
        }

        [dir="rtl"] .me-auto {
            margin-right: 0 !important;
            margin-left: auto !important;
        }

        [dir="rtl"] .ms-auto {
            margin-left: 0 !important;
            margin-right: auto !important;
        }

        [dir="rtl"] .text-end {
            text-align: left !important;
        }

        [dir="rtl"] .text-start {
            text-align: right !important;
        }

        [dir="rtl"] .dropdown-item i {
            margin-inline-end: 0.5rem;
            margin-inline-start: 0;
        }

        [dir="rtl"] .dropdown-menu-end {
            left: 0;
            right: auto;
        }

        /* Notification Utility Classes */
        .nav-icon-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .nav-icon-link:hover {
            background: rgba(13, 110, 253, 0.08);
        }

        .notification-count-badge {
            position: absolute;
            top: 2px;
            inset-inline-end: 0;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 700;
            line-height: 1;
            background: #ef4444;
            color: #fff;
            border-radius: 999px;
            border: 2px solid #fff;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.35);
            pointer-events: none;
        }

        .notification-count-badge.mobile {
            position: static;
            margin-inline-start: auto;
            min-width: 22px;
            height: 22px;
            font-size: 0.72rem;
        }

        .rounded-top-4 {
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
        }

        .rounded-bottom-4 {
            border-bottom-left-radius: 1rem !important;
            border-bottom-right-radius: 1rem !important;
        }

        .extra-small {
            font-size: 0.75rem;
        }

        /* Premium Offcanvas Styles */
        .offcanvas {
            border: none;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.9) !important;
            width: 320px !important;
        }

        [dir="rtl"] .offcanvas-start {
            transform: translateX(100%);
        }

        .offcanvas-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .offcanvas-body {
            padding: 1.5rem;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.85rem 1.25rem;
            border-radius: 12px;
            color: #475569;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
            margin-bottom: 0.5rem;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            background: var(--primary-color);
            color: white !important;
        }

        .mobile-nav-link:hover i,
        .mobile-nav-link.active i {
            color: white !important;
        }

        .mobile-nav-link i {
            font-size: 1.25rem;
            color: var(--primary-color);
        }

        .nav-website-btn {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%) !important;
            color: #047857 !important;
            border: 2px solid #10b981 !important;
            border-radius: 10px !important;
            padding: 0.4rem 1rem !important;
            font-weight: 700;
            font-size: 0.88rem;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
            transition: all 0.25s ease;
        }

        .nav-website-btn:hover {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: #fff !important;
            border-color: #059669 !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
        }

        .nav-website-btn i {
            color: inherit;
        }

        .mobile-nav-link.nav-website-link {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%) !important;
            color: #047857 !important;
            border: 2px solid #10b981;
            border-radius: 12px;
        }

        .mobile-nav-link.nav-website-link i {
            color: #10b981 !important;
        }

        .mobile-nav-link.nav-website-link:hover {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: #fff !important;
            border-color: #059669;
        }

        .mobile-nav-link.nav-website-link:hover i {
            color: #fff !important;
        }

        .mobile-profile-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        @media (max-width: 767.98px) {
            .navbar-brand span {
                font-size: 1.1rem;
            }

            .brand-logo {
                width: 32px;
                height: 32px;
            }
        }

        /* Sub Navbar */
        .site-header {
            z-index: 1030;
        }

        .sub-navbar {
            background: linear-gradient(135deg, #0f172a, #1e3a8a);
            color: #ffffff;
            height: 42px;
            font-size: 0.8rem;
            font-weight: 500;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            font-family: 'Cairo', 'Outfit', sans-serif;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .sub-navbar::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 30%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            animation: subShine 8s infinite linear;
        }

        @keyframes subShine {
            to { left: 200%; }
        }

        .sub-nav-container {
            max-width: 1536px;
            width: 100%;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            height: 100%;
        }

        .sub-nav-left,
        .sub-nav-right {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .sub-nav-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sub-nav-item i {
            color: #60a5fa;
            font-size: 1rem;
            filter: drop-shadow(0 0 5px rgba(96, 165, 250, 0.3));
        }

        .sub-navbar .live-time {
            color: #fbbf24;
            font-family: monospace;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .sub-navbar .divider {
            color: rgba(255, 255, 255, 0.2);
            margin: 0 6px;
        }

        .sub-nav-sep {
            width: 1px;
            height: 18px;
            background: rgba(255, 255, 255, 0.15);
        }

        .sub-navbar .prayer-name {
            color: #ffffff;
            background: rgba(59, 130, 246, 0.3);
            padding: 3px 10px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sub-navbar .prayer-time {
            font-weight: 700;
            color: #34d399;
        }

        .sub-navbar .hijri {
            color: #cbd5e1;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .sub-navbar .weather-info {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #f8fafc;
        }

        .sub-navbar .loading-dots {
            letter-spacing: 2px;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div id="app">
        <header class="site-header sticky-top">
            @include('layouts.partials.sub-navbar')

            <nav class="navbar navbar-expand-md navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="brand-logo">
                        <x-brand-logo-icon />
                    </div>
                    <span>Graduate<span class="text-primary">Career</span></span>
                </a>
                @auth
                    @php
                        $notificationsUrl = auth()->user()->role === 'admin'
                            ? route('admin.notifications.index')
                            : route('notifications.index');
                        $totalNotifications = auth()->user()->role === 'admin'
                            ? \App\Models\Notification::count()
                            : \App\Models\Notification::where('user_id', auth()->id())->count();
                    @endphp
                    <a href="{{ $notificationsUrl }}"
                        class="nav-link nav-icon-link position-relative d-md-none ms-auto me-2"
                        title="{{ __('All Notifications') }}">
                        <i class="bi bi-bell-fill fs-5"></i>
                        <span id="notification-badge-mobile-header" class="notification-count-badge"
                            style="{{ $totalNotifications > 0 ? '' : 'display:none;' }}">
                            {{ $totalNotifications > 99 ? '99+' : $totalNotifications }}
                        </span>
                    </a>
                @endauth
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#mobileNavbar" aria-controls="mobileNavbar"
                    aria-label="{{ __('Toggle navigation') }}">
                    <i class="bi bi-list h2 mb-0"></i>
                </button>

                <!-- Desktop Menu -->
                <div class="collapse navbar-collapse d-none d-md-flex" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('front') ? 'active text-primary fw-bold' : '' }}"
                                    href="{{ route('front') }}">
                                    <i class="bi bi-house-door-fill me-1"></i> {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}"
                                    href="{{ route('home') }}">
                                    <i class="bi bi-grid-fill me-1"></i> {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold px-3 {{ request()->routeIs('mentors.index') ? 'active text-primary' : '' }}"
                                    href="{{ route('mentors.index') }}">
                                    <i class="bi bi-people me-1"></i> {{ __('Mentors') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold px-3 {{ request()->routeIs('connections.index') ? 'active text-primary' : '' }}"
                                    href="{{ route('connections.index') }}">
                                    <i class="bi bi-link-45deg me-1"></i> {{ __('Connections') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold px-3 {{ request()->routeIs('community.index') ? 'active text-primary' : '' }}"
                                    href="{{ route('community.index') }}">
                                    <i class="bi bi-globe me-1"></i> {{ __('Community') }}
                                </a>
                            </li>
                            @if(auth()->user()->role === 'mentor')
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold px-3 {{ request()->routeIs('job_applications.index') ? 'active text-primary' : '' }}"
                                        href="{{ route('job_applications.index') }}">
                                        <i class="bi bi-file-earmark-text me-1"></i> {{ __('Job Applications') }}
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'mentor')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="bi bi-layers-fill me-1"></i> {{ __('Management') }}
                                    </a>
                                    <ul class="dropdown-menu animate__animated animate__fadeIn animate__faster">
                                        @if(Auth::user()->role === 'admin')
                                            <li><a class="dropdown-item" href="{{ route('users.index') }}"><i
                                                        class="bi bi-people me-2 text-primary"></i> {{ __('Users') }}</a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.mentorship_requests.index') }}"><i
                                                        class="bi bi-person-heart me-2 text-warning"></i>
                                                    {{ __('Mentorship Requests') }}</a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.notifications.index') }}"><i
                                                        class="bi bi-bell-fill me-2 text-danger"></i>
                                                    {{ __('Notfications Control') }}</a></li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{ route('jobs.index') }}"><i
                                                    class="bi bi-briefcase me-2 text-success"></i> {{ __('Jobs') }}</a></li>
                                        <li><a class="dropdown-item" href="{{ route('career_paths.index') }}"><i
                                                    class="bi bi-signpost-split me-2 text-info"></i>
                                                {{ __('Career Paths') }}</a></li>
                                        <li>
                                            <hr class="dropdown-divider opacity-50">
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('skills.index') }}"><i
                                                    class="bi bi-patch-check me-2 text-warning"></i> {{ __('Skills') }}</a></li>
                                        <li><a class="dropdown-item" href="{{ route('trainings.index') }}"><i
                                                    class="bi bi-mortarboard me-2 text-danger"></i> {{ __('Trainings') }}</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('search.advanced') }}"><i
                                                    class="bi bi-search me-2 text-secondary"></i>
                                                {{ __('Advanced Search') }}</a></li>
                                        <li><a class="dropdown-item" href="{{ route('files.index') }}"><i
                                                    class="bi bi-folder-fill me-2 text-info"></i> {{ __('Files') }}</a></li>
                                        @if(Auth::user()->role === 'admin')
                                            <li>
                                                <hr class="dropdown-divider opacity-50">
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('universities.index') }}"><i
                                                        class="bi bi-building me-2 text-dark"></i> {{ __('Universities') }}</a></li>
                                            <li><a class="dropdown-item" href="{{ route('faculties.index') }}"><i
                                                        class="bi bi-book me-2 text-secondary"></i> {{ __('Faculties') }}</a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Back to Website -->
                        <li class="nav-item me-2 d-none d-md-block">
                            <a class="nav-link nav-website-btn d-flex align-items-center gap-2"
                                href="{{ url('/') }}" title="{{ __('Back to Website') }}">
                                <i class="bi bi-box-arrow-up-right"></i> <span>{{ __('Website') }}</span>
                            </a>
                        </li>
                        <!-- Language Switcher -->
                        <li class="nav-item me-3">
                            @if(app()->getLocale() == 'ar')
                                <a class="nav-link fw-bold btn btn-light rounded-pill px-3 py-1 border shadow-sm d-flex align-items-center gap-2 hover-scale transition-all"
                                    href="{{ route('lang.switch', 'en') }}" title="English">
                                    <i class="bi bi-globe2 text-primary"></i> <span style="font-size: 0.9rem;">EN</span>
                                </a>
                            @else
                                <a class="nav-link fw-bold btn btn-light rounded-pill px-3 py-1 border shadow-sm d-flex align-items-center gap-2 hover-scale transition-all"
                                    href="{{ route('lang.switch', 'ar') }}" title="العربية">
                                    <i class="bi bi-globe2 text-primary"></i> <span
                                        style="font-size: 0.9rem; font-family: 'Cairo', sans-serif;">عربي</span>
                                </a>
                            @endif
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link fw-bold px-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item ms-md-2">
                                    <a class="btn btn-primary" href="{{ route('select-role') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @php
                                $unread = \App\Models\Message::where('receiver_id', auth()->id())->where('read', false)->count();
                                $notificationsUrl = $notificationsUrl ?? (auth()->user()->role === 'admin'
                                    ? route('admin.notifications.index')
                                    : route('notifications.index'));
                                $totalNotifications = $totalNotifications ?? (auth()->user()->role === 'admin'
                                    ? \App\Models\Notification::count()
                                    : \App\Models\Notification::where('user_id', auth()->id())->count());
                            @endphp
                            <li class="nav-item me-2 d-none d-md-block">
                                <form action="{{ route('search.index') }}" method="GET" class="d-flex">
                                    <input type="text" name="q" class="form-control form-control-sm rounded-pill px-3"
                                        placeholder="{{ __('Search...') }}" style="width: 150px;">
                                </form>
                            </li>
                            <li class="nav-item me-2">
                                <a class="nav-link nav-icon-link position-relative" href="{{ $notificationsUrl }}"
                                    title="{{ __('All Notifications') }}">
                                    <i class="bi bi-bell-fill fs-5"></i>
                                    <span id="notification-badge" class="notification-count-badge"
                                        style="{{ $totalNotifications > 0 ? '' : 'display:none;' }}">
                                        {{ $totalNotifications > 99 ? '99+' : $totalNotifications }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="nav-link position-relative" href="{{ route('connections.index') }}"
                                    title="{{ __('Messages') }}">
                                    <i class="bi bi-chat-dots-fill fs-5"></i>
                                    @if($unread)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $unread }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-1 me-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&size=24"
                                            class="rounded-circle" alt="User">
                                    </div>
                                    <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                                </a>
                                @include('layouts.partials.user-dropdown')
                            </li>
                        @endguest
                    </ul>
                </div>

                <!-- Premium Mobile Offcanvas -->
                <div class="offcanvas {{ app()->getLocale() == 'ar' ? 'offcanvas-end' : 'offcanvas-start' }} d-md-none"
                    tabindex="-1" id="mobileNavbar" aria-labelledby="mobileNavbarLabel">
                    <div class="offcanvas-header bg-white">
                        <div class="d-flex align-items-center">
                            <div class="brand-logo me-2" style="width: 32px; height: 32px;">
                                <x-brand-logo-icon :size="18" />
                            </div>
                            <h5 class="offcanvas-title fw-black" id="mobileNavbarLabel">Graduate<span
                                    class="text-primary">Career</span></h5>
                        </div>
                        <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        @auth
                            <div class="mobile-profile-card d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&size=48"
                                    class="rounded-circle shadow-sm" alt="User">
                                <div>
                                    <h6 class="fw-black mb-0">{{ Auth::user()->name }}</h6>
                                    <p class="text-muted small-caps fw-bold mb-0" style="font-size: 0.7rem;">
                                        {{ strtoupper(Auth::user()->role) }}</p>
                                </div>
                            </div>
                        @endauth

                        <div class="mobile-search mb-4">
                            <form action="{{ route('search.index') }}" method="GET" class="position-relative">
                                <i
                                    class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <input type="text" name="q"
                                    class="form-control rounded-pill ps-5 py-2 fw-medium border-light shadow-sm"
                                    placeholder="{{ __('Search anything...') }}">
                            </form>
                        </div>

                        <nav class="vstack">
                            @auth
                                <a href="{{ url('/') }}"
                                    class="mobile-nav-link nav-website-link fw-bold mb-2">
                                    <i class="bi bi-box-arrow-up-right me-2"></i> {{ __('Back to Website') }}
                                </a>
                                <a href="{{ route('home') }}"
                                    class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i class="bi bi-grid-fill"></i> {{ __('Dashboard') }}
                                </a>
                                <a href="{{ route('mentors.index') }}"
                                    class="mobile-nav-link {{ request()->routeIs('mentors.index') ? 'active' : '' }}">
                                    <i class="bi bi-people-fill"></i> {{ __('Mentors') }}
                                </a>
                                <a href="{{ route('connections.index') }}"
                                    class="mobile-nav-link {{ request()->routeIs('connections.index') ? 'active' : '' }}">
                                    <i class="bi bi-chat-dots-fill"></i> {{ __('Messages') }}
                                </a>
                                <a href="{{ $notificationsUrl }}"
                                    class="mobile-nav-link {{ request()->routeIs('notifications.index') || request()->routeIs('admin.notifications.index') ? 'active' : '' }}">
                                    <i class="bi bi-bell-fill"></i> {{ __('All Notifications') }}
                                    <span id="notification-badge-mobile" class="notification-count-badge mobile"
                                        style="{{ $totalNotifications > 0 ? '' : 'display:none;' }}">
                                        {{ $totalNotifications > 99 ? '99+' : $totalNotifications }}
                                    </span>
                                </a>
                                <hr class="my-3 opacity-10">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('users.index') }}" class="mobile-nav-link">
                                        <i class="bi bi-shield-lock-fill"></i> {{ __('Identity Control') }}
                                    </a>
                                @endif
                                <a href="{{ route('jobs.index') }}" class="mobile-nav-link">
                                    <i class="bi bi-briefcase-fill"></i> {{ __('Career Pulse') }}
                                </a>
                                <a href="{{ route('trainings.index') }}" class="mobile-nav-link">
                                    <i class="bi bi-mortarboard-fill"></i> {{ __('Global Training') }}
                                </a>
                                <hr class="my-3 opacity-10">
                                <a href="{{ route('profile.edit') }}" class="mobile-nav-link">
                                    <i class="bi bi-person-gear"></i> {{ __('Settings') }}
                                </a>
                                <a href="{{ route('logout') }}" class="mobile-nav-link text-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                                    <i class="bi bi-box-arrow-right"></i> {{ __('Log Out') }}
                                </a>
                                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf</form>
                            @else
                                <a href="{{ route('login') }}" class="mobile-nav-link">
                                    <i class="bi bi-box-arrow-in-right"></i> {{ __('Login') }}
                                </a>
                                <a href="{{ route('select-role') }}" class="mobile-nav-link">
                                    <i class="bi bi-person-plus-fill"></i> {{ __('Join Now') }}
                                </a>
                            @endauth
                        </nav>

                        <div class="mt-auto pt-5 text-center">
                            @if(app()->getLocale() == 'ar')
                                <a class="btn btn-light rounded-pill px-4 py-2 border shadow-sm fw-bold d-inline-flex align-items-center gap-2"
                                    href="{{ route('lang.switch', 'en') }}">
                                    <i class="bi bi-globe2"></i> English
                                </a>
                            @else
                                <a class="btn btn-light rounded-pill px-4 py-2 border shadow-sm fw-bold d-inline-flex align-items-center gap-2"
                                    href="{{ route('lang.switch', 'ar') }}">
                                    <i class="bi bi-globe2"></i> العربية
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        </header>

        <main class="py-5">
            @yield('content')
        </main>

        <!-- Toast Notifications -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3" id="mainToastContainer" style="z-index: 2000;">
            @if(session('success'))
                <div id="successToast"
                    class="toast align-items-center text-white bg-success border-0 shadow-lg rounded-4 animate__animated animate__slideInUp"
                    role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-4 me-2"></i>
                            <div>
                                <div class="fw-bold">Success!</div>
                                <div class="small opacity-75">{{ session('success') }}</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div id="errorToast"
                    class="toast align-items-center text-white bg-danger border-0 shadow-lg rounded-4 animate__animated animate__shakeX"
                    role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-2"></i>
                            <div>
                                <div class="fw-bold">Error Occurred</div>
                                <div class="small opacity-75">{{ session('error') }}</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Modern Advanced Footer -->
        <footer class="footer position-relative mt-5 pt-5 pb-4 border-0"
            style="background: linear-gradient(180deg, rgba(248,250,252,1) 0%, rgba(241,245,249,1) 100%);">
            <div class="position-absolute top-0 start-50 translate-middle-x w-75 bg-gradient shadow-sm"
                style="height: 1px; background: linear-gradient(90deg, transparent, rgba(13,110,253,0.3), transparent);">
            </div>
            <div class="container relative z-1">
                <div class="row align-items-center justify-content-between g-4">
                    <div class="col-md-6 text-center text-md-start">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2">
                            <div class="brand-logo me-2 shadow-sm"
                                style="width: 28px; height: 28px; border-radius: 8px;">
                                <x-brand-logo-icon :size="16" />
                            </div>
                            <span class="fw-black text-dark fs-5 tracking-wider">Elgamily<span
                                    class="text-primary">Ramadan</span></span>
                        </div>
                        <p class="text-muted small fw-medium mb-0">
                            &copy; {{ date('Y') }} {{ __('Elgamily Ramadan (ER9)') }}. {{ __('All rights reserved.') }}
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p
                            class="text-muted small fw-semibold mb-2 d-flex align-items-center justify-content-center justify-content-md-end gap-1">
                            {{ __('Built with') }} <i
                                class="bi bi-heart-fill text-danger animate__animated animate__heartBeat animate__infinite animate__slower"
                                style="font-size: 0.9rem;"></i> {{ __('for future graduates.') }}
                        </p>
                        <div class="d-flex gap-3 justify-content-center justify-content-md-end">
                            <a href="https://www.linkedin.com/in/elgamily-ramadan"
                                class="text-muted hover-scale transition-all" title="LinkedIn" target="_blank"><i
                                    class="bi bi-linkedin fs-5 hover-text-primary"></i></a>
                            <a href="https://github.com/elgamilyER9" class="text-muted hover-scale transition-all"
                                title="GitHub" target="_blank"><i class="bi bi-github fs-5 hover-text-dark"></i></a>
                            <a href="mailto:elgamilyramadan@gmail.com" class="text-muted hover-scale transition-all"
                                title="Gmail" target="_blank"><i
                                    class="bi bi-envelope-fill fs-5 text-danger hover-scale"></i></a>
                            <a href="https://wa.me/201223030960" class="text-muted hover-scale transition-all"
                                title="WhatsApp" target="_blank"><i
                                    class="bi bi-whatsapp fs-5 text-success hover-scale"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .hover-text-primary:hover {
                    color: var(--primary-color) !important;
                }

                .hover-text-dark:hover {
                    color: #1e293b !important;
                }

                [dir="rtl"] .footer .text-md-start {
                    text-align: right !important;
                }

                [dir="rtl"] .footer .text-md-end {
                    text-align: left !important;
                }

                [dir="rtl"] .footer .justify-content-md-start {
                    justify-content: flex-start !important;
                }

                [dir="rtl"] .footer .justify-content-md-end {
                    justify-content: flex-end !important;
                }
            </style>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Auto show toasts
            var toasts = document.querySelectorAll('.toast');
            toasts.forEach(function (toastEl) {
                var toast = new bootstrap.Toast(toastEl, { delay: 5000 });
                toast.show();
            });

            @auth
                // Real-time Notifications Polling
                let shownNotificationIds = JSON.parse(sessionStorage.getItem('shown_notifications') || '[]');

                function updateNotificationBadge(count) {
                    const displayCount = count > 99 ? '99+' : count;
                    ['notification-badge', 'notification-badge-mobile', 'notification-badge-mobile-header'].forEach(id => {
                        const badge = document.getElementById(id);
                        if (!badge) return;
                        if (count > 0) {
                            badge.textContent = displayCount;
                            badge.style.display = 'inline-flex';
                        } else {
                            badge.style.display = 'none';
                        }
                    });
                }

                function fetchTotalCount() {
                    fetch('{{ route('notifications.total.count') }}')
                        .then(response => response.json())
                        .then(data => updateNotificationBadge(data.count))
                        .catch(error => console.error('Error fetching notification count:', error));
                }

                function fetchNotifications() {
                    fetch('{{ route('notifications.recent') }}')
                        .then(response => response.json())
                        .then(notifications => {
                            notifications.forEach(notification => {
                                if (!notification.read && !shownNotificationIds.includes(notification.id)) {
                                    showNotificationToast(notification);
                                    shownNotificationIds.push(notification.id);
                                }
                            });
                            sessionStorage.setItem('shown_notifications', JSON.stringify(shownNotificationIds));
                            fetchTotalCount();
                        })
                        .catch(error => console.error('Error fetching notifications:', error));
                }

                function showNotificationToast(notification) {
                    const container = document.getElementById('mainToastContainer');
                    const toastId = 'toast-' + notification.id;

                    const toastHtml = `
                                <div id="${toastId}" class="toast border-0 shadow-lg rounded-4 mb-3 animate__animated animate__slideInRight" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                                    <div class="toast-header border-0 bg-primary text-white rounded-top-4 py-2 px-3">
                                        <i class="bi bi-bell-fill me-2"></i>
                                        <strong class="me-auto">${notification.title}</strong>
                                        <small class="text-white-50">Just now</small>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body bg-white rounded-bottom-4 p-3 shadow-sm">
                                        <p class="mb-2 small text-dark">${notification.description}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <a href="{{ $notificationsUrl ?? url('/notifications') }}" class="btn btn-sm btn-light rounded-pill px-3 border py-1 extra-small fw-bold">
                                                <i class="bi bi-eye me-1"></i> {{ __('All Notifications') }}
                                            </a>
                                            <button onclick="markAsRead(${notification.id}, '${toastId}')" class="btn btn-sm btn-primary rounded-pill px-3 py-1 extra-small fw-bold shadow-sm">
                                                <i class="bi bi-check2 me-1"></i> Got it
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `;

                    const div = document.createElement('div');
                    div.innerHTML = toastHtml;
                    const toastElement = div.firstElementChild;
                    container.appendChild(toastElement);

                    const bsToast = new bootstrap.Toast(toastElement);
                    bsToast.show();
                }

                window.markAsRead = function (id, toastId) {
                    fetch(`/notifications/${id}/read`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            const toastElement = document.getElementById(toastId);
                            if (toastElement) {
                                const bsToast = bootstrap.Toast.getInstance(toastElement);
                                if (bsToast) bsToast.hide();
                            }
                            fetchTotalCount();
                        });
                }

                fetchTotalCount();
                fetchNotifications();
                setInterval(fetchNotifications, 30000);
            @endauth
        });
    </script>
</body>

</html>