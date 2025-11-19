<?php
// app/Models/Student.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    protected $fillable = [
        'student_id', 'first_name', 'last_name', 
        'email', 'phone', 'course', 'year_level'
    ];

    // Relationship: Student has many borrowings
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    // Many-to-many relationship with books through borrowings
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'borrowings')
                    ->withPivot('borrowed_date', 'due_date', 'returned_date', 'status', 'fine_amount')
                    ->withTimestamps();
    }

    // Accessor for full name
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}