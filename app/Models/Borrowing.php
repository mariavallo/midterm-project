<?php
// app/Models/Borrowing.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    protected $fillable = [
        'student_id', 'book_id', 'borrowed_date', 
        'due_date', 'returned_date', 'status', 'fine_amount'
    ];

    protected $casts = [
        'borrowed_date' => 'date',
        'due_date' => 'date',
        'returned_date' => 'date',
        'fine_amount' => 'decimal:2'
    ];

    // Relationship: Borrowing belongs to a student
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship: Borrowing belongs to a book
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    // Check if borrowing is overdue
    public function isOverdue(): bool
    {
        return $this->status !== 'returned' && $this->due_date < now();
    }
}