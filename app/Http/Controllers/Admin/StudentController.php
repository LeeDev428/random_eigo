<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display the students list.
     */
    public function index()
    {
        return view('admin.pages.students');
    }

    /**
     * Display a specific student.
     */
    public function show($id)
    {
        // TODO: Implement student details view
        return view('admin.pages.student-details', compact('id'));
    }

    /**
     * Update student information.
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement student update logic
        return redirect()->route('admin.students');
    }
}
