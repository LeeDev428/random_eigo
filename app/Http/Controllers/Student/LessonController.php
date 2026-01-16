<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display the book lesson page.
     */
    public function book()
    {
        return view('student.pages.book-lesson');
    }

    /**
     * Store a new lesson booking.
     */
    public function store(Request $request)
    {
        // TODO: Implement lesson booking logic
        return redirect()->route('student.lessons.history');
    }

    /**
     * Display lesson history.
     */
    public function history()
    {
        return view('student.pages.lesson-history');
    }

    /**
     * Display courses and payment page.
     */
    public function courses()
    {
        return view('student.pages.courses');
    }
}
