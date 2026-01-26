<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        
        $certificates = Certificate::where('student_id', $student->id)
            ->orderBy('completed_date', 'desc')
            ->get();
        
        return view('student.pages.certificates', compact('certificates'));
    }
    
    public function request(Request $request)
    {
        $validated = $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
        ]);
        
        // Here you would implement certificate request logic
        // For now, just redirect back
        
        return redirect()->route('student.certificates')->with('success', 'Certificate requested successfully!');
    }
}
