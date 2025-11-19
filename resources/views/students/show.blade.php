{{-- resources/views/students/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Details - Library TPS')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-info text-white rounded-top-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user me-2"></i>
                        <h4 class="mb-0">Student Details</h4>
                    </div>
                    <span class="badge bg-light text-dark fs-6">ID: {{ $student->student_id }}</span>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <!-- Personal Information -->
                        <div class="col-12 mb-4">
                            <h5 class="text-primary border-bottom pb-2 mb-3">
                                <i class="fas fa-id-card me-2"></i>Personal Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-semibold text-muted" width="40%">Full Name:</td>
                                            <td>{{ $student->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold text-muted">First Name:</td>
                                            <td>{{ $student->first_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold text-muted">Last Name:</td>
                                            <td>{{ $student->last_name }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-semibold text-muted" width="40%">Email:</td>
                                            <td>
                                                <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                                    <i class="fas fa-envelope me-1"></i>{{ $student->email }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold text-muted">Phone:</td>
                                            <td>
                                                @if($student->phone)
                                                    <a href="tel:{{ $student->phone }}" class="text-decoration-none">
                                                        <i class="fas fa-phone me-1"></i>{{ $student->phone }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold text-muted">Joined:</td>
                                            <td>{{ $student->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="col-12 mb-4">
                            <h5 class="text-success border-bottom pb-2 mb-3">
                                <i class="fas fa-graduation-cap me-2"></i>Academic Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-semibold text-muted" width="40%">Student ID:</td>
                                            <td class="fw-bold">{{ $student->student_id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold text-muted">Course:</td>
                                            <td>{{ $student->course }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold text-muted">Year Level:</td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ $student->year_level }}{{ $student->year_level == 1 ? 'st' : ($student->year_level == 2 ? 'nd' : ($student->year_level == 3 ? 'rd' : 'th')) }} Year
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center p-3 bg-light rounded-3">
                                        <div class="display-4 text-primary">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <p class="text-muted mb-0">Academic Status</p>
                                        <span class="badge bg-success fs-6 mt-1">Active Student</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Library Activity -->
                        <div class="col-12 mb-4">
                            <h5 class="text-warning border-bottom pb-2 mb-3">
                                <i class="fas fa-book me-2"></i>Library Activity
                            </h5>
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <div class="display-6 text-info mb-2">
                                                <i class="fas fa-book-open"></i>
                                            </div>
                                            <h3 class="text-primary mb-1">
                                                {{ $student->borrowings ? $student->borrowings->where('status', 'borrowed')->count() : 0 }}
                                            </h3>
                                            <p class="text-muted mb-0 small">Active Borrowings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <div class="display-6 text-success mb-2">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <h3 class="text-success mb-1">
                                                {{ $student->borrowings ? $student->borrowings->where('status', 'returned')->count() : 0 }}
                                            </h3>
                                            <p class="text-muted mb-0 small">Books Returned</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <div class="display-6 text-danger mb-2">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <h3 class="text-danger mb-1">
                                                {{ $student->borrowings ? $student->borrowings->where('status', 'overdue')->count() : 0 }}
                                            </h3>
                                            <p class="text-muted mb-0 small">Overdue Books</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Borrowing History (if exists) -->
                        @if($student->borrowings && $student->borrowings->count() > 0)
                        <div class="col-12 mb-4">
                            <h5 class="text-secondary border-bottom pb-2 mb-3">
                                <i class="fas fa-history me-2"></i>Recent Borrowing History
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Book</th>
                                            <th>Borrowed Date</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($student->borrowings->take(5) as $borrowing)
                                        <tr>
                                            <td>{{ $borrowing->book->title ?? 'Book Title' }}</td>
                                            <td>{{ $borrowing->borrowed_date ? $borrowing->borrowed_date->format('M d, Y') : '—' }}</td>
                                            <td>{{ $borrowing->due_date ? $borrowing->due_date->format('M d, Y') : '—' }}</td>
                                            <td>
                                                @if($borrowing->status === 'borrowed')
                                                    <span class="badge bg-warning text-dark">Borrowed</span>
                                                @elseif($borrowing->status === 'returned')
                                                    <span class="badge bg-success">Returned</span>
                                                @elseif($borrowing->status === 'overdue')
                                                    <span class="badge bg-danger">Overdue</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($borrowing->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center gap-2 mt-4 pt-3 border-top">
                        <div>
                            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                                <i class="fas fa-arrow-left"></i> Back to Students
                            </a>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning text-dark rounded-3 px-4">
                                <i class="fas fa-edit"></i> Edit Student
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger rounded-3 px-4" onclick="return confirm('Are you sure you want to delete this student?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection