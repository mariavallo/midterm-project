{{-- resources/views/books/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Add Book - Library TPS')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-book-medical"></i> Add New Book</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Publisher</label>
                            <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Publication Year</label>
                            <input type="number" name="publication_year" class="form-control" 
                                   min="1900" max="{{ date('Y') }}" value="{{ old('publication_year') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select" required>
                                <option value="">Select Category</option>
                                <option value="Fiction" {{ old('category') == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                                <option value="Non-Fiction" {{ old('category') == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                                <option value="Science" {{ old('category') == 'Science' ? 'selected' : '' }}>Science</option>
                                <option value="Technology" {{ old('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                <option value="History" {{ old('category') == 'History' ? 'selected' : '' }}>History</option>
                                <option value="Biography" {{ old('category') == 'Biography' ? 'selected' : '' }}>Biography</option>
                                <option value="Reference" {{ old('category') == 'Reference' ? 'selected' : '' }}>Reference</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Total Copies</label>
                            <input type="number" name="total_copies" class="form-control" min="1" value="{{ old('total_copies', 1) }}" required>
                        </div>
                    </div>
                    <input type="hidden" name="copies_available" id="copies_available" value="1">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Book
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto set available copies equal to total copies for new books
    document.querySelector('[name="total_copies"]').addEventListener('input', function() {
        document.getElementById('copies_available').value = this.value;
    });
</script>
@endsection