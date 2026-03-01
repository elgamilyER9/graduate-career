@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('trainings.index') }}" class="btn btn-light rounded-circle p-2 me-3 shadow-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold text-dark mb-1">{{ $training->name ?? $training->title }}</h2>
                <p class="text-muted mb-0">{{ __('Training Program Details') }}</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-5 mb-4">
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">{{ __('Program Overview') }}</h5>
                        <p class="text-muted">{{ $training->description ?? __('No description provided.') }}</p>
                    </div>

                    <hr class="my-4">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted small mb-2">{{ __('PROVIDER') }}</h6>
                            <p class="fw-bold text-dark">{{ $training->provider ?? __('Not specified') }}</p>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted small mb-2">{{ __('CAREER PATH') }}</h6>
                            <p class="fw-bold">
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">
                                    {{ $training->careerPath->name ?? __('N/A') }}
                                </span>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted small mb-2">{{ __('MENTOR') }}</h6>
                            <p class="fw-bold text-dark">{{ $training->mentor->name ?? __('Not assigned') }}</p>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted small mb-2">{{ __('ENROLLED STUDENTS') }}</h6>
                            <p class="fw-bold text-dark">{{ $training->enrollments_count ?? 0 }} {{ __('students') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Students -->
                <div class="card border-0 shadow-sm rounded-4 p-5">
                    <h5 class="fw-bold text-dark mb-4">{{ __('Enrolled Students') }}</h5>

                    @if($training->students && $training->students->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('NAME') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('EMAIL') }}</th>
                                        <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('STATUS') }}</th>
                                        @if(auth()->user()->role === 'admin' || auth()->user()->id === $training->mentor_id)
                                            <th class="px-4 py-3 border-0 text-muted small fw-bold">{{ __('ACTIONS') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($training->students as $student)
                                        <tr>
                                            <td class="px-4 py-3 border-0 fw-bold text-dark">{{ $student->name }}</td>
                                            <td class="px-4 py-3 border-0 text-muted">{{ $student->email }}</td>
                                            <td class="px-4 py-3 border-0">
                                                @php
                                                    $status = $student->pivot->status;
                                                    $badgeClass = 'bg-secondary';
                                                    if ($status === 'pending') $badgeClass = 'bg-warning text-dark';
                                                    elseif ($status === 'enrolled') $badgeClass = 'bg-success';
                                                    elseif ($status === 'completed') $badgeClass = 'bg-primary';
                                                    elseif ($status === 'dropped') $badgeClass = 'bg-danger';
                                                @endphp
                                                <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ __($status === 'pending' ? 'Pending' : ($status === 'enrolled' ? 'Enrolled' : ucfirst($status))) }}</span>
                                            </td>
                                            @if(auth()->user()->role === 'admin' || auth()->user()->id === $training->mentor_id)
                                                <td class="px-4 py-3 border-0">
                                                    @if($student->pivot->status === 'pending')
                                                        <div class="d-flex gap-2">
                                                            <form method="POST" action="{{ route('training_enrollments.update', $student->pivot->id) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="enrolled">
                                                                <button class="btn btn-sm btn-success">{{ __('Approve') }}</button>
                                                            </form>
                                                            <form method="POST" action="{{ route('training_enrollments.update', $student->pivot->id) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="dropped">
                                                                <button class="btn btn-sm btn-danger">{{ __('Decline') }}</button>
                                                            </form>
                                                        </div>
                                                    @elseif($student->pivot->status === 'enrolled')
                                                        <form method="POST" action="{{ route('training_enrollments.update', $student->pivot->id) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="dropped">
                                                            <button class="btn btn-sm btn-outline-danger">{{ __('Drop') }}</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info border-0 rounded-4" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            {{ __('No students enrolled in this training yet.') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4">
                <!-- Actions Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-dark mb-3">{{ __('Actions') }}</h6>
                    @if(auth()->user()->id === $training->mentor_id || auth()->user()->role === 'admin')
                        <a href="{{ route('trainings.edit', $training) }}" class="btn btn-primary w-100 rounded-3 mb-2 fw-bold">
                            <i class="bi bi-pencil me-2"></i> {{ __('Edit') }}
                        </a>
                        <form action="{{ route('trainings.destroy', $training) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 rounded-3 fw-bold">
                                <i class="bi bi-trash me-2"></i> {{ __('Delete') }}
                            </button>
                        </form>
                    @else
                        @php
                            $enrollment = auth()->user()->trainingEnrollments()->where('training_id', $training->id)->first();
                        @endphp
                        @if($enrollment && $enrollment->status !== 'dropped')
                            @if($enrollment->status == 'pending')
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-warning w-100 rounded-pill py-2 me-2">{{ __('Pending') }}</span>
                                    <form method="POST" action="{{ route('training_enrollments.update', $enrollment->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="dropped">
                                        <button type="submit" class="btn btn-link text-decoration-none text-danger small">
                                            {{ __('Cancel Request') }}
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="badge bg-success w-100 rounded-pill py-2">
                                    {{ __('Enrolled') }}
                                </span>
                            @endif
                        @else
                            <form action="{{ route('training_enrollments.store', $training) }}" method="POST">
                                @csrf
                                <button class="btn btn-success w-100 rounded-3 fw-bold">
                                    <i class="bi bi-check-circle me-2"></i> {{ __('Request Enrollment') }}
                                </button>
                            </form>
                        @endif
                    @endif
                </div>

                <!-- Program Information -->
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold text-dark mb-3">{{ __('Program Info') }}</h6>
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2">
                            <strong>{{ __('Created:') }}</strong> {{ $training->created_at->format('M d, Y') }}
                        </li>
                        <li class="mb-2">
                            <strong>{{ __('Last Updated:') }}</strong> {{ $training->updated_at->format('M d, Y') }}
                        </li>
                        <li>
                            <strong>{{ __('Program ID:') }}</strong> #{{ $training->id }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
