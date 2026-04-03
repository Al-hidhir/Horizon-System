<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;
use App\Models\Level;
use App\Models\Guardian;
use App\Models\Enrollment;

class StudentController extends Controller
{
    // Show all students
    public function index()
    {
        $students = Student::with(['school', 'level', 'guardian'])->get();
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        $schools = School::all();
        $levels = Level::all();
        $guardians = Guardian::all();

        return view('students.create', compact('schools', 'levels', 'guardians'));
    }

    // Store student in database
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'school_id' => 'required|exists:schools,id',
            'level_id' => 'required|exists:levels,id',
            'guardian_id' => 'required|exists:guardians,id',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function campStudents()
{
    // get only camp enrollments
    $enrollments = Enrollment::with(['student', 'student.level'])
        ->where('type', 'camp')
        ->get();

    // statistics
    $totalCampStudents = $enrollments->count();

    $byLevel = $enrollments->groupBy(function ($item) {
        return $item->student->level->name ?? 'Unknown';
    });

    return view('students.camp', compact(
        'enrollments',
        'totalCampStudents',
        'byLevel'
    ));
}
}
