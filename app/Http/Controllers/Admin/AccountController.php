<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Display the accounts/revenue page.
     */
    public function index()
    {
        $teacher = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        // Get lesson statistics for current month
        $lessonsCompleted = Lesson::where('teacher_id', $teacher->id)
            ->where('status', 'completed')
            ->whereMonth('lesson_date', $currentMonth)
            ->whereYear('lesson_date', $currentYear)
            ->count();
        
        $lessonsCancelled = Lesson::where('teacher_id', $teacher->id)
            ->where('status', 'cancelled')
            ->whereMonth('lesson_date', $currentMonth)
            ->whereYear('lesson_date', $currentYear)
            ->count();
        
        $totalLessons = $lessonsCompleted + $lessonsCancelled;
        $completionRate = $totalLessons > 0 ? round(($lessonsCompleted / $totalLessons) * 100) : 0;
        
        // Calculate earnings (example: $30 per lesson)
        $pricePerLesson = 30;
        $totalEarnings = $lessonsCompleted * $pricePerLesson;
        $pendingPayment = $lessonsCancelled * $pricePerLesson * 0.5; // 50% refund
        
        // Cancellation breakdown
        $cancellations = Lesson::where('teacher_id', $teacher->id)
            ->where('status', 'cancelled')
            ->whereMonth('lesson_date', $currentMonth)
            ->whereYear('lesson_date', $currentYear)
            ->get();
        
        // Simple categorization (you can enhance this with additional fields in lessons table)
        $studentCancellations = ceil($lessonsCancelled * 0.65); // Example ratio
        $noShowStudents = ceil($lessonsCancelled * 0.22);
        $teacherCancellations = $lessonsCancelled - $studentCancellations - $noShowStudents;
        
        $stats = [
            'lessons_completed' => $lessonsCompleted,
            'lessons_cancelled' => $lessonsCancelled,
            'completion_rate' => $completionRate,
            'total_earnings' => $totalEarnings,
            'pending_payment' => $pendingPayment,
            'price_per_lesson' => $pricePerLesson,
            'student_cancellations' => $studentCancellations,
            'no_show_students' => $noShowStudents,
            'teacher_cancellations' => $teacherCancellations,
        ];
        
        return view('admin.pages.accounts', compact('stats'));
    }
}
