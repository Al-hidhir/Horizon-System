<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\School;
use App\Models\Camp;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalGuardians = Guardian::count();
        $totalSchools = School::count();
        $totalCamps = Camp::count();
        $recentStudents = Student::with(['school', 'level'])
                                 ->latest()
                                 ->take(5)
                                 ->get();
        
        return view('dashboard', compact(
            'totalStudents',
            'totalGuardians',
            'totalSchools',
            'totalCamps',
            'recentStudents'
        ));
    }
}