<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Models\Course;
use App\Models\Camp;

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

// Schools
Route::get('/schools/create', [SchoolController::class, 'create'])->name('schools.create');
Route::post('/schools', [SchoolController::class, 'store'])->name('schools.store');

// Levels
Route::get('/levels/create', [LevelController::class, 'create'])->name('levels.create');
Route::post('/levels', [LevelController::class, 'store'])->name('levels.store');

// Guardians
Route::get('/guardians/create', [GuardianController::class, 'create'])->name('guardians.create');
Route::post('/guardians', [GuardianController::class, 'store'])->name('guardians.store');

// Enrolment
Route::get('/enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');

Route::get('/camp-students', [App\Http\Controllers\StudentController::class, 'campStudents']);

Route::get('/', function () {
    return redirect('/home');
});

// Program
Route::get('/get-programs/{type}', function ($type) {

    if ($type == 'camp') {
        return Camp::all();
    }

    if ($type == 'college') {
        return Course::where('type', 'college')->get();
    }

    if ($type == 'short_course') {
        return Course::where('type', 'short_course')->get();
    }

    return [];
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
