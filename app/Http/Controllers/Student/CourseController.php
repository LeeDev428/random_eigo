<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CourseController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        
        // Get all available courses
        $courses = Course::where('is_active', true)->get();
        
        // Get student's payment history
        $payments = Payment::where('student_id', $student->id)
            ->orderBy('payment_date', 'desc')
            ->limit(10)
            ->get();
        
        // Get active enrollment
        $activeEnrollment = CourseEnrollment::where('student_id', $student->id)
            ->where('status', 'active')
            ->first();
        
        return view('student.pages.courses', compact('courses', 'payments', 'activeEnrollment'));
    }
    
    public function enroll(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);
        
        $student = Auth::user();
        $course = Course::findOrFail($validated['course_id']);
        
        // Create enrollment
        CourseEnrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'enrolled_date' => Carbon::now(),
            'credits_purchased' => 10, // Default credits
            'credits_used' => 0,
            'status' => 'active',
        ]);
        
        return redirect()->route('student.courses')->with('success', 'Enrolled successfully!');
    }
    
    public function payment(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'nullable|exists:courses,id',
            'amount' => 'required|integer',
            'payment_method' => 'required|string',
            'description' => 'required|string',
        ]);
        
        $student = Auth::user();
        
        Payment::create([
            'student_id' => $student->id,
            'course_id' => $validated['course_id'] ?? null,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'description' => $validated['description'],
            'status' => 'paid',
            'payment_date' => Carbon::now(),
        ]);
        
        return redirect()->route('student.courses')->with('success', 'Payment recorded successfully!');
    }
}
