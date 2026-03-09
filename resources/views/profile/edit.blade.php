@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Admin Shortcut -->
        @if(Auth::user()->role === 'admin')
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-lg-9 animate__animated animate__fadeInDown">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-white"
                        style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="fw-bold mb-1">Admin Dashboard Quick Access</h4>
                                <p class="text-white-50 mb-0 small">Access all management tools and configurations.</p>
                            </div>
                            <a href="{{ route('home') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">
                                <i class="bi bi-speedometer2 me-2"></i> Go to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="d-flex align-items-center mb-4 animate__animated animate__fadeInLeft">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-gear fs-4"></i>
                    </div>
                    <h2 class="fw-black text-dark mb-0" style="letter-spacing: -0.5px;">{{ __('Profile') }} <span class="text-primary">{{ __('Settings') }}</span></h2>
                </div>

                <div class="space-y-6">
                    <!-- Profile Information -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4 animate__animated animate__fadeInUp position-relative overflow-hidden"
                        style="animation-delay: 0.1s; border-left: 4px solid #0d6efd !important;">
                        <div class="card-header bg-white border-bottom border-light p-4 pb-0">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-person-lines-fill text-primary me-2"></i>{{ __('Profile Information') }}</h5>
                            <p class="text-muted small mt-1 mb-0">{{ __('Update your account profile information and email address.') }}</p>
                        </div>
                        <div class="card-body p-4 pt-3">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4 animate__animated animate__fadeInUp position-relative overflow-hidden"
                        style="animation-delay: 0.2s; border-left: 4px solid #198754 !important;">
                        <div class="card-header bg-white border-bottom border-light p-4 pb-0">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-shield-lock-fill text-success me-2"></i>{{ __('Update Password') }}</h5>
                            <p class="text-muted small mt-1 mb-0">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                        </div>
                        <div class="card-body p-4 pt-3">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="card border-0 shadow-sm rounded-4 animate__animated animate__fadeInUp position-relative overflow-hidden"
                        style="animation-delay: 0.3s; border-left: 4px solid #dc3545 !important;">
                        <div class="card-header bg-white border-bottom border-light p-4 pb-0">
                            <h5 class="fw-bold text-danger mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ __('Delete Account') }}</h5>
                            <p class="text-muted small mt-1 mb-0">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
                        </div>
                        <div class="card-body p-4 pt-3">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .space-y-6>*+* {
            margin-top: 2rem;
        }
        
        .fw-black { font-weight: 900; }

        .form-control,
        .form-select {
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0D6EFD;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->userDeletion->any())
                const modal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                modal.show();
            @endif

                const universitySelect = document.getElementById('university_id');
            const facultySelect = document.getElementById('faculty_id');
            const careerPathSelect = document.getElementById('career_path_id');

            function toggleOther(selectElement, containerId) {
                const container = document.getElementById(containerId);
                if (container) {
                    if (selectElement.value === 'other') {
                        container.classList.remove('d-none');
                    } else {
                        container.classList.add('d-none');
                    }
                }
            }

            if (universitySelect) {
                universitySelect.addEventListener('change', function () {
                    toggleOther(this, 'other_university_container');
                });
            }

            if (facultySelect) {
                facultySelect.addEventListener('change', function () {
                    toggleOther(this, 'other_faculty_container');
                });
            }

            if (careerPathSelect) {
                careerPathSelect.addEventListener('change', function () {
                    toggleOther(this, 'other_career_path_container');
                });
            }
        });
    </script>
@endsection