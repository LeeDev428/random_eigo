<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'days_learning',
        'hours_studied',
        'attendance_rate',
        'weekly_goal_current',
        'weekly_goal_total',
    ];

    protected $casts = [
        'attendance_rate' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
