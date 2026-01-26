<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the admin profile page.
     */
    public function show()
    {
        $teacher = Auth::user();
        $profile = $teacher->teacherProfile ?? new TeacherProfile();
        
        return view('admin.pages.profile', compact('teacher', 'profile'));
    }

    /**
     * Update admin profile.
     */
    public function update(Request $request)
    {
        $teacher = Auth::user();
        
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
            'phone_number' => 'nullable|string|max:20',
            'teaching_subject' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'skills' => 'nullable|array',
            'password' => 'nullable|min:8|confirmed',
        ]);
        
        // Update user
        $teacher->update([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
        ]);
        
        if (!empty($validated['password'])) {
            $teacher->update(['password' => Hash::make($validated['password'])]);
        }
        
        // Update or create teacher profile
        $teacher->teacherProfile()->updateOrCreate(
            ['user_id' => $teacher->id],
            [
                'full_name' => $validated['full_name'],
                'phone_number' => $validated['phone_number'] ?? null,
                'teaching_subject' => $validated['teaching_subject'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'skills' => $validated['skills'] ?? [],
            ]
        );
        
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
    }
}
