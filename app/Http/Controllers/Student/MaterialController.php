<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        // Get all materials (students can access all teacher-uploaded materials)
        $materials = Material::latest()->get();
        
        return view('student.pages.materials', compact('materials'));
    }

    public function download($id)
    {
        $material = Material::findOrFail($id);
        
        return Storage::disk('public')->download($material->file_path, $material->file_name);
    }
}
