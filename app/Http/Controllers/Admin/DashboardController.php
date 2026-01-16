<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Mock data - replace with actual database queries
        $stats = [
            'lessons_conducted' => 156,
            'total_students' => 48,
            'assignments_to_grade' => 12,
            'student_rating' => 4.8,
        ];
        
        $todaySchedule = [
            [
                'id' => 1,
                'title' => 'Business English - Advanced',
                'description' => 'Presentations & Negotiations',
                'time' => '8:00 - 9:30 AM',
                'badge' => 'Online',
                'color' => 'green'
            ],
            [
                'id' => 2,
                'title' => 'IELTS Preparation',
                'description' => 'Speaking Practice Session',
                'time' => '10:00 - 11:30 AM',
                'badge' => 'Online',
                'color' => 'blue'
            ],
            [
                'id' => 3,
                'title' => 'Grammar Workshop',
                'description' => 'Advanced Tenses Review',
                'time' => '2:00 - 3:30 PM',
                'badge' => 'Online',
                'color' => 'green'
            ],
        ];
        
        $announcements = [
            [
                'id' => 1,
                'title' => 'Staff Meeting',
                'meta' => 'Friday, 3:00 PM - Conference Room A',
                'description' => 'Monthly review and planning session',
                'color' => 'blue'
            ],
            [
                'id' => 2,
                'title' => 'Grade Submission Deadline',
                'meta' => 'Submit Q2 grades by Dec 15',
                'description' => 'Please complete all pending evaluations',
                'color' => 'orange'
            ],
            [
                'id' => 3,
                'title' => 'New Course Materials',
                'meta' => 'Updated resources available',
                'description' => 'Business English module has been updated',
                'color' => 'blue'
            ],
        ];
        
        return view('admin.pages.dashboard', compact('user', 'stats', 'todaySchedule', 'announcements'));
    }
}
