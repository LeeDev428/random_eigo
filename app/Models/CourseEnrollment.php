<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'enrolled_date',
        'credits_purchased',
        'credits_used',
        'status',
    ];

    protected $casts = [
        'enrolled_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getCreditsRemainingAttribute()
    {
        return $this->credits_purchased - $this->credits_used;
    }
}
