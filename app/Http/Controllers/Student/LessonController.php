<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonRating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LessonController extends Controller
{
    public function book()
    {
        $student = Auth::user();
        
        // Get all teachers (users with role admin)
        $teachers = User::where('role', 'admin')->get();
        
        return view('student.pages.book-lesson', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'lesson_type' => 'required|string',
            'lesson_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'request_notes' => 'nullable|string',
        ]);
        
        $student = Auth::user();
        
        Lesson::create([
            'teacher_id' => $validated['teacher_id'],
            'student_id' => $student->id,
            'student_name' => $student->name,
            'lesson_type' => $validated['lesson_type'],
            'level' => 'Intermediate', // Default
            'lesson_date' => $validated['lesson_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'status' => 'scheduled',
            'request_notes' => $validated['request_notes'] ?? null,
        ]);
        
        return redirect()->route('student.dashboard')->with('success', 'Lesson booked successfully!');
    }

    public function history()
    {
        $student = Auth::user();
        
        $lessons = Lesson::where('student_id', $student->id)
            ->where('status', '!=', 'scheduled')
            ->with(['teacher', 'lessonRating'])
            ->orderBy('lesson_date', 'desc')
            ->get();
        
        // Calculate stats
        $completedLessons = $lessons->where('status', 'completed')->count();
        $totalHours = round($completedLessons * 0.83); // Assuming 50 min lessons
        $averageRating = $lessons->filter(function($lesson) {
            return $lesson->lessonRating !== null;
        })->avg(function($lesson) {
            return $lesson->lessonRating->rating;
        }) ?? 0;
        $averageRating = round($averageRating, 1);
        
        return view('student.pages.lesson-history', compact('lessons', 'completedLessons', 'totalHours', 'averageRating'));
    }
    
    public function rate(Request $request, $id)
    {
        $validated = $request->validate([
            'rating' => 'required|string',
            'comment' => 'nullable|string',
        ]);
        
        $student = Auth::user();
        $lesson = Lesson::findOrFail($id);
        
        LessonRating::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'student_id' => $student->id,
            ],
            [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
            ]
        );
        
        return redirect()->route('student.lessons.history')->with('success', 'Rating submitted!');
    }
}
