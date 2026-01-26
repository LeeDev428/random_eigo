<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Certificate;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $student = Auth::user();
        
        // Get student stats
        $stats = $student->studentStats ?? (object)[
            'days_learning' => 0,
            'hours_studied' => 0,
            'attendance_rate' => 0,
            'weekly_goal_current' => 0,
            'weekly_goal_total' => 4,
        ];
        
        // Calculate lessons completed
        $lessonsCompleted = Lesson::where('student_id', $student->id)
            ->where('status', 'completed')
            ->count();
        
        // Get total credits remaining
        $enrollment = CourseEnrollment::where('student_id', $student->id)
            ->where('status', 'active')
            ->first();
        
        $creditsRemaining = $enrollment ? $enrollment->credits_remaining : 0;
        
        // Get certificates count
        $certificatesEarned = Certificate::where('student_id', $student->id)->count();
        
        // Get current level (from most recent certificate or default)
        $latestCertificate = Certificate::where('student_id', $student->id)
            ->latest('completed_date')
            ->first();
        
        $currentLevel = $latestCertificate ? $latestCertificate->level : 'B1+';
        
        // Get upcoming lessons
        $upcomingLessons = Lesson::where('student_id', $student->id)
            ->where('status', 'scheduled')
            ->where('lesson_date', '>=', Carbon::today())
            ->orderBy('lesson_date')
            ->orderBy('start_time')
            ->limit(5)
            ->get();
        
        $dashboardStats = [
            'lessons_completed' => $lessonsCompleted,
            'credits_remaining' => $creditsRemaining,
            'certificates_earned' => $certificatesEarned,
            'current_level' => $currentLevel,
        ];
        
        return view('student.pages.dashboard', compact('student', 'stats', 'dashboardStats', 'upcomingLessons'));
    }
}
