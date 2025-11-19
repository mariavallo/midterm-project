@extends('layouts.app')

@section('title', 'Add Student - Library TPS')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex align-items-center">
                    <i class="fas fa-user-plus me-2"></i>
                    <h4 class="mb-0">Add New Student</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Student ID</label>
                                <input type="text" name="student_id" class="form-control rounded-3 shadow-sm" value="{{ old('student_id') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control rounded-3 shadow-sm" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">First Name</label>
                                <input type="text" name="first_name" class="form-control rounded-3 shadow-sm" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Last Name</label>
                                <input type="text" name="last_name" class="form-control rounded-3 shadow-sm" value="{{ old('last_name') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Phone</label>
                                <input type="text" name="phone" class="form-control rounded-3 shadow-sm" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Course</label>
                                <input type="text" name="course" class="form-control rounded-3 shadow-sm" value="{{ old('course') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Year Level</label>
                                <select name="year_level" class="form-select rounded-3 shadow-sm" required>
                                    <option value="">Select Year</option>
                                    @for($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}" {{ old('year_level') == $i ? 'selected' : '' }}>
                                            {{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4 fw-semibold">
                                <i class="fas fa-save"></i> Save Student
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
