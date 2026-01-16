<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display the materials page.
     */
    public function index()
    {
        return view('student.pages.materials');
    }

    /**
     * Download a specific material.
     */
    public function download($id)
    {
        // TODO: Implement material download logic
        return redirect()->route('student.materials');
    }
}
