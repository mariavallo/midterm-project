<?php
// app/Http/Controllers/BookController.php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    // READ: Display all books
    public function index(): View
    {
        $books = Book::with('borrowings.student')->paginate(10);
        return view('books.index', compact('books'));
    }

    // READ: Show single book
    public function show(Book $book): View
    {
        $book->load(['borrowings.student']);
        return view('books.show', compact('book'));
    }

    // CREATE: Show create form
    public function create(): View
    {
        return view('books.create');
    }

    // CREATE: Store new book
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'isbn' => 'required|unique:books,isbn',
            'title' => 'required|string|max:200',
            'author' => 'required|string|max:150',
            'publisher' => 'nullable|string|max:100',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'category' => 'required|string|max:50',
            'total_copies' => 'required|integer|min:1',
            'copies_available' => 'required|integer|min:0'
        ]);

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    // UPDATE: Show edit form
    public function edit(Book $book): View
    {
        return view('books.edit', compact('book'));
    }

    // UPDATE: Update book
    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'title' => 'required|string|max:200',
            'author' => 'required|string|max:150',
            'publisher' => 'nullable|string|max:100',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'category' => 'required|string|max:50',
            'total_copies' => 'required|integer|min:1',
            'copies_available' => 'required|integer|min:0'
        ]);

        $book->update($validated);
        return redirect()->route('books.show', $book)->with('success', 'Book updated successfully!');
    }

    // DELETE: Delete book
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}