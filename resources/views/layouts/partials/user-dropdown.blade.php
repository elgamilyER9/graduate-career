<div class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 animate__animated animate__fadeIn" aria-labelledby="navbarDropdown" style="min-width: 200px;">
    <div class="px-3 py-2 border-bottom mb-2 d-md-none">
        <p class="mb-0 fw-bold text-dark small">{{ Auth::user()->name }}</p>
        <p class="mb-0 text-muted extra-small">{{ Auth::user()->email }}</p>
    </div>
    
    <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded-3 mx-2 w-auto mb-1 hover-bg-light transition-all" href="{{ route('profile.edit') }}">
        <i class="bi bi-person-circle me-2 text-primary opacity-75"></i> 
        <span class="fw-medium">{{ __('Profile Settings') }}</span>
    </a>

    @if(Auth::user()->role === 'admin')
        <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded-3 mx-2 w-auto mb-1 hover-bg-light transition-all" href="{{ route('home') }}">
            <i class="bi bi-speedometer2 me-2 text-primary opacity-75"></i> 
            <span class="fw-medium">{{ __('Dashboard') }}</span>
        </a>
    @endif

    <div class="dropdown-divider mx-3"></div>
    
    <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded-3 mx-2 w-auto text-danger hover-bg-danger-subtle transition-all" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right me-2"></i> 
        <span class="fw-bold">{{ __('Logout') }}</span>
    </a>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

<style>
    .hover-bg-danger-subtle:hover {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
    }
    .extra-small {
        font-size: 0.75rem;
    }
</style>
