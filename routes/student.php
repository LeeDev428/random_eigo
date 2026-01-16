<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\LessonController;
use App\Http\Controllers\Student\MaterialController;
use App\Http\Controllers\Student\ProfileController;

// Student routes - Protected by auth middleware and student role
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Book a Lesson
    Route::get('/lessons/book', [LessonController::class, 'book'])->name('lessons.book');
    Route::post('/lessons/book', [LessonController::class, 'store'])->name('lessons.store');
    
    // Lesson History
    Route::get('/lessons/history', [LessonController::class, 'history'])->name('lessons.history');
    
    // Courses & Payment
    Route::get('/courses', [LessonController::class, 'courses'])->name('courses');
    
    // Materials
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials');
    Route::get('/materials/download/{id}', [MaterialController::class, 'download'])->name('materials.download');
    
    // Certificates
    Route::get('/certificates', [ProfileController::class, 'certificates'])->name('certificates');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Contact Us
    Route::get('/contact', function () {
        return view('student.pages.contact');
    })->name('contact');
});
