<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Mock data - replace with actual database queries
        $stats = [
            'lessons_completed' => 24,
            'credits_remaining' => 8,
            'certificates_earned' => 3,
            'current_level' => 'B1+',
            'next_level' => 'B2',
            'course_progress' => 75,
        ];
        
        $upcomingLessons = [
            [
                'id' => 1,
                'teacher_name' => 'James Miller',
                'teacher_initials' => 'JM',
                'title' => 'Business English Conversation',
                'date' => 'Tomorrow',
                'time' => '10:00 AM',
                'color' => 'blue'
            ],
            [
                'id' => 2,
                'teacher_name' => 'Emma Wilson',
                'teacher_initials' => 'EW',
                'title' => 'Grammar Workshop',
                'date' => 'Jan 15',
                'time' => '2:00 PM',
                'color' => 'green'
            ],
        ];
        
        return view('student.pages.dashboard', compact('user', 'stats', 'upcomingLessons'));
    }
}
