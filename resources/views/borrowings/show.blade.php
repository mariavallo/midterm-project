{{-- resources/views/borrowings/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Borrowing Details - Library TPS')

@section('content')
<!-- Animated Background -->
<div class="position-relative overflow-hidden">
    <!-- Floating Particles Background -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
        <div class="floating-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-info text-white rounded-top-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle me-3">
                                <i class="fas fa-book-reader fa-2x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0"><i class="fas fa-book-reader"></i> Borrowing Details</h4>
                                <small class="opacity-90">Transaction Information</small>
                            </div>
                        </div>
                        <span class="badge bg-light text-dark fs-6">ID: {{ $borrowing->id }}</span>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Student Information -->
                            <div class="col-12 mb-4">
                                <h5 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-user-graduate me-2"></i>Student Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="student-avatar me-3">
                                                <i class="fas fa-user-graduate text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">
                                                    <strong>{{ $borrowing->student->first_name }} {{ $borrowing->student->last_name }}</strong>
                                                </h6>
                                                <small class="text-muted">{{ $borrowing->student->student_id }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold text-muted" width="40%">Course:</td>
                                                <td>{{ $borrowing->student->course ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-muted">Year Level:</td>
                                                <td>
                                                    @if($borrowing->student->year_level)
                                                        <span class="badge bg-primary">
                                                            {{ $borrowing->student->year_level }}{{ $borrowing->student->year_level == 1 ? 'st' : ($borrowing->student->year_level == 2 ? 'nd' : ($borrowing->student->year_level == 3 ? 'rd' : 'th')) }} Year
                                                        </span>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-muted">Email:</td>
                                                <td>
                                                    <a href="mailto:{{ $borrowing->student->email }}" class="text-decoration-none">
                                                        <i class="fas fa-envelope me-1"></i>{{ $borrowing->student->email ?? 'N/A' }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Book Information -->
                            <div class="col-12 mb-4">
                                <h5 class="text-success border-bottom pb-2 mb-3">
                                    <i class="fas fa-book me-2"></i>Book Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="book-avatar me-3">
                                                <i class="fas fa-book text-info"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">
                                                    <strong>{{ $borrowing->book->title }}</strong>
                                                </h6>
                                                <small class="text-muted">{{ $borrowing->book->author }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold text-muted" width="40%">ISBN:</td>
                                                <td>{{ $borrowing->book->isbn ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-muted">Category:</td>
                                                <td>
                                                    <span class="badge category-badge rounded-pill">
                                                        {{ $borrowing->book->category ?? 'Uncategorized' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-muted">Availability:</td>
                                                <td>
                                                    <span class="badge bg-{{ $borrowing->book->copies_available > 0 ? 'success' : 'danger' }} rounded-pill">
                                                        {{ $borrowing->book->copies_available }}/{{ $borrowing->book->total_copies }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Borrowing Details -->
                            <div class="col-12 mb-4">
                                <h5 class="text-warning border-bottom pb-2 mb-3">
                                    <i class="fas fa-calendar-alt me-2"></i>Borrowing Details
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold text-muted" width="40%">Borrowed Date:</td>
                                                <td>
                                                    <div class="date-info">
                                                        <span class="fw-semibold">{{ $borrowing->borrowed_date->format('M d, Y') }}</span>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>{{ $borrowing->borrowed_date->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-muted">Due Date:</td>
                                                <td>
                                                    @php
                                                        $isOverdue = $borrowing->status === 'borrowed' && $borrowing->due_date < now();
                                                    @endphp
                                                    <div class="date-info">
                                                        <span class="fw-semibold {{ $isOverdue ? 'text-danger' : '' }}">
                                                            {{ $borrowing->due_date->format('M d, Y') }}
                                                        </span>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fas fa-hourglass-half me-1"></i>{{ $borrowing->due_date->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold text-muted" width="40%">Status:</td>
                                                <td>
                                                    @if($borrowing->status === 'borrowed')
                                                        @if($borrowing->due_date < now())
                                                            <span class="badge bg-danger rounded-pill pulse-animation">
                                                                <i class="fas fa-exclamation-triangle me-1"></i>Overdue
                                                            </span>
                                                        @else
                                                            <span class="badge bg-warning text-dark rounded-pill">
                                                                <i class="fas fa-book-open me-1"></i>Borrowed
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-success rounded-pill">
                                                            <i class="fas fa-check me-1"></i>Returned
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if($borrowing->returned_date)
                                            <tr>
                                                <td class="fw-semibold text-muted">Returned Date:</td>
                                                <td>
                                                    <div class="date-info">
                                                        <span class="fw-semibold">{{ $borrowing->returned_date->format('M d, Y') }}</span>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fas fa-check-circle me-1"></i>{{ $borrowing->returned_date->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td class="fw-semibold text-muted">Duration:</td>
                                                <td>
                                                    @if($borrowing->status === 'returned' && $borrowing->returned_date)
                                                        {{ $borrowing->borrowed_date->diffInDays($borrowing->returned_date) }} days
                                                    @else
                                                        {{ $borrowing->borrowed_date->diffInDays(now()) }} days (ongoing)
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Information Card -->
                            <div class="col-12 mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card bg-light border-0 h-100">
                                            <div class="card-body text-center">
                                                <div class="display-6 text-info mb-2">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                                <h6 class="text-primary mb-1">Days Borrowed</h6>
                                                <h4 class="text-primary">{{ $borrowing->borrowed_date->diffInDays(now()) }}</h4>
                                                <small class="text-muted">Total Days</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light border-0 h-100">
                                            <div class="card-body text-center">
                                                <div class="display-6 mb-2 {{ $isOverdue ? 'text-danger' : 'text-success' }}">
                                                    <i class="fas fa-{{ $isOverdue ? 'exclamation-triangle' : 'clock' }}"></i>
                                                </div>
                                                <h6 class="{{ $isOverdue ? 'text-danger' : 'text-success' }} mb-1">
                                                    {{ $isOverdue ? 'Overdue By' : 'Days Remaining' }}
                                                </h6>
                                                <h4 class="{{ $isOverdue ? 'text-danger' : 'text-success' }}">
                                                    {{ abs($borrowing->due_date->diffInDays(now())) }}
                                                </h4>
                                                <small class="text-muted">Days</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light border-0 h-100">
                                            <div class="card-body text-center">
                                                <div class="display-6 text-warning mb-2">
                                                    <i class="fas fa-user-check"></i>
                                                </div>
                                                <h6 class="text-warning mb-1">Borrower Status</h6>
                                                <h5 class="text-warning">Active</h5>
                                                <small class="text-muted">Member</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center gap-2 mt-4 pt-3 border-top">
                            <div>
                                <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary rounded-pill px-4 hover-lift">
                                    <i class="fas fa-arrow-left"></i> Back to Borrowings
                                </a>
                            </div>
                            <div class="d-flex gap-2">
                                @if($borrowing->status !== 'returned')
                                    <button class="btn btn-success rounded-pill px-4 hover-lift return-btn" 
                                            data-borrowing-id="{{ $borrowing->id }}"
                                            data-bs-toggle="tooltip" title="Mark as Returned">
                                        <i class="fas fa-check me-2"></i>Mark as Returned
                                    </button>
                                @endif
                                <button class="btn btn-outline-danger rounded-pill px-4 hover-lift delete-btn" 
                                        data-borrowing-id="{{ $borrowing->id }}"
                                        data-bs-toggle="tooltip" title="Delete Record">
                                    <i class="fas fa-trash-alt me-2"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Return Confirmation Modal -->
<div class="modal fade" id="returnModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-success">
                    <i class="fas fa-check-circle me-2"></i>Confirm Return
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Mark this book as returned?</p>
                <small class="text-muted">This will update the borrowing status and make the book available for others.</small>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                <form id="returnForm" method="POST" class="d-inline">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-success rounded-pill">
                        <i class="fas fa-check me-2"></i>Mark as Returned
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete this borrowing record?</p>
                <small class="text-muted">This action cannot be undone and will permanently remove this transaction record.</small>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">
                        <i class="fas fa-trash me-2"></i>Delete Record
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Animations & Effects */
.icon-circle {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.hover-lift {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.student-avatar, .book-avatar {
    width: 55px;
    height: 55px;
    background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.book-avatar {
    background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
}

.category-badge {
    background: linear-gradient(45deg, #a8edea, #fed6e3);
    color: #666;
}

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}

.floating-particles {
    position: relative;
    width: 100%;
    height: 100%;
}

.particle {
    position: absolute;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.particle:nth-child(1) { width: 20px; height: 20px; left: 10%; animation-delay: 0s; }
.particle:nth-child(2) { width: 15px; height: 15px; left: 70%; animation-delay: 2s; }
.particle:nth-child(3) { width: 25px; height: 25px; left: 40%; animation-delay: 4s; }
.particle:nth-child(4) { width: 18px; height: 18px; left: 80%; animation-delay: 1s; }
.particle:nth-child(5) { width: 22px; height: 22px; left: 20%; animation-delay: 3s; }

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-20px) rotate(120deg); }
    66% { transform: translateY(-10px) rotate(240deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .student-avatar, .book-avatar { width: 45px; height: 45px; }
    .d-flex.gap-2 { flex-direction: column; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Return modal functionality
    const returnModal = new bootstrap.Modal(document.getElementById('returnModal'));
    const returnButtons = document.querySelectorAll('.return-btn');
    
    returnButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const borrowingId = this.getAttribute('data-borrowing-id');
            document.getElementById('returnForm').action = `/borrowings/${borrowingId}/return`;
            returnModal.show();
        });
    });

    // Delete modal functionality
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const borrowingId = this.getAttribute('data-borrowing-id');
            document.getElementById('deleteForm').action = `/borrowings/${borrowingId}`;
            deleteModal.show();
        });
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection