<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $student = Auth::user();
        
        $stats = $student->studentStats ?? StudentStats::create([
            'student_id' => $student->id,
            'days_learning' => 0,
            'hours_studied' => 0,
            'attendance_rate' => 0,
            'weekly_goal_current' => 0,
            'weekly_goal_total' => 4,
        ]);
        
        return view('student.pages.profile', compact('student', 'stats'));
    }

    public function update(Request $request)
    {
        $student = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'password' => 'nullable|min:8|confirmed',
        ]);
        
        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        
        if (!empty($validated['password'])) {
            $student->update(['password' => Hash::make($validated['password'])]);
        }
        
        return redirect()->route('student.profile')->with('success', 'Profile updated successfully!');
    }
}
