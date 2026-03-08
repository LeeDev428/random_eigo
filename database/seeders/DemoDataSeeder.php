<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Material;
use App\Models\TeacherProfile;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Payment;
use App\Models\StudentStats;
use App\Models\LessonRating;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a teacher user
        $teacher = User::firstOrCreate(
            ['email' => 'sarah.johnson@randomenglish.com'],
            [
                'name' => 'Sarah Elizabeth Johnson',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'locale' => 'en',
            ]
        );

        // Create teacher profile
        TeacherProfile::updateOrCreate(
            ['user_id' => $teacher->id],
            [
                'full_name' => 'Sarah Elizabeth Johnson',
                'phone_number' => '+1 (555) 123-4567',
                'teaching_subject' => 'English Language',
                'bio' => 'Passionate English educator with 5+ years of experience teaching business English, general English, kids lessons, exam preparation, and specialized courses. I hold a Master\'s degree in TESOL and am dedicated to creating engaging, student-centered learning environments.',
                'skills' => ['Business English', 'General English', 'Kids Lesson', 'Exam Prep', 'Academic English', 'Medical English'],
                'experience' => [
                    [
                        'title' => 'Senior English Teacher',
                        'company' => 'Random English Academy',
                        'period' => '2020 - Present',
                        'description' => 'Teaching business English to corporate professionals from Fortune 500 companies'
                    ]
                ]
            ]
        );

        // Create student users
        $students = [
            ['name' => 'John Liu', 'email' => 'john.liu@example.com'],
            ['name' => 'Sakura Kimura', 'email' => 'sakura.kimura@example.com'],
            ['name' => 'Alex Thompson', 'email' => 'alex.thompson@example.com'],
            ['name' => 'Lucy Chen', 'email' => 'lucy.chen@example.com'],
            ['name' => 'Emma Martinez', 'email' => 'emma.martinez@example.com'],
            ['name' => 'Maria Perez', 'email' => 'maria.perez@example.com'],
            ['name' => 'David Kim', 'email' => 'david.kim@example.com'],
            ['name' => 'Sophie Johnson', 'email' => 'sophie.johnson@example.com'],
            ['name' => 'Michael Roberts', 'email' => 'michael.roberts@example.com'],
            ['name' => 'Anna Lee', 'email' => 'anna.lee@example.com'],
        ];

        $studentModels = [];
        foreach ($students as $studentData) {
            $studentModels[] = User::firstOrCreate(
                ['email' => $studentData['email']],
                [
                    'name' => $studentData['name'],
                    'password' => Hash::make('password'),
                    'role' => 'student',
                    'locale' => 'ja',
                ]
            );
        }

        // Create lessons
        $lessonTypes = ['Business English', 'IELTS Preparation', 'Conversational English', 'Kids English', 'Grammar Workshop'];
        $levels = ['Beginner', 'Intermediate', 'Advanced'];
        $requests = [
            'Practice negotiation strategies and formal email writing',
            'Speaking practice session',
            'Focus on fluency and everyday conversation',
            'Fun interactive activities with animals and colors',
            'Advanced tenses review',
        ];

        $today = Carbon::today();
        
        // Today's lessons
        Lesson::create([
            'teacher_id' => $teacher->id,
            'student_id' => $studentModels[0]->id,
            'student_name' => $studentModels[0]->name,
            'lesson_type' => 'Business English',
            'level' => 'Advanced',
            'lesson_date' => $today,
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
            'status' => 'scheduled',
            'request_notes' => 'Practice negotiation strategies and formal email writing',
        ]);

        Lesson::create([
            'teacher_id' => $teacher->id,
            'student_id' => $studentModels[1]->id,
            'student_name' => $studentModels[1]->name,
            'lesson_type' => 'IELTS Preparation',
            'level' => 'Advanced',
            'lesson_date' => $today,
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
            'status' => 'scheduled',
            'request_notes' => 'Speaking practice session',
        ]);

        Lesson::create([
            'teacher_id' => $teacher->id,
            'student_id' => $studentModels[2]->id,
            'student_name' => $studentModels[2]->name,
            'lesson_type' => 'Grammar Workshop',
            'level' => 'Intermediate',
            'lesson_date' => $today,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'scheduled',
            'request_notes' => 'Advanced tenses review',
        ]);

        // Upcoming lessons (next week)
        $weekDays = [
            ['day' => 1, 'student' => 2, 'type' => 'Business English', 'time' => ['09:00:00', '10:30:00']],
            ['day' => 1, 'student' => 1, 'type' => 'IELTS Preparation', 'time' => ['10:00:00', '11:30:00']],
            ['day' => 2, 'student' => 3, 'type' => 'Conversational English', 'time' => ['14:00:00', '15:00:00']],
            ['day' => 2, 'student' => 4, 'type' => 'Kids English', 'time' => ['16:30:00', '18:00:00']],
            ['day' => 3, 'student' => 5, 'type' => 'Business English', 'time' => ['10:00:00', '11:30:00']],
            ['day' => 4, 'student' => 6, 'type' => 'Conversational English', 'time' => ['14:00:00', '15:30:00']],
            ['day' => 5, 'student' => 7, 'type' => 'IELTS Preparation', 'time' => ['15:00:00', '16:30:00']],
            ['day' => 5, 'student' => 8, 'type' => 'Kids English', 'time' => ['17:00:00', '18:30:00']],
            ['day' => 6, 'student' => 9, 'type' => 'Business English', 'time' => ['09:00:00', '10:30:00']],
        ];

        $startOfWeek = Carbon::now()->startOfWeek();
        foreach ($weekDays as $day) {
            Lesson::create([
                'teacher_id' => $teacher->id,
                'student_id' => $studentModels[$day['student']]->id,
                'student_name' => $studentModels[$day['student']]->name,
                'lesson_type' => $day['type'],
                'level' => $levels[array_rand($levels)],
                'lesson_date' => $startOfWeek->copy()->addDays($day['day']),
                'start_time' => $day['time'][0],
                'end_time' => $day['time'][1],
                'status' => 'scheduled',
            ]);
        }

        // Completed lessons (last month)
        for ($i = 0; $i < 20; $i++) {
            Lesson::create([
                'teacher_id' => $teacher->id,
                'student_id' => $studentModels[array_rand($studentModels)]->id,
                'student_name' => $studentModels[array_rand($studentModels)]->name,
                'lesson_type' => $lessonTypes[array_rand($lessonTypes)],
                'level' => $levels[array_rand($levels)],
                'lesson_date' => Carbon::now()->subDays(rand(5, 30)),
                'start_time' => sprintf('%02d:00:00', rand(8, 17)),
                'end_time' => sprintf('%02d:30:00', rand(9, 18)),
                'status' => 'completed',
                'teacher_notes' => 'Good progress. Student is improving well.',
            ]);
        }

        // Cancelled lessons
        for ($i = 0; $i < 5; $i++) {
            Lesson::create([
                'teacher_id' => $teacher->id,
                'student_id' => $studentModels[array_rand($studentModels)]->id,
                'student_name' => $studentModels[array_rand($studentModels)]->name,
                'lesson_type' => $lessonTypes[array_rand($lessonTypes)],
                'level' => $levels[array_rand($levels)],
                'lesson_date' => Carbon::now()->subDays(rand(1, 30)),
                'start_time' => sprintf('%02d:00:00', rand(8, 17)),
                'end_time' => sprintf('%02d:30:00', rand(9, 18)),
                'status' => 'cancelled',
            ]);
        }

        // Create materials
        $materials = [
            ['title' => 'Business Negotiation Guide.pdf', 'category' => 'Business English', 'size' => 2400000],
            ['title' => 'IELTS Writing Task 2 Templates.docx', 'category' => 'IELTS Prep', 'size' => 1800000],
            ['title' => 'Kids English - Animal Flashcards.pdf', 'category' => 'Kids Lessons', 'size' => 3200000],
            ['title' => 'Conversational Topics - Advanced.pdf', 'category' => 'Conversational', 'size' => 1500000],
            ['title' => 'Grammar Exercises - Present Perfect.docx', 'category' => 'Business English', 'size' => 890000],
            ['title' => 'Pronunciation Practice - Vowels.pdf', 'category' => 'Conversational', 'size' => 1200000],
        ];

        foreach ($materials as $material) {
            Material::create([
                'teacher_id' => $teacher->id,
                'title' => $material['title'],
                'file_path' => 'materials/' . $material['title'],
                'file_name' => $material['title'],
                'file_size' => $material['size'],
                'category' => $material['category'],
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
            ]);
        }

        // Create student-specific demo data
        $mainStudent = User::firstOrCreate(
            ['email' => 'sarah.chen@example.com'],
            [
                'name' => 'Sarah Chen',
                'password' => Hash::make('password'),
                'role' => 'student',
                'locale' => 'ja',
            ]
        );

        // Create student stats
        StudentStats::updateOrCreate(
            ['student_id' => $mainStudent->id],
            [
                'days_learning' => 156,
                'hours_studied' => 36,
                'attendance_rate' => 92,
                'weekly_goal_current' => 4,
                'weekly_goal_total' => 5,
            ]
        );

        // Create certificates for student
        $certificates = [
            ['name' => 'Elementary', 'level' => 'A2', 'type' => 'General', 'completed' => Carbon::now()->subMonths(8)],
            ['name' => 'Intermediate', 'level' => 'B1', 'type' => 'General', 'completed' => Carbon::now()->subMonths(4)],
            ['name' => 'Business English Basics', 'level' => 'B1', 'type' => 'Business', 'completed' => Carbon::now()->subMonths(2)],
        ];

        foreach ($certificates as $cert) {
            Certificate::create([
                'student_id' => $mainStudent->id,
                'certificate_name' => $cert['name'],
                'level' => $cert['level'],
                'completed_date' => $cert['completed'],
                'certificate_type' => $cert['type'],
            ]);
        }

        // Create courses
        $courses = [
            [
                'name' => 'Basic Plan',
                'course_type' => 'standard',
                'price' => 6000,
                'description' => 'Perfect for beginners',
                'features' => ['10 credits per month', 'Access to basic materials', 'Email support'],
                'duration' => '10 credits'
            ],
            [
                'name' => 'Standard Plan',
                'course_type' => 'popular',
                'price' => 12000,
                'description' => 'Most popular choice',
                'features' => ['20 credits per month', 'Priority scheduling', 'All materials access', '24/7 support'],
                'duration' => '20 credits'
            ],
            [
                'name' => 'Premium Plan',
                'course_type' => 'premium',
                'price' => 18000,
                'description' => 'For serious learners',
                'features' => ['30 credits per month', 'Priority teacher selection', 'Personalized curriculum', 'Video lessons'],
                'duration' => '30 credits'
            ],
            [
                'name' => 'Ultimate Plan',
                'course_type' => 'ultimate',
                'price' => 22100,
                'description' => 'Unlimited access',
                'features' => ['Unlimited credits', 'Private sessions', 'Custom materials', 'Progress reports'],
                'duration' => 'Unlimited'
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        // Create enrollment for student
        $standardPlan = Course::where('course_type', 'popular')->first();
        CourseEnrollment::create([
            'student_id' => $mainStudent->id,
            'course_id' => $standardPlan->id,
            'credits_purchased' => 20,
            'credits_used' => 12,
            'status' => 'active',
            'enrolled_date' => Carbon::now()->subMonth(),
        ]);

        // Create payment history
        Payment::create([
            'student_id' => $mainStudent->id,
            'course_id' => $standardPlan->id,
            'amount' => 12000,
            'payment_method' => 'credit_card',
            'description' => 'Standard Plan - Monthly Payment',
            'status' => 'paid',
            'payment_date' => Carbon::now()->subMonth(),
        ]);

        Payment::create([
            'student_id' => $mainStudent->id,
            'course_id' => $standardPlan->id,
            'amount' => 12000,
            'payment_method' => 'credit_card',
            'description' => 'Standard Plan - Monthly Payment',
            'status' => 'paid',
            'payment_date' => Carbon::now()->subMonths(2),
        ]);

        // Create lessons for student with ratings
        $studentLessons = [];
        for ($i = 0; $i < 24; $i++) {
            $lesson = Lesson::create([
                'teacher_id' => $teacher->id,
                'student_id' => $mainStudent->id,
                'student_name' => $mainStudent->name,
                'lesson_type' => $lessonTypes[array_rand($lessonTypes)],
                'level' => 'B1+',
                'lesson_date' => Carbon::now()->subDays(rand(5, 60)),
                'start_time' => sprintf('%02d:00:00', rand(9, 17)),
                'end_time' => sprintf('%02d:50:00', rand(10, 18)),
                'status' => 'completed',
            ]);
            
            // Add ratings to some lessons
            if ($i % 3 == 0) {
                LessonRating::create([
                    'lesson_id' => $lesson->id,
                    'student_id' => $mainStudent->id,
                    'rating' => (string) rand(4, 5),
                    'comment' => 'Great lesson! Very helpful teacher.',
                ]);
            }
            
            $studentLessons[] = $lesson;
        }

        // Create upcoming lessons for student
        Lesson::create([
            'teacher_id' => $teacher->id,
            'student_id' => $mainStudent->id,
            'student_name' => $mainStudent->name,
            'lesson_type' => 'Business English',
            'level' => 'B1+',
            'lesson_date' => Carbon::tomorrow(),
            'start_time' => '10:00:00',
            'end_time' => '10:50:00',
            'status' => 'scheduled',
        ]);

        Lesson::create([
            'teacher_id' => $teacher->id,
            'student_id' => $mainStudent->id,
            'student_name' => $mainStudent->name,
            'lesson_type' => 'Conversational English',
            'level' => 'B1+',
            'lesson_date' => Carbon::now()->addDays(3),
            'start_time' => '14:00:00',
            'end_time' => '14:50:00',
            'status' => 'scheduled',
        ]);

        $this->command->info('Demo data seeded successfully!');
    }
}
