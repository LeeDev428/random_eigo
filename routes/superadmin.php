<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\LessonController;
use App\Http\Controllers\SuperAdmin\CourseController;
use App\Http\Controllers\SuperAdmin\PaymentController;
use App\Http\Controllers\SuperAdmin\MaterialController;

// Super Admin routes - Protected by auth middleware and superadmin role
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Users Management (view all teachers & students)
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    
    // All Lessons
    Route::get('/lessons', [LessonController::class, 'index'])->name('lessons');
    
    // All Courses & Enrollments
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    
    // All Payments / Revenue
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    
    // All Materials
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials');
});
