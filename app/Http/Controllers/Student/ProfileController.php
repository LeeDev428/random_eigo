<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the student profile page.
     */
    public function show()
    {
        return view('student.pages.profile');
    }

    /**
     * Update student profile.
     */
    public function update(Request $request)
    {
        // TODO: Implement profile update logic
        return redirect()->route('student.profile');
    }

    /**
     * Display certificates page.
     */
    public function certificates()
    {
        return view('student.pages.certificates');
    }
}
