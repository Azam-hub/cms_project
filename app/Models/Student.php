<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ["gr_no", "course_id", "discount", "annual_fees", "total_modules", "completed_modules", "status", "room", 
    "seat", "timing", "shift", "user_id", "exclude", "created_at", "updated_at"];

    function user() {
        return $this->hasOne(User::class, "id", "user_id");
    }

    function room_row() {
        return $this->hasOne(Room::class, "id", "room");
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    function attendance() {
        return $this->hasOne(Attendance::class, 'student_id', 'id');
    }

    function fees() {
        return $this->hasMany(Fee::class, "student_id", "id");
    }

}
