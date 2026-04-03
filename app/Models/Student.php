<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function guardian()
{
    return $this->belongsTo(Guardian::class);
}
public function school()
{
    return $this->belongsTo(School::class);
}

public function level()
{
    return $this->belongsTo(Level::class);
    return $this->belongsTo(\App\Models\Level::class);
}

protected $fillable = [
    'full_name',
    'gender',
    'date_of_birth',
    'school_id',
    'level_id',
    'guardian_id',
    'index_number',
    'photo',
];


}
