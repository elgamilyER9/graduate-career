<section>
    <header class="mb-4">
        <h4 class="fw-bold text-dark mb-1">
            {{ __('Profile Information') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __("Update your account's profile information, email address, and academic background.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6">
        @csrf
        @method('patch')

        <div class="row g-4">
            <!-- Basic Info -->
            <div class="col-md-6">
                <label class="form-label fw-bold text-muted small mb-1">FULL NAME</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-muted small mb-1">EMAIL ADDRESS</label>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-danger small">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification"
                                class="btn btn-link btn-sm p-0 text-decoration-underline border-0 align-baseline">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-1 fw-medium text-success small">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Academic Info -->
            <div class="col-md-6">
                <label class="form-label fw-bold text-muted small mb-1">UNIVERSITY</label>
                <select name="university_id" class="form-select @error('university_id') is-invalid @enderror">
                    <option value="">Select University</option>
                    @foreach($universities as $university)
                        <option value="{{ $university->id }}" {{ old('university_id', $user->university_id) == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                    @endforeach
                </select>
                @error('university_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-muted small mb-1">FACULTY</label>
                <select name="faculty_id" class="form-select @error('faculty_id') is-invalid @enderror">
                    <option value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}" {{ old('faculty_id', $user->faculty_id) == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                    @endforeach
                </select>
                @error('faculty_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-muted small mb-1">CAREER PATH</label>
                <select name="career_path_id" class="form-select @error('career_path_id') is-invalid @enderror">
                    <option value="">Select Path</option>
                    @foreach($careerPaths as $path)
                        <option value="{{ $path->id }}" {{ old('career_path_id', $user->career_path_id) == $path->id ? 'selected' : '' }}>{{ $path->name }}</option>
                    @endforeach
                </select>
                @error('career_path_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-muted small mb-1">CV LINK (TEXT/URL)</label>
                <input name="cv" type="text" class="form-control @error('cv') is-invalid @enderror"
                    value="{{ old('cv', $user->cv) }}" placeholder="Link to your CV">
                @error('cv') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 mt-4 d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary rounded-pill px-5">
                    {{ __('Save Changes') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-success small fw-medium">
                        <i class="bi bi-check-circle-fill me-1"></i> {{ __('Saved successfully.') }}
                    </span>
                @endif
            </div>
        </div>
    </form>
</section>