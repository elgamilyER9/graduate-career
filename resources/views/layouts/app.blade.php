<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Graduate Career') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #0D6EFD;
            --primary-hover: #0056b3;
            --bg-light: #f8fafc;
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
            stroke: #fff;
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
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="brand-logo">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7V17L12 22L22 17V7L12 2Z" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 22V12" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M22 7L12 12L2 7" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span>Graduate<span class="text-primary">Career</span></span>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="bi bi-list h3 mb-0"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                                                    class="bi bi-search me-2 text-secondary"></i> {{ __('Advanced Search') }}</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('files.index') }}"><i
                                                    class="bi bi-folder-fill me-2 text-info"></i> {{ __('Files') }}</a>
                                        </li>
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
                        <!-- Authentication Links -->
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
                                $unreadNotifications = \App\Models\Notification::where('user_id', auth()->id())->where('read', false)->count();
                            @endphp
                            <!-- Search Bar -->
                            <li class="nav-item me-2 d-none d-md-block">
                                <form action="{{ route('search.index') }}" method="GET" class="d-flex">
                                    <input type="text" name="q" class="form-control form-control-sm rounded-pill px-3" 
                           placeholder="{{ __('Search...') }}" style="width: 180px;">
                                </form>
                            </li>
                            <!-- Notifications -->
                            <li class="nav-item me-2">
                                <a class="nav-link position-relative" href="{{ route('notifications.index') }}"
                                    title="{{ __('Notifications') }}">
                                    <i class="bi bi-bell-fill fs-5"></i>
                                    @if($unreadNotifications)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                            {{ $unreadNotifications }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <!-- Messages -->
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

                                <div class="dropdown-menu dropdown-menu-end animate__animated animate__fadeIn animate__faster"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('home') }}">
                                        <i class="bi bi-house-door-fill me-2 text-primary"></i> {{ __('Home') }}
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-circle me-2 text-muted"></i> {{ __('Profile Settings') }}
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('files.index') }}">
                                        <i class="bi bi-file-earmark-arrow-up me-2 text-success"></i> {{ __('My Files') }}
                                    </a>
                                    <hr class="dropdown-divider opacity-50">
                                    <a class="dropdown-item d-flex align-items-center text-danger"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>

        <!-- Toast Notifications -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
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

        <footer class="footer text-center">
            <div class="container">
                <p class="text-muted small mb-0">&copy; {{ date('Y') }} {{ __('Graduate Career Management System') }}.
                    {{ __('Built with ❤️ for future graduates.') }}
                </p>
            </div>
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
        });
    </script>
</body>

</html>