<?php
// app/Http/Controllers/StudentController.php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    // READ: Display all students
    public function index(): View
    {
        $students = Student::with('borrowings.book')->paginate(10);
        return view('students.index', compact('students'));
    }

    // READ: Show single student
    public function show(Student $student): View
    {
        $student->load(['borrowings.book']);
        return view('students.show', compact('student'));
    }

    // CREATE: Show create form
    public function create(): View
    {
        return view('students.create');
    }

    // CREATE: Store new student
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:15',
            'course' => 'required|string|max:100',
            'year_level' => 'required|integer|min:1|max:4'
        ]);

        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    // UPDATE: Show edit form
    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    // UPDATE: Update student
    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:15',
            'course' => 'required|string|max:100',
            'year_level' => 'required|integer|min:1|max:4'
        ]);

        $student->update($validated);
        return redirect()->route('students.show', $student)->with('success', 'Student updated successfully!');
    }

    // DELETE: Delete student
    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}