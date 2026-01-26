@extends('student.layouts.app')

@section('page-title', 'Book a Lesson')
@section('page-subtitle', 'Welcome back! Ready to continue learning?')

@section('styles')
<style>
    .search-bar {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .search-input, .filter-select {
        padding: 0.75rem;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        font-size: 0.95rem;
    }
    
    .search-input:focus, .filter-select:focus {
        outline: none;
        border-color: #00B86B;
    }
    
    .lesson-request-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }
    
    .request-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .request-icon {
        width: 48px;
        height: 48px;
        background: #3B82F6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    
    .request-textarea {
        width: 100%;
        min-height: 120px;
        padding: 1rem;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        resize: vertical;
        font-family: inherit;
    }
    
    .request-textarea:focus {
        outline: none;
        border-color: #00B86B;
    }
    
    .teacher-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .teacher-card {
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
        background: #3B82F6;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .teacher-avatar.green {
        background: #10B981;
    }
    
    .teacher-info {
        flex: 1;
    }
    
    .teacher-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .teacher-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }
    
    .badge-native {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .badge-certified {
        background: #D1FAE5;
        color: #059669;
    }
    
    .teacher-specialties {
        color: #64748B;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .teacher-stats {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        font-size: 0.85rem;
        color: #64748B;
    }
    
    .rating {
        color: #F59E0B;
    }
    
    .time-slots {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .availability-label {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    .time-slot {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .time-slot.teal {
        background: #CCFBF1;
        color: #0F766E;
    }
    
    .time-slot.blue {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .time-slot.pink {
        background: #FCE7F3;
        color: #BE185D;
    }
    
    .time-slot:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    @media (max-width: 1024px) {
        .search-bar {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .search-bar {
            grid-template-columns: 1fr;
        }
        
        .teacher-card {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endsection

@section('content')
<div class="search-bar">
    <input type="text" class="search-input" placeholder="Search by name or specialty...">
    <input type="date" class="filter-select" value="01/26/2026">
    <select class="filter-select">
        <option>Any time</option>
        <option>Morning</option>
        <option>Afternoon</option>
        <option>Evening</option>
    </select>
    <select class="filter-select">
        <option>All specialties</option>
        <option>Business English</option>
        <option>Conversation</option>
        <option>Grammar</option>
    </select>
</div>

<div class="lesson-request-card">
    <div class="request-header">
        <div class="request-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 20h9"></path>
                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
            </svg>
        </div>
        <div>
            <h3 style="margin: 0; font-weight: 700; color: #1E293B;">Lesson Request</h3>
            <p style="margin: 0.25rem 0 0 0; color: #64748B; font-size: 0.9rem;">Tell us what you'd like to focus on in your lesson (e.g., business presentations, grammar practice, conversation topics)</p>
        </div>
    </div>
    
    <textarea class="request-textarea" placeholder="Example: I'd like to practice job interview questions and improve my professional vocabulary..."></textarea>
    
    <div style="margin-top: 0.5rem; padding: 0.75rem; background: #FEF3C7; border-radius: 8px; display: flex; align-items: center; gap: 0.5rem;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
            <line x1="12" y1="9" x2="12" y2="13"></line>
            <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>
        <span style="color: #92400E; font-size: 0.85rem;">This will help your teacher prepare the best lesson for you!</span>
    </div>
</div>

<div class="teacher-list">
    @forelse($teachers as $index => $teacher)
        <div class="teacher-card">
            <div class="teacher-avatar {{ $index % 2 == 0 ? 'green' : '' }}">
                {{ strtoupper(substr($teacher->name, 0, 2)) }}
            </div>
            
            <div class="teacher-info">
                <div>
                    <span class="teacher-name">{{ $teacher->name }}</span>
                    <span class="teacher-badge badge-{{ $index % 2 == 0 ? 'native' : 'certified' }}">
                        {{ $index % 2 == 0 ? 'Native Speaker' : 'Certified Teacher' }}
                    </span>
                </div>
                <div class="teacher-specialties">Business English • Conversation • Public Speaking</div>
                <div class="teacher-stats">
                    <span class="rating">⭐ 4.9</span>
                    <span>1,240 lessons</span>
                    <span>🇬🇧 UK</span>
                </div>
            </div>
            
            <div class="time-slots">
                <span class="availability-label">Available today:</span>
                <button class="time-slot teal">9:00 AM</button>
                <button class="time-slot blue">11:00 AM</button>
                <button class="time-slot pink">2:00 PM</button>
            </div>
        </div>
    @empty
        <p style="text-align: center; padding: 3rem; color: #94A3B8;">No teachers available</p>
    @endforelse
</div>
@endsection
