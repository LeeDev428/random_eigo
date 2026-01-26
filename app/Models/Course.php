<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_type',
        'price',
        'description',
        'features',
        'duration',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
