@extends('admin.layouts.app')

@section('page-title', __('messages.dashboard'))
@section('page-subtitle', date('l, F d, Y'))

@section('styles')
<style>
    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, #00B86B 0%, #00915A 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0,184,107,0.2);
        width: 100%;
        box-sizing: border-box;
    }
    
    .welcome-banner h2 {
        font-size: 2rem;
        margin: 0 0 0.5rem 0;
        font-weight: 700;
    }
    
    .welcome-banner p {
        font-size: 1.1rem;
        opacity: 0.95;
        margin: 0;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
        width: 100%;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        box-sizing: border-box;
    }
    
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .stat-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        white-space: nowrap;
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
        color: #1E293B;
        line-height: 1;
    }
    
    .stat-label {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        width: 100%;
    }
    
    .section-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        box-sizing: border-box;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1E293B;
        margin: 0;
    }
    
    .view-all-link {
        color: #00B86B;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .view-all-link:hover {
        text-decoration: underline;
    }
    
    /* Schedule Items */
    .schedule-item {
        padding: 1.2rem;
        border-left: 3px solid #00B86B;
        background: #F8FAFC;
        border-radius: 8px;
        margin-bottom: 1rem;
    }
    
    .schedule-item:last-child {
        margin-bottom: 0;
    }
    
    .schedule-item.blue {
        border-left-color: #3B82F6;
    }
    
    .schedule-time {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .time-label {
        font-weight: 700;
        color: #00B86B;
        font-size: 1rem;
    }
    
    .time-badge {
        padding: 0.2rem 0.75rem;
        background: #E0F7EE;
        color: #00B86B;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .schedule-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
        color: #1E293B;
    }
    
    .schedule-description {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    /* Announcements */
    .announcement-item {
        padding: 1.2rem;
        border-left: 3px solid #3B82F6;
        background: #F8FAFC;
        border-radius: 8px;
        margin-bottom: 1rem;
    }
    
    .announcement-item:last-child {
        margin-bottom: 0;
    }
    
    .announcement-item.orange {
        border-left-color: #FF8A00;
    }
    
    .announcement-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
        color: #1E293B;
    }
    
    .announcement-meta {
        color: #64748B;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }
    
    .announcement-description {
        color: #475569;
        font-size: 0.9rem;
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .welcome-banner {
            padding: 1.5rem;
        }
        
        .welcome-banner h2 {
            font-size: 1.5rem;
        }
        
        .welcome-banner p {
            font-size: 1rem;
        }
        
        .section-card {
            padding: 1.5rem;
        }
        
        .stat-value {
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 1.1rem;
        }
    }
    
    @media (max-width: 480px) {
        .welcome-banner {
            padding: 1rem;
        }
        
        .welcome-banner h2 {
            font-size: 1.25rem;
        }
        
        .welcome-banner p {
            font-size: 0.9rem;
        }
        
        .stat-card {
            padding: 1rem;
        }
        
        .stat-value {
            font-size: 1.75rem;
        }
        
        .section-card {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <h2>{{ __('messages.welcome_back', ['name' => Auth::user()->name]) }} 👋</h2>
        <p>{{ __('messages.classes_scheduled_today', ['count' => count($todaySchedule)]) }}</p>
    </div>
    
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background: #DBEAFE;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                </div>
                <div class="stat-badge" style="background: #E0F7EE; color: #00B86B;">
                    {{ __('messages.this_month') }}
                </div>
            </div>
            <div class="stat-value">{{ $stats['lessons_conducted'] }}</div>
            <div class="stat-label">{{ __('messages.lessons_conducted') }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background: #EDE9FE;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="stat-badge" style="background: #DBEAFE; color: #3B82F6;">
                    {{ __('messages.active') }}
                </div>
            </div>
            <div class="stat-value">{{ $stats['total_students'] }}</div>
            <div class="stat-label">{{ __('messages.total_students') }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background: #FFF3E0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FF8A00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H2v7l6.29 6.29c.94.94 2.48.94 3.42 0l3.58-3.58c.94-.94.94-2.48 0-3.42L9 5Z"/><path d="M6 9.01V9"/><path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19"/></svg>
                </div>
                <div class="stat-badge" style="background: #FEF3C7; color: #D97706;">
                    {{ __('messages.pending') }}
                </div>
            </div>
            <div class="stat-value">{{ $stats['assignments_to_grade'] }}</div>
            <div class="stat-label">{{ __('messages.assignments_to_grade') }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background: #FCE7F3;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#EC4899" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div class="stat-badge" style="background: #E0E7FF; color: #6366F1;">
                    {{ __('messages.average') }}
                </div>
            </div>
            <div class="stat-value">{{ $stats['student_rating'] }}</div>
            <div class="stat-label">{{ __('messages.student_rating') }}</div>
        </div>
    </div>
    
    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Today's Schedule -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.todays_schedule') }}</h2>
                <a href="{{ route('admin.schedule') }}" class="view-all-link">{{ __('messages.view_all') }}</a>
            </div>
            
            @forelse($todaySchedule as $schedule)
            <div class="schedule-item {{ $schedule['color'] == 'blue' ? 'blue' : '' }}">
                <div class="schedule-time">
                    <span class="time-label" style="color: {{ $schedule['color'] == 'blue' ? '#3B82F6' : '#00B86B' }};">{{ $schedule['time'] }}</span>
                    <span class="time-badge" style="background: {{ $schedule['color'] == 'blue' ? '#DBEAFE' : '#E0F7EE' }}; color: {{ $schedule['color'] == 'blue' ? '#3B82F6' : '#00B86B' }};">{{ $schedule['badge'] }}</span>
                </div>
                <div class="schedule-title">{{ $schedule['title'] }}</div>
                <div class="schedule-description">{{ $schedule['description'] }}</div>
            </div>
            @empty
            <p style="text-align: center; color: #64748B; padding: 2rem;">{{ __('messages.no_classes_today') }}</p>
            @endforelse
        </div>
        
        <!-- Announcements -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.announcements') }}</h2>
            </div>
            
            @forelse($announcements as $announcement)
            <div class="announcement-item {{ $announcement['color'] == 'orange' ? 'orange' : '' }}">
                <div class="announcement-title">{{ $announcement['title'] }}</div>
                <div class="announcement-meta">{{ $announcement['meta'] }}</div>
                <div class="announcement-description">{{ $announcement['description'] }}</div>
            </div>
            @empty
            <p style="text-align: center; color: #64748B; padding: 1.5rem;">{{ __('messages.no_announcements') }}</p>
            @endforelse
        </div>
    </div>
@endsection
