<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display all lessons across all teachers.
     */
    public function index(Request $request)
    {
        $status = $request->input('status', 'all');
        $search = $request->input('search', '');

        $query = Lesson::with(['teacher', 'student']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('lesson_type', 'like', "%{$search}%")
                  ->orWhereHas('teacher', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $lessons = $query->orderBy('lesson_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        // Stats
        $totalLessons = Lesson::count();
        $completedLessons = Lesson::where('status', 'completed')->count();
        $scheduledLessons = Lesson::where('status', 'scheduled')->count();
        $cancelledLessons = Lesson::where('status', 'cancelled')->count();

        return view('superadmin.pages.lessons', compact(
            'lessons', 'status', 'search',
            'totalLessons', 'completedLessons', 'scheduledLessons', 'cancelledLessons'
        ));
    }
}
