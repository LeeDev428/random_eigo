<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        return view('student.pages.contact', compact('student'));
    }
    
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        
        // Here you would implement email sending logic
        // For now, just redirect back with success
        
        return redirect()->route('student.contact')->with('success', 'Message sent successfully! We will get back to you soon.');
    }
}
