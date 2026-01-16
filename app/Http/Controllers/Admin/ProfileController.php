<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the admin profile page.
     */
    public function show()
    {
        return view('admin.pages.profile');
    }

    /**
     * Update admin profile.
     */
    public function update(Request $request)
    {
        // TODO: Implement profile update logic
        return redirect()->route('admin.profile');
    }
}
