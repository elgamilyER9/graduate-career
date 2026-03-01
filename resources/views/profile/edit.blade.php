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
                    <h2 class="fw-bold text-dark mb-0">Profile <span class="text-primary">Settings</span></h2>
                </div>

                <div class="space-y-6">
                    <!-- Profile Information -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 animate__animated animate__fadeInUp"
                        style="animation-delay: 0.1s;">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Update Password -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 animate__animated animate__fadeInUp"
                        style="animation-delay: 0.2s;">
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Delete Account -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 animate__animated animate__fadeInUp"
                        style="animation-delay: 0.3s;">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .space-y-6>*+* {
            margin-top: 1.5rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
            border-radius: 10px;
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