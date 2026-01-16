<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display the lesson materials page.
     */
    public function index()
    {
        return view('admin.pages.materials');
    }

    /**
     * Store a new material.
     */
    public function store(Request $request)
    {
        // TODO: Implement material upload logic
        return redirect()->route('admin.materials');
    }

    /**
     * Delete a material.
     */
    public function destroy($id)
    {
        // TODO: Implement material deletion logic
        return redirect()->route('admin.materials');
    }
}
