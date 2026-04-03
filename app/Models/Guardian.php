<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    public function students()
{
    return $this->hasMany(Student::class);
}
protected $fillable = ['full_name', 'phone', 'email', 'address'];
}
