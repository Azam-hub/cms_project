<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ["gr_no", "name", "father_name", "course", "cnic_bform_no", "date_of_birth", 
    "email", "password", "mobile_no", "profile_pic", "address", "assessment_status", "role", "token", "is_deleted"];

    // public function course() {
    //     return $this->hasOne(Course::class, 'id', 'course');
    // }
    // public function course()
    // {
    //     return $this->belongsTo(Course::class, 'course_id', 'id');
    // }

    function studentData () {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }
}
