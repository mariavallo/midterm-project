{{-- resources/views/borrowings/create.blade.php --}}
@extends('layouts.app')

@section('title', 'New Borrowing - Library TPS')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-book-reader"></i> New Book Borrowing</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('borrowings.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Student</label>
                            <select name="student_id" class="form-select" required>
                                <option value="">Select Student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->student_id }} - {{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Book</label>
                            <select name="book_id" class="form-select" required>
                                <option value="">Select Book</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }} - {{ $book->author }} (Available: {{ $book->copies_available }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Borrowed Date</label>
                            <input type="date" name="borrowed_date" class="form-control" 
                                   value="{{ old('borrowed_date', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" class="form-control" 
                                   value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}" required>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Borrowing
                        </button>
                        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection