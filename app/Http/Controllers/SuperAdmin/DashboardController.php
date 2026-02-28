<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Material;
use App\Models\CourseEnrollment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the super admin dashboard.
     */
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Platform-wide stats
        $stats = [
            'total_teachers' => User::where('role', 'admin')->count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_lessons' => Lesson::count(),
            'lessons_this_month' => Lesson::whereMonth('lesson_date', $currentMonth)
                ->whereYear('lesson_date', $currentYear)
                ->count(),
            'completed_lessons' => Lesson::where('status', 'completed')->count(),
            'scheduled_lessons' => Lesson::where('status', 'scheduled')->count(),
            'cancelled_lessons' => Lesson::where('status', 'cancelled')->count(),
            'total_courses' => Course::where('is_active', true)->count(),
            'active_enrollments' => CourseEnrollment::where('status', 'active')->count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'revenue_this_month' => Payment::where('status', 'paid')
                ->whereMonth('payment_date', $currentMonth)
                ->whereYear('payment_date', $currentYear)
                ->sum('amount'),
            'total_materials' => Material::count(),
        ];

        // Recent lessons (last 10)
        $recentLessons = Lesson::with(['teacher', 'student'])
            ->orderBy('lesson_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->limit(10)
            ->get();

        // Recent payments (last 10)
        $recentPayments = Payment::with(['student', 'course'])
            ->orderBy('payment_date', 'desc')
            ->limit(10)
            ->get();

        // New users (last 10)
        $recentUsers = User::where('role', '!=', 'superadmin')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('superadmin.pages.dashboard', compact('stats', 'recentLessons', 'recentPayments', 'recentUsers'));
    }
}
