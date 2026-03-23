<section>
    <header class="mb-4">
        <h4 class="fw-bold text-dark mb-1">
            {{ __('Update Password') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <div class="row g-4">
            <div class="col-12 col-md-4">
                <label class="form-label fw-bold text-muted small mb-1">CURRENT PASSWORD</label>
                <input id="update_password_current_password" name="current_password" type="password"
                    class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                    autocomplete="current-password" />
                @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label fw-bold text-muted small mb-1">NEW PASSWORD</label>
                <input id="update_password_password" name="password" type="password"
                    class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                    autocomplete="new-password" />
                @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label fw-bold text-muted small mb-1">CONFIRM PASSWORD</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                    autocomplete="new-password" />
                @error('password_confirmation', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 mt-4 d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-dark rounded-pill px-5">
                    {{ __('Update Password') }}
                </button>

                @if (session('status') === 'password-updated')
                    <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-success small fw-medium">
                        <i class="bi bi-check-circle-fill me-1"></i> {{ __('Updated successfully.') }}
                    </span>
                @endif
            </div>
        </div>
    </form>
</section>