<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'locale',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the teacher profile.
     */
    public function teacherProfile()
    {
        return $this->hasOne(TeacherProfile::class);
    }

    /**
     * Get lessons as teacher.
     */
    public function teachingLessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id');
    }

    /**
     * Get lessons as student.
     */
    public function studentLessons()
    {
        return $this->hasMany(Lesson::class, 'student_id');
    }

    /**
     * Get materials uploaded by teacher.
     */
    public function materials()
    {
        return $this->hasMany(Material::class, 'teacher_id');
    }

    /**
     * Get student stats.
     */
    public function studentStats()
    {
        return $this->hasOne(StudentStats::class, 'student_id');
    }

    /**
     * Get student certificates.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }

    /**
     * Get student enrollments.
     */
    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class, 'student_id');
    }

    /**
     * Get student payments.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    /**
     * Get lesson ratings by student.
     */
    public function lessonRatings()
    {
        return $this->hasMany(LessonRating::class, 'student_id');
    }
}
