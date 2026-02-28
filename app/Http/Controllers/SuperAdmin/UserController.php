<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lesson;
use App\Models\TeacherProfile;
use App\Models\StudentStats;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display all users (teachers and students).
     */
    public function index(Request $request)
    {
        $role = $request->input('role', 'all');
        $search = $request->input('search', '');

        $query = User::where('role', '!=', 'superadmin');

        if ($role !== 'all') {
            $query->where('role', $role);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('superadmin.pages.users', compact('users', 'role', 'search'));
    }

    /**
     * Display a specific user's details.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $data = ['user' => $user];

        if ($user->role === 'admin') {
            // Teacher details
            $data['profile'] = $user->teacherProfile;
            $data['lessons'] = Lesson::where('teacher_id', $user->id)
                ->orderBy('lesson_date', 'desc')
                ->limit(20)
                ->get();
            $data['totalLessons'] = Lesson::where('teacher_id', $user->id)->count();
            $data['completedLessons'] = Lesson::where('teacher_id', $user->id)->where('status', 'completed')->count();
        } else {
            // Student details
            $data['stats'] = $user->studentStats;
            $data['lessons'] = Lesson::where('student_id', $user->id)
                ->orderBy('lesson_date', 'desc')
                ->limit(20)
                ->get();
            $data['totalLessons'] = Lesson::where('student_id', $user->id)->count();
            $data['completedLessons'] = Lesson::where('student_id', $user->id)->where('status', 'completed')->count();
            $data['enrollments'] = $user->enrollments()->with('course')->get();
            $data['payments'] = $user->payments()->orderBy('payment_date', 'desc')->limit(10)->get();
            $data['certificates'] = $user->certificates;
        }

        return view('superadmin.pages.user-detail', $data);
    }
}
