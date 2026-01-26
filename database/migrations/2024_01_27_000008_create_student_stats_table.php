<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->integer('days_learning')->default(0);
            $table->integer('hours_studied')->default(0);
            $table->decimal('attendance_rate', 5, 2)->default(0); // Percentage
            $table->integer('weekly_goal_current')->default(0);
            $table->integer('weekly_goal_total')->default(4); // Default 4 lessons per week
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_stats');
    }
};
