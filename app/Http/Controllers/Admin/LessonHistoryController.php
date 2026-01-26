<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonHistoryController extends Controller
{
    /**
     * Display the lesson history page.
     */
    public function index()
    {
        $teacher = Auth::user();
        
        // Get lessons from the last 30 days by default
        $lessons = Lesson::where('teacher_id', $teacher->id)
            ->where('status', '!=', 'scheduled')
            ->orderBy('lesson_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();
        
        return view('admin.pages.history', compact('lessons'));
    }
}
