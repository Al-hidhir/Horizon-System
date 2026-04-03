<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;
use App\Models\Guardian;
use App\Models\Level;

class HomeController extends Controller
{
    public function index()
    {
        // COUNTS
        $totalStudents = Student::count();
        $totalSchools = School::count();
        $totalGuardians = Guardian::count();
        $totalLevels = Level::count();

        // LEVEL STATS
        $form2 = Student::whereHas('level', function($q){
            $q->where('name', 'Form 2');
        })->count();

        $form4 = Student::whereHas('level', function($q){
            $q->where('name', 'Form 4');
        })->count();

        $form6 = Student::whereHas('level', function($q){
            $q->where('name', 'Form 6');
        })->count();

        // RECENT STUDENTS
        $recentStudents = Student::with(['school','level','guardian'])
                            ->latest()
                            ->take(5)
                            ->get();

        return view('home', compact(
            'totalStudents',
            'totalSchools',
            'totalGuardians',
            'totalLevels',
            'form2',
            'form4',
            'form6',
            'recentStudents'
        ));
    }
}