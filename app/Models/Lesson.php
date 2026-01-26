<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'student_id',
        'student_name',
        'lesson_type',
        'level',
        'lesson_date',
        'start_time',
        'end_time',
        'status',
        'request_notes',
        'teacher_notes',
    ];

    protected $casts = [
        'lesson_date' => 'date',
    ];

    /**
     * Get the teacher for the lesson.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get the student for the lesson.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the lesson rating.
     */
    public function lessonRating()
    {
        return $this->hasOne(LessonRating::class);
    }
}
