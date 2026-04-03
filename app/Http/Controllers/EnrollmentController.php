<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Camp;
use App\Models\Course;

class EnrollmentController extends Controller
{
   public function create()
{
    $students = Student::all();
    $camps = Camp::all();
    $levels = \App\Models\Level::all();

    $collegeCourses = Course::where('type', 'college')->get();
    $shortCourses = Course::where('type', 'short_course')->get();

    return view('enrollments.create', compact(
        'students',
        'camps',
        'levels',
        'collegeCourses',
        'shortCourses'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'type' => 'required',
            'reference_id' => 'required',
        ]);

        Enrollment::create($request->all());

        return redirect()->back()->with('success', 'Student enrolled successfully!');
    }
}