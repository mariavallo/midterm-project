<?php
// app/Models/Book.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $fillable = [
        'isbn', 'title', 'author', 'publisher', 
        'publication_year', 'category', 'copies_available', 'total_copies'
    ];

    // Relationship: Book has many borrowings
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    // Many-to-many relationship with students through borrowings
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'borrowings')
                    ->withPivot('borrowed_date', 'due_date', 'returned_date', 'status', 'fine_amount')
                    ->withTimestamps();
    }

    // Check if book is available
    public function isAvailable(): bool
    {
        return $this->copies_available > 0;
    }
}