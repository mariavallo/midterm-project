{{-- resources/views/students/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Students - Library TPS')

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
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle me-3">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <div>
                                    <h2 class="mb-0 fw-bold">Student Management</h2>
                                    <p class="mb-0 opacity-90">Manage your library members</p>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('students.create') }}" class="btn btn-light btn-lg rounded-pill shadow-sm hover-lift px-4">
                                    <i class="fas fa-plus me-2"></i>Add New Student
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
                                           placeholder="Search students by name, ID, or email..." id="studentSearch">
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <div class="btn-group rounded-pill overflow-hidden shadow-sm" role="group">
                                    <button class="btn btn-outline-secondary active filter-btn" data-filter="all">
                                        <i class="fas fa-users me-1"></i>All
                                    </button>
                                    <button class="btn btn-outline-secondary filter-btn" data-filter="1">
                                        1st Year
                                    </button>
                                    <button class="btn btn-outline-secondary filter-btn" data-filter="2">
                                        2nd Year
                                    </button>
                                    <button class="btn btn-outline-secondary filter-btn" data-filter="3">
                                        3rd Year
                                    </button>
                                    <button class="btn btn-outline-secondary filter-btn" data-filter="4">
                                        4th Year
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Grid/Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Stats Bar -->
                    <div class="bg-light border-bottom p-3">
                        <div class="row text-center">
                            <div class="col-6 col-md-3">
                                <div class="stat-item">
                                    <h4 class="text-primary mb-0">{{ $students->count() }}</h4>
                                    <small class="text-muted">Total Students</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-item">
                                    <h4 class="text-success mb-0">{{ $students->where('borrowings.status', 'borrowed')->count() }}</h4>
                                    <small class="text-muted">Active Borrowers</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-item">
                                    <h4 class="text-warning mb-0">{{ $students->where('year_level', 1)->count() }}</h4>
                                    <small class="text-muted">Freshmen</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-item">
                                    <h4 class="text-info mb-0">{{ $students->where('year_level', 4)->count() }}</h4>
                                    <small class="text-muted">Seniors</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 modern-table">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="border-0 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-id-badge me-2"></i>Student ID
                                            </div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user me-2"></i>Student
                                            </div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-graduation-cap me-2"></i>Academic Info
                                            </div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-book me-2"></i>Library Status
                                            </div>
                                        </th>
                                        <th class="border-0 py-3 text-center">
                                            <i class="fas fa-cog me-2"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="studentsTableBody">
                                    @forelse($students as $student)
                                        <tr class="student-row hover-effect" data-year="{{ $student->year_level }}" 
                                            data-search="{{ strtolower($student->full_name . ' ' . $student->student_id . ' ' . $student->email) }}">
                                            <td class="py-3">
                                                <div class="student-id-badge">
                                                    <span class="badge bg-light text-dark fs-6 rounded-pill px-3 py-2">
                                                        {{ $student->student_id }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-3">
                                                        <i class="fas fa-user-graduate text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">{{ $student->full_name }}</h6>
                                                        <small class="text-muted">
                                                            <i class="fas fa-envelope me-1"></i>{{ $student->email }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div>
                                                    <div class="fw-semibold mb-1">{{ $student->course }}</div>
                                                    <span class="badge year-badge-{{ $student->year_level }} rounded-pill">
                                                        {{ $student->year_level }}{{ $student->year_level == 1 ? 'st' : ($student->year_level == 2 ? 'nd' : ($student->year_level == 3 ? 'rd' : 'th')) }} Year
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex flex-column align-items-start">
                                                    @php
                                                        $activeBorrowings = $student->borrowings ? $student->borrowings->where('status', 'borrowed')->count() : 0;
                                                    @endphp
                                                    <div class="borrowing-status mb-1">
                                                        @if($activeBorrowings > 0)
                                                            <span class="badge bg-warning text-dark rounded-pill pulse-animation">
                                                                <i class="fas fa-book-open me-1"></i>{{ $activeBorrowings }} Active
                                                            </span>
                                                        @else
                                                            <span class="badge bg-success rounded-pill">
                                                                <i class="fas fa-check me-1"></i>All Clear
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock me-1"></i>Joined {{ $student->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td class="py-3 text-center">
                                                <div class="action-buttons">
                                                    <div class="btn-group shadow-sm rounded-pill overflow-hidden" role="group">
                                                        <a href="{{ route('students.show', $student) }}" 
                                                           class="btn btn-outline-primary btn-sm hover-lift" 
                                                           data-bs-toggle="tooltip" title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('students.edit', $student) }}" 
                                                           class="btn btn-outline-warning btn-sm hover-lift" 
                                                           data-bs-toggle="tooltip" title="Edit Student">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button class="btn btn-outline-danger btn-sm hover-lift delete-btn" 
                                                                data-student-id="{{ $student->id }}"
                                                                data-student-name="{{ $student->full_name }}"
                                                                data-bs-toggle="tooltip" title="Delete Student">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="noStudentsRow">
                                            <td colspan="5" class="text-center py-5">
                                                <div class="empty-state">
                                                    <div class="empty-icon mb-3">
                                                        <i class="fas fa-users fa-3x text-muted"></i>
                                                    </div>
                                                    <h5 class="text-muted">No Students Found</h5>
                                                    <p class="text-muted">Get started by adding your first student!</p>
                                                    <a href="{{ route('students.create') }}" class="btn btn-primary rounded-pill">
                                                        <i class="fas fa-plus me-2"></i>Add Student
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Enhanced Pagination -->
                    <div class="card-footer bg-light border-top-0 rounded-bottom-4 p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} 
                                of {{ $students->total() ?? 0 }} students
                            </div>
                            <div>
                                {{ $students->links() }}
                            </div>
                        </div>
                    </div>
                </div>
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
                <p class="mb-0">Are you sure you want to delete student <strong id="studentNameToDelete"></strong>?</p>
                <small class="text-muted">This action cannot be undone.</small>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">
                        <i class="fas fa-trash-alt me-2"></i>Delete Student
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

.avatar-circle {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.year-badge-1 { background: linear-gradient(45deg, #ff9a9e, #fecfef); color: #fff; }
.year-badge-2 { background: linear-gradient(45deg, #a8edea, #fed6e3); color: #666; }
.year-badge-3 { background: linear-gradient(45deg, #ffecd2, #fcb69f); color: #666; }
.year-badge-4 { background: linear-gradient(45deg, #667eea, #764ba2); color: #fff; }

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
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
    .action-buttons .btn-group { flex-direction: column; }
    .avatar-circle { width: 35px; height: 35px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('studentSearch');
    const tableBody = document.getElementById('studentsTableBody');
    const studentRows = document.querySelectorAll('.student-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        studentRows.forEach(row => {
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
            
            studentRows.forEach(row => {
                if (filter === 'all' || row.getAttribute('data-year') === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // Delete modal functionality
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const studentId = this.getAttribute('data-student-id');
            const studentName = this.getAttribute('data-student-name');
            
            document.getElementById('studentNameToDelete').textContent = studentName;
            document.getElementById('deleteForm').action = `/students/${studentId}`;
            
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