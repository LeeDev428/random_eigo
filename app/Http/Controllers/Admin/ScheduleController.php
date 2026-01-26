<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display the schedule management page.
     */
    public function index(Request $request)
    {
        $teacher = Auth::user();
        
        // Get the week to display (default to current week)
        $weekStart = $request->input('week_start') 
            ? Carbon::parse($request->input('week_start')) 
            : Carbon::now()->startOfWeek();
        
        $weekEnd = $weekStart->copy()->endOfWeek();
        
        // Get lessons for the week
        $lessons = Lesson::where('teacher_id', $teacher->id)
            ->whereBetween('lesson_date', [$weekStart, $weekEnd])
            ->where('status', 'scheduled')
            ->orderBy('lesson_date')
            ->orderBy('start_time')
            ->get();
        
        // Group lessons by day
        $weeklySchedule = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $weekStart->copy()->addDays($i);
            $weeklySchedule[$date->format('Y-m-d')] = [
                'date' => $date,
                'lessons' => $lessons->filter(function ($lesson) use ($date) {
                    return $lesson->lesson_date->isSameDay($date);
                })
            ];
        }
        
        return view('admin.pages.schedule', compact('weeklySchedule', 'weekStart', 'weekEnd'));
    }

    /**
     * Store a new schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'student_name' => 'required|string',
            'lesson_type' => 'required|string',
            'level' => 'required|string',
            'lesson_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'request_notes' => 'nullable|string',
        ]);
        
        $validated['teacher_id'] = Auth::id();
        $validated['status'] = 'scheduled';
        
        Lesson::create($validated);
        
        return redirect()->route('admin.schedule')->with('success', 'Lesson scheduled successfully');
    }

    /**
     * Update an existing schedule.
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        
        $validated = $request->validate([
            'lesson_date' => 'sometimes|date',
            'start_time' => 'sometimes',
            'end_time' => 'sometimes',
            'status' => 'sometimes|in:scheduled,completed,cancelled',
            'teacher_notes' => 'nullable|string',
        ]);
        
        $lesson->update($validated);
        
        return redirect()->route('admin.schedule')->with('success', 'Lesson updated successfully');
    }

    /**
     * Delete a schedule.
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        
        return redirect()->route('admin.schedule')->with('success', 'Lesson deleted successfully');
    }
}
