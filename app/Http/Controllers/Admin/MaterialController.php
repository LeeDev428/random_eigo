<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display the lesson materials page.
     */
    public function index(Request $request)
    {
        $teacher = Auth::user();
        $category = $request->input('category', 'all');
        
        $query = Material::where('teacher_id', $teacher->id);
        
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        
        $materials = $query->latest()->get();
        
        $categories = ['Business English', 'IELTS Prep', 'Kids Lessons', 'Conversational'];
        
        return view('admin.pages.materials', compact('materials', 'categories', 'category'));
    }

    /**
     * Store a new material.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,mp3,mp4,zip', // Max 10MB
        ]);
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materials', $fileName, 'public');
            
            Material::create([
                'teacher_id' => Auth::id(),
                'title' => $validated['title'],
                'category' => $validated['category'],
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'file_size' => $file->getSize(),
            ]);
        }
        
        return redirect()->route('admin.materials')->with('success', 'Material uploaded successfully');
    }

    /**
     * Delete a material.
     */
    public function destroy($id)
    {
        $material = Material::where('id', $id)->where('teacher_id', Auth::id())->firstOrFail();
        
        // Delete file from storage
        Storage::disk('public')->delete($material->file_path);
        
        // Delete database record
        $material->delete();
        
        return redirect()->route('admin.materials')->with('success', 'Material deleted successfully');
    }
}
