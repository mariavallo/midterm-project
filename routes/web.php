<?php
// routes/web.php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Students Routes (CRUD)
Route::resource('students', StudentController::class);

// Books Routes (CRUD)
Route::resource('books', BookController::class);

// Borrowings Routes (CRUD + Custom Actions)
Route::resource('borrowings', BorrowingController::class);
Route::patch('borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
     ->name('borrowings.return');