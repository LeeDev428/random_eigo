<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display the students list (students who have lessons with this teacher).
     */
    public function index()
    {
        $teacher = Auth::user();

        $studentIds = Lesson::where('teacher_id', $teacher->id)
            ->pluck('student_id')
            ->unique();

        $students = User::whereIn('id', $studentIds)
            ->where('role', 'student')
            ->get()
            ->map(function ($student) use ($teacher) {
                $student->total_lessons = Lesson::where('teacher_id', $teacher->id)
                    ->where('student_id', $student->id)->count();
                $student->completed_lessons = Lesson::where('teacher_id', $teacher->id)
                    ->where('student_id', $student->id)->where('status', 'completed')->count();
                $student->last_lesson = Lesson::where('teacher_id', $teacher->id)
                    ->where('student_id', $student->id)->latest('lesson_date')->first();
                return $student;
            });

        return view('admin.pages.students', compact('students'));
    }

    /**
     * Display a specific student.
     */
    public function show($id)
    {
        $teacher = Auth::user();
        $student = User::findOrFail($id);

        $lessons = Lesson::where('teacher_id', $teacher->id)
            ->where('student_id', $student->id)
            ->orderBy('lesson_date', 'desc')
            ->get();

        return view('admin.pages.student-details', compact('student', 'lessons'));
    }

    /**
     * Update student information.
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.students');
    }
}
