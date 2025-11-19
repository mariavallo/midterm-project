{{-- resources/views/borrowings/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Borrowings - Library TPS')

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
        <!-- Header Section with Gradient -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 bg-gradient-primary text-white shadow-lg rounded-4 overflow-hidden position-relative">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle me-3">
                                    <i class="fas fa-exchange-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h2 class="mb-0 fw-bold"><i class="fas fa-exchange-alt"></i> Borrowings</h2>
                                    <p class="mb-0 opacity-90">Track book lending activities</p>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('borrowings.create') }}" class="btn btn-light btn-lg rounded-pill shadow-sm hover-lift px-4">
                                    <i class="fas fa-plus me-2"></i>New Borrowing
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative Wave -->
                    <div class="wave-decoration"></div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="search-box position-relative">
                                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" class="form-control form-control-lg border-0 bg-light rounded-pill ps-5" 
                                           placeholder="Search by student name, book title, or ID..." id="borrowingSearch">
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <div class="btn-group rounded-pill overflow-hidden shadow-sm" role="group">
                                    <button class="btn btn-outline-secondary active filter-btn" data-filter="all">
                                        <i class="fas fa-list me-1"></i>All
                                    </button>
                                    <button class="btn btn-outline-secondary filter-btn" data-filter="borrowed">
                                        <i class="fas fa-book-open me-1"></i>Borrowed
                                    </button>
                                    <button class="btn btn-outline-secondary filter-btn" data-filter="overdue">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Overdue
                                    </button>
                                    <button class="btn btn-outline-secondary filter-btn" data-filter="returned">
                                        <i class="fas fa-check me-1"></i>Returned
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrowings Grid/Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Stats Bar -->
                    <div class="bg-light border-bottom p-3">
                        <div class="row text-center">
                            <div class="col-6 col-md-3">
                                <div class="stat-item">
                                    <h4 class="text-primary mb-0">{{ $borrowings->count() }}</h4>
                                    <small class="text-muted">Total Borrowings</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-item">
                                    <h4 class="text-warning mb-0">{{ $borrowings->where('status', 'borrowed')->count() }}</h4>
                                    <small class="text-muted">Active Loans</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-item">
                                    <h4 class="text-danger mb-0">{{ $borrowings->where('status', 'borrowed')->where('due_date', '<', now())->count() }}</h4>
                                    <small class="text-muted">Overdue</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-item">
                                    <h4 class="text-success mb-0">{{ $borrowings->where('status', 'returned')->count() }}</h4>
                                    <small class="text-muted">Returned</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 modern-table">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-hashtag me-2"></i>ID
                                                </div>
                                            </th>
                                            <th class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user-graduate me-2"></i>Student
                                                </div>
                                            </th>
                                            <th class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-book me-2"></i>Book
                                                </div>
                                            </th>
                                            <th class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-calendar-alt me-2"></i>Borrowed Date
                                                </div>
                                            </th>
                                            <th class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-calendar-times me-2"></i>Due Date
                                                </div>
                                            </th>
                                            <th class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-info-circle me-2"></i>Status
                                                </div>
                                            </th>
                                            <th class="border-0 py-3 text-center">
                                                <i class="fas fa-cog me-2"></i>Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="borrowingsTableBody">
                                        @forelse($borrowings as $borrowing)
                                            @php
                                                $isOverdue = $borrowing->status === 'borrowed' && $borrowing->due_date < now();
                                                $statusClass = $borrowing->status === 'returned' ? 'returned' : ($isOverdue ? 'overdue' : 'borrowed');
                                            @endphp
                                            <tr class="borrowing-row hover-effect" 
                                                data-status="{{ $statusClass }}" 
                                                data-search="{{ strtolower($borrowing->student->first_name . ' ' . $borrowing->student->last_name . ' ' . $borrowing->student->student_id . ' ' . $borrowing->book->title . ' ' . $borrowing->id) }}">
                                                <td class="py-3">
                                                    <div class="id-badge">
                                                        <span class="badge bg-light text-dark fs-6 rounded-pill px-3 py-2">
                                                            {{ $borrowing->id }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
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
                                                </td>
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
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
                                                </td>
                                                <td class="py-3">
                                                    <div class="date-info">
                                                        <span class="fw-semibold">{{ $borrowing->borrowed_date->format('M d, Y') }}</span>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>{{ $borrowing->borrowed_date->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="py-3">
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
                                                <td class="py-3">
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
                                                <td class="py-3 text-center">
                                                    <div class="action-buttons">
                                                        <div class="d-flex gap-1 justify-content-center">
                                                            <a href="{{ route('borrowings.show', $borrowing) }}" 
                                                               class="btn btn-sm btn-outline-primary hover-lift" 
                                                               data-bs-toggle="tooltip" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            @if($borrowing->status !== 'returned')
                                                                <button class="btn btn-sm btn-success hover-lift return-btn" 
                                                                        data-borrowing-id="{{ $borrowing->id }}"
                                                                        data-bs-toggle="tooltip" title="Mark as Returned">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            @endif
                                                            <button class="btn btn-sm btn-outline-danger hover-lift delete-btn" 
                                                                    data-borrowing-id="{{ $borrowing->id }}"
                                                                    data-bs-toggle="tooltip" title="Delete Record">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr id="noBorrowingsRow">
                                                <td colspan="7" class="text-center py-5">
                                                    <div class="empty-state">
                                                        <div class="empty-icon mb-3">
                                                            <i class="fas fa-exchange-alt fa-3x text-muted"></i>
                                                        </div>
                                                        <h5 class="text-muted">No borrowing records found</h5>
                                                        <p class="text-muted">Start tracking book loans!</p>
                                                        <a href="{{ route('borrowings.create') }}" class="btn btn-primary rounded-pill">
                                                            <i class="fas fa-plus me-2"></i>New Borrowing
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Enhanced Pagination -->
                            <div class="card-footer bg-light border-top-0 rounded-bottom-4 p-4">
                                <div class="d-flex justify-content-center">
                                    {{ $borrowings->links() }}
                                </div>
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
                <small class="text-muted">This will update the borrowing status.</small>
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
                <small class="text-muted">This action cannot be undone.</small>
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
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

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

.hover-effect:hover {
    transform: scale(1.01);
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.student-avatar, .book-avatar {
    width: 45px;
    height: 45px;
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

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}

.wave-decoration {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 20px;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z' fill='%23fff'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
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

.filter-btn.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
}

.search-box input:focus {
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    border-color: #667eea;
}

.modern-table thead th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.empty-state .empty-icon {
    opacity: 0.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stat-item h4 { font-size: 1.2rem; }
    .action-buttons .d-flex { flex-direction: column; }
    .student-avatar, .book-avatar { width: 35px; height: 35px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('borrowingSearch');
    const tableBody = document.getElementById('borrowingsTableBody');
    const borrowingRows = document.querySelectorAll('.borrowing-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        borrowingRows.forEach(row => {
            const searchData = row.getAttribute('data-search');
            if (searchData.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            borrowingRows.forEach(row => {
                if (filter === 'all' || row.getAttribute('data-status') === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

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