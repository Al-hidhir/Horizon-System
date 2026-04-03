<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
    'student_id',
    'type',
    'reference_id',
    'start_date',
    'end_date'
];
public function student()
{
    return $this->belongsTo(\App\Models\Student::class);
}
}
