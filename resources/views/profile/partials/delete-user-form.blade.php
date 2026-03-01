<section class="delete-account-section position-relative overflow-hidden rounded-4 p-4 border border-danger border-opacity-25" style="background: linear-gradient(145deg, rgba(254, 226, 226, 0.5) 0%, rgba(254, 202, 202, 0.2) 100%);">
    <div class="position-absolute top-0 end-0 p-4 opacity-10 pointer-events-none" style="right: {{ app()->getLocale() == 'ar' ? 'auto' : '0' }}; left: {{ app()->getLocale() == 'ar' ? '0' : 'auto' }}; transform: {{ app()->getLocale() == 'ar' ? 'scaleX(-1)' : 'none' }};">
        <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 8rem;"></i>
    </div>
    
    <header class="mb-4 position-relative z-1">
        <div class="d-flex align-items-center mb-2">
            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center {{ app()->getLocale() == 'ar' ? 'ms-3' : 'me-3' }} shadow-sm" style="width: 48px; height: 48px;">
                <i class="bi bi-shield-x fs-4"></i>
            </div>
            <h4 class="fw-bolder text-danger mb-0">
                {{ __('Delete Account') }}
            </h4>
        </div>
        <p class="text-secondary small mb-0 fw-medium {{ app()->getLocale() == 'ar' ? 'me-5 pe-2' : 'ms-5 ps-2' }}">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div class="mt-4 {{ app()->getLocale() == 'ar' ? 'me-5 pe-2' : 'ms-5 ps-2' }} position-relative z-1">
        <form method="post" action="{{ route('profile.destroy') }}" class="d-flex flex-column gap-3 max-w-xl">
            @csrf
            @method('delete')

            <div>
                <label class="form-label fw-bold text-danger small mb-2 text-uppercase tracking-wider">
                    <i class="bi bi-lock-fill {{ app()->getLocale() == 'ar' ? 'ms-1' : 'me-1' }}"></i> {{ __('Confirm Password') }}
                </label>
                <div class="input-group shadow-sm rounded-4 overflow-hidden" style="max-width: 400px;">
                    <span class="input-group-text bg-white border-0 px-3 text-danger opacity-75">
                        <i class="bi bi-key-fill"></i>
                    </span>
                    <input id="password" name="password" type="password"
                        class="form-control border-0 bg-white px-3 py-2 @error('password', 'userDeletion') is-invalid @enderror"
                        placeholder="{{ __('Enter password to confirm') }}" required />
                </div>
                @error('password', 'userDeletion') 
                    <div class="text-danger small mt-2 fw-bold"><i class="bi bi-exclamation-circle {{ app()->getLocale() == 'ar' ? 'ms-1' : 'me-1' }}"></i>{{ $message }}</div> 
                @enderror
            </div>

            <div class="mt-2">
                <button type="submit"
                    class="btn btn-danger rounded-pill px-5 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2 transition-all">
                    <i class="bi bi-trash3-fill"></i>
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </div>
</section>

<style>
    .delete-account-section {
        transition: all 0.3s ease;
    }
    .delete-account-section:hover {
        border-color: rgba(220, 38, 38, 0.5) !important;
        box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.1), 0 8px 10px -6px rgba(220, 38, 38, 0.1);
    }
    .tracking-wider { letter-spacing: 0.05em; }
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
    }
    .max-w-xl {
        max-width: 36rem;
    }
</style>