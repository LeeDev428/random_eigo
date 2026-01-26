<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $teacher = Auth::user();
        $today = Carbon::today();
        
        // Calculate stats
        $stats = [
            'lessons_conducted' => Lesson::where('teacher_id', $teacher->id)
                ->where('status', 'completed')
                ->whereMonth('lesson_date', Carbon::now()->month)
                ->count(),
            'total_students' => User::where('role', 'student')->count(),
            'assignments_to_grade' => 12, // Placeholder for future implementation
            'student_rating' => 4.8, // Placeholder for future implementation
        ];
        
        // Get today's schedule
        $todaySchedule = Lesson::where('teacher_id', $teacher->id)
            ->whereDate('lesson_date', $today)
            ->where('status', 'scheduled')
            ->orderBy('start_time')
            ->get();
        
        // Get upcoming lessons (next 3 days)
        $upcomingLessons = Lesson::where('teacher_id', $teacher->id)
            ->whereDate('lesson_date', '>', $today)
            ->whereDate('lesson_date', '<=', $today->copy()->addDays(3))
            ->where('status', 'scheduled')
            ->orderBy('lesson_date')
            ->orderBy('start_time')
            ->get();
        
        return view('admin.pages.dashboard', compact('teacher', 'stats', 'todaySchedule', 'upcomingLessons'));
    }
}
