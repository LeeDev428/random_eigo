<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display all materials uploaded by all teachers.
     */
    public function index(Request $request)
    {
        $category = $request->input('category', 'all');

        $query = Material::with('teacher');

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $materials = $query->orderBy('created_at', 'desc')->get();

        $categories = ['Business English', 'IELTS Prep', 'Kids Lessons', 'Conversational'];
        $totalMaterials = Material::count();

        return view('superadmin.pages.materials', compact('materials', 'categories', 'category', 'totalMaterials'));
    }
}
