<?php
// app/Http/Controllers/BorrowingController.php
namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Student;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    // READ: Display all borrowings
    public function index(): View
    {
        $borrowings = Borrowing::with(['student', 'book'])
                              ->orderBy('created_at', 'desc')
                              ->paginate(15);
        return view('borrowings.index', compact('borrowings'));
    }

    // READ: Show single borrowing
    public function show(Borrowing $borrowing): View
    {
        $borrowing->load(['student', 'book']);
        return view('borrowings.show', compact('borrowing'));
    }

    // CREATE: Show create form
    public function create(): View
    {
        $students = Student::orderBy('last_name')->get();
        $books = Book::where('copies_available', '>', 0)->orderBy('title')->get();
        return view('borrowings.create', compact('students', 'books'));
    }

    // CREATE: Store new borrowing
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_date' => 'required|date',
            'due_date' => 'required|date|after:borrowed_date'
        ]);

        $book = Book::findOrFail($validated['book_id']);
        
        if (!$book->isAvailable()) {
            return back()->withErrors(['book_id' => 'This book is not available for borrowing.']);
        }

        // Create borrowing record
        Borrowing::create($validated);
        
        // Update book availability
        $book->decrement('copies_available');

        return redirect()->route('borrowings.index')->with('success', 'Book borrowed successfully!');
    }

    // UPDATE: Return book
    public function returnBook(Borrowing $borrowing): RedirectResponse
    {
        if ($borrowing->status === 'returned') {
            return back()->withErrors(['error' => 'This book has already been returned.']);
        }

        $borrowing->update([
            'returned_date' => Carbon::now(),
            'status' => 'returned'
        ]);

        // Update book availability
        $borrowing->book->increment('copies_available');

        return redirect()->route('borrowings.show', $borrowing)
                        ->with('success', 'Book returned successfully!');
    }

    // DELETE: Cancel borrowing (if not returned)
    public function destroy(Borrowing $borrowing): RedirectResponse
    {
        if ($borrowing->status !== 'returned') {
            // Return book to available copies
            $borrowing->book->increment('copies_available');
        }
        
        $borrowing->delete();
        return redirect()->route('borrowings.index')
                        ->with('success', 'Borrowing record deleted successfully!');
    }
}