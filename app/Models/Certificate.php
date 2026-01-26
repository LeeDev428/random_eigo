<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'certificate_name',
        'level',
        'completed_date',
        'certificate_type',
    ];

    protected $casts = [
        'completed_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
