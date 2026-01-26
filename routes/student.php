<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\LessonController;
use App\Http\Controllers\Student\MaterialController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\CertificateController;
use App\Http\Controllers\Student\ContactController;

// Student routes - Protected by auth middleware and student role
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Book a Lesson
    Route::get('/lessons/book', [LessonController::class, 'book'])->name('lessons.book');
    Route::post('/lessons/book', [LessonController::class, 'store'])->name('lessons.store');
    
    // Lesson History
    Route::get('/lessons/history', [LessonController::class, 'history'])->name('lessons.history');
    Route::post('/lessons/{id}/rate', [LessonController::class, 'rate'])->name('lessons.rate');
    
    // Courses & Payment
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::post('/courses/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::post('/payments', [CourseController::class, 'payment'])->name('payments.store');
    
    // Materials
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials');
    Route::get('/materials/download/{id}', [MaterialController::class, 'download'])->name('materials.download');
    
    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates');
    Route::post('/certificates/request', [CertificateController::class, 'request'])->name('certificates.request');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Contact Us
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
});
