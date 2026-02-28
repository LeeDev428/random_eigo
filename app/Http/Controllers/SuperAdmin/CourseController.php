<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display all courses and enrollments.
     */
    public function index()
    {
        $courses = Course::withCount('enrollments')->get();

        $enrollments = CourseEnrollment::with(['student', 'course'])
            ->orderBy('enrolled_date', 'desc')
            ->get();

        $totalCourses = Course::count();
        $activeCourses = Course::where('is_active', true)->count();
        $totalEnrollments = CourseEnrollment::count();
        $activeEnrollments = CourseEnrollment::where('status', 'active')->count();

        return view('superadmin.pages.courses', compact(
            'courses', 'enrollments',
            'totalCourses', 'activeCourses', 'totalEnrollments', 'activeEnrollments'
        ));
    }
}
