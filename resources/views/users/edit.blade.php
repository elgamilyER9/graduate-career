@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center animate__animated animate__fadeIn">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('users.index') }}"
                        class="btn btn-light rounded-circle p-2 me-3 shadow-sm transition-hover">
                        <i class="bi bi-arrow-left h5 mb-0"></i>
                    </a>
                    <h2 class="fw-bold text-dark mb-0">Edit User: {{ $user->name }}</h2>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('users.update', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-bold text-muted small mb-1">NAME</label>
                                    <input type="text" name="name"
                                        class="form-control form-control-lg rounded-3 border-light bg-light @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" placeholder="Enter full name" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold text-muted small mb-1">EMAIL ADDRESS</label>
                                    <input type="email" name="email"
                                        class="form-control form-control-lg rounded-3 border-light bg-light @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" placeholder="name@example.com" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold text-muted small mb-1">ROLE</label>
                                    <select name="role"
                                        class="form-select form-select-lg rounded-3 border-light bg-light @error('role') is-invalid @enderror"
                                        required>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>{{ __('User') }}</option>
                                        <option value="mentor" {{ old('role', $user->role) == 'mentor' ? 'selected' : '' }}>{{ __('Mentor') }}</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                                    </select>
                                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold text-muted small mb-1">PASSWORD (LEAVE BLANK TO KEEP
                                        CURRENT)</label>
                                    <input type="password" name="password"
                                        class="form-control form-control-lg rounded-3 border-light bg-light @error('password') is-invalid @enderror"
                                        placeholder="min. 8 characters">
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold text-muted small mb-1">CONFIRM PASSWORD</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg rounded-3 border-light bg-light"
                                        placeholder="Repeat password">
                                </div>

                                <hr class="my-4 text-muted opacity-10">

                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold text-muted small mb-1">UNIVERSITY</label>
                                    <select name="university_id" class="form-select rounded-3 border-light bg-light">
                                        <option value="">Select University</option>
                                        @foreach($universities as $university)
                                            <option value="{{ $university->id }}" {{ $user->university_id == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold text-muted small mb-1">FACULTY</label>
                                    <select name="faculty_id" class="form-select rounded-3 border-light bg-light">
                                        <option value="">Select Faculty</option>
                                        @foreach($faculties as $faculty)
                                            <option value="{{ $faculty->id }}" {{ $user->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold text-muted small mb-1">CAREER PATH</label>
                                    <select name="career_path_id" class="form-select rounded-3 border-light bg-light">
                                        <option value="">Select Career Path</option>
                                        @foreach($careerPaths as $path)
                                            <option value="{{ $path->id }}" {{ $user->career_path_id == $path->id ? 'selected' : '' }}>{{ $path->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 text-end mt-5">
                                    <button type="submit"
                                        class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-sm">
                                        <i class="bi bi-pencil-square me-2"></i> Update User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .rounded-4 {
            border-radius: 1rem !important;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff !important;
            border-color: #FFC107 !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.1) !important;
        }

        .transition-hover:hover {
            transform: scale(1.1);
            background-color: #f8f9fa;
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1) !important;
        }

        @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
    </style>
@endsection