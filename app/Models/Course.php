<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // public function user() {
    //     return $this->hasMany(User::class, 'course', "id");
    // }

    protected $fillable = ['name', 'questions_to_ask', 'is_deleted'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function modules() {
        return $this->hasMany(Module::class);
    }

    public function questions() {
        return $this->hasMany(Question::class, 'course_id', "id");
    }
}
