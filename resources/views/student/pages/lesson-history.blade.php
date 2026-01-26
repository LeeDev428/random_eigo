@extends('student.layouts.app')

@section('page-title', 'Lesson History')
@section('page-subtitle', 'Review your completed lessons and learning progress')

@section('styles')
<style>
    .filter-bar {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .filter-select {
        padding: 0.75rem 1rem;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        font-size: 0.95rem;
        cursor: pointer;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: #00B86B;
    }
    
    .lessons-grid {
        display: grid;
        gap: 1rem;
    }
    
    .lesson-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .teacher-avatar {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
    }
    
    .teacher-avatar:nth-child(1) {
        background: #3B82F6;
    }
    
    .avatar-blue {
        background: #3B82F6;
    }
    
    .avatar-green {
        background: #10B981;
    }
    
    .avatar-pink {
        background: #EC4899;
    }
    
    .avatar-purple {
        background: #8B5CF6;
    }
    
    .lesson-info {
        flex: 1;
    }
    
    .lesson-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.5rem;
    }
    
    .lesson-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .lesson-teacher {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    .lesson-meta {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        color: #64748B;
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }
    
    .lesson-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .lesson-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .lesson-tag {
        padding: 0.35rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .tag-blue {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .tag-green {
        background: #D1FAE5;
        color: #059669;
    }
    
    .tag-purple {
        background: #E0E7FF;
        color: #6366F1;
    }
    
    .lesson-rating-section {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .rating-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        white-space: nowrap;
    }
    
    .rating-excellent {
        background: #D1FAE5;
        color: #059669;
    }
    
    .rating-very-good {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .rating-good {
        background: #FEF3C7;
        color: #D97706;
    }
    
    .rate-btn {
        padding: 0.5rem 1.5rem;
        border: 2px solid #00B86B;
        background: white;
        color: #00B86B;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .rate-btn:hover {
        background: #00B86B;
        color: white;
    }
    
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        text-align: center;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .lesson-card {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .lesson-header {
            flex-direction: column;
        }
        
        .lesson-rating-section {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        
        .rate-btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-value">{{ $completedLessons }}</div>
        <div class="stat-label">Total Lessons</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $totalHours }}h</div>
        <div class="stat-label">Total Hours</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $averageRating }}</div>
        <div class="stat-label">Average Rating</div>
    </div>
</div>

<div class="filter-bar">
    <span style="font-weight: 600; color: #1E293B;">Filter lessons</span>
    <select class="filter-select">
        <option>All lessons</option>
        <option>This week</option>
        <option>This month</option>
        <option>Last 3 months</option>
    </select>
</div>

<div class="lessons-grid">
    @forelse($lessons as $index => $lesson)
        @php
            $avatarColors = ['avatar-blue', 'avatar-green', 'avatar-pink', 'avatar-purple'];
            $avatarColor = $avatarColors[$index % 4];
            $tags = [
                ['name' => 'Business English', 'class' => 'tag-blue'],
                ['name' => 'Conversation', 'class' => 'tag-green'],
                ['name' => 'Grammar', 'class' => 'tag-purple']
            ];
            $selectedTag = $tags[$index % 3];
            
            $ratingOptions = [
                ['rating' => 5, 'label' => 'Excellent', 'class' => 'rating-excellent'],
                ['rating' => 4, 'label' => 'Very Good', 'class' => 'rating-very-good'],
                ['rating' => 3, 'label' => 'Good', 'class' => 'rating-good']
            ];
            $selectedRating = $ratingOptions[$index % 3];
        @endphp
        
        <div class="lesson-card">
            <div class="teacher-avatar {{ $avatarColor }}">
                {{ strtoupper(substr($lesson->teacher->name ?? 'T', 0, 2)) }}
            </div>
            
            <div class="lesson-info">
                <div class="lesson-header">
                    <div>
                        <h3 class="lesson-title">{{ $lesson->lesson_type ?? 'General English Lesson' }}</h3>
                        <p class="lesson-teacher">with {{ $lesson->teacher->name ?? 'Teacher' }}</p>
                    </div>
                </div>
                
                <div class="lesson-meta">
                    <span class="lesson-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        {{ $lesson->lesson_date->format('M d, Y') }}
                    </span>
                    <span class="lesson-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        {{ $lesson->lesson_time }} - {{ \Carbon\Carbon::parse($lesson->lesson_time)->addMinutes(50)->format('H:i') }}
                    </span>
                    <span class="lesson-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        {{ $lesson->level ?? 'B1' }}
                    </span>
                </div>
                
                <div class="lesson-tags">
                    <span class="lesson-tag {{ $selectedTag['class'] }}">{{ $selectedTag['name'] }}</span>
                </div>
            </div>
            
            <div class="lesson-rating-section">
                @if($lesson->lessonRating)
                    <span class="rating-badge {{ $selectedRating['class'] }}">
                        ⭐ {{ $selectedRating['label'] }}
                    </span>
                @else
                    <button class="rate-btn">Rate Lesson</button>
                @endif
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 3rem; background: white; border-radius: 12px;">
            <p style="color: #94A3B8; margin-bottom: 1rem;">No lessons completed yet</p>
            <a href="{{ route('student.lessons.book') }}" style="color: #00B86B; text-decoration: none; font-weight: 600;">Book your first lesson →</a>
        </div>
    @endforelse
</div>
@endsection
