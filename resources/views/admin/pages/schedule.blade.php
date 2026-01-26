@extends('admin.layouts.app')

@section('page-title', __('messages.schedule'))
@section('page-subtitle', date('l, F d, Y'))

@section('styles')
<style>
    .schedule-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .schedule-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .week-navigation {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .nav-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        color: #64748B;
    }
    
    .nav-btn:hover {
        color: #00B86B;
    }
    
    .week-range {
        font-weight: 600;
        color: #1E293B;
        min-width: 200px;
        text-align: center;
    }
    
    .weekly-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .day-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        min-height: 200px;
    }
    
    .day-header {
        text-align: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #F1F5F9;
    }
    
    .day-name {
        font-size: 0.8rem;
        color: #64748B;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }
    
    .day-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .lesson-card {
        padding: 0.75rem;
        border-radius: 8px;
        margin-bottom: 0.75rem;
        border-left: 3px solid;
        background: #F8FAFC;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .lesson-card:hover {
        transform: translateX(2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .lesson-card:last-child {
        margin-bottom: 0;
    }
    
    .lesson-card.green {
        border-left-color: #10B981;
    }
    
    .lesson-card.blue {
        border-left-color: #3B82F6;
    }
    
    .lesson-card.purple {
        border-left-color: #8B5CF6;
    }
    
    .lesson-card.pink {
        border-left-color: #EC4899;
    }
    
    .lesson-card.orange {
        border-left-color: #F59E0B;
    }
    
    .lesson-student {
        font-weight: 600;
        color: #1E293B;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    .lesson-time {
        color: #64748B;
        font-size: 0.8rem;
    }
    
    .no-lessons {
        text-align: center;
        color: #94A3B8;
        font-size: 0.9rem;
        padding: 2rem 0;
    }
    
    @media (max-width: 1400px) {
        .weekly-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    @media (max-width: 1024px) {
        .weekly-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .weekly-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .schedule-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }
    }
</style>
@endsection

@section('content')
<div class="schedule-header">
    <h2 class="schedule-title">Weekly Schedule</h2>
    
    <div class="week-navigation">
        <button class="nav-btn" onclick="navigateWeek(-1)">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        
        <span class="week-range">
            {{ $weekStart->format('M d') }} - {{ $weekEnd->format('M d, Y') }}
        </span>
        
        <button class="nav-btn" onclick="navigateWeek(1)">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
    </div>
</div>

<div class="weekly-grid">
    @php
        $colors = ['green', 'blue', 'purple', 'pink', 'orange'];
    @endphp
    
    @foreach($weeklySchedule as $dayData)
        <div class="day-card">
            <div class="day-header">
                <div class="day-name">{{ $dayData['date']->format('l') }}</div>
                <div class="day-number">{{ $dayData['date']->format('d') }}</div>
            </div>
            
            @if($dayData['lessons']->count() > 0)
                @foreach($dayData['lessons'] as $index => $lesson)
                    <div class="lesson-card {{ $colors[$index % count($colors)] }}">
                        <div class="lesson-student">{{ $lesson->student_name }}</div>
                        <div class="lesson-time">
                            {{ \Carbon\Carbon::parse($lesson->start_time)->format('g:i A') }} - 
                            {{ \Carbon\Carbon::parse($lesson->end_time)->format('g:i A') }}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-lessons">No lessons</div>
            @endif
        </div>
    @endforeach
</div>

<script>
function navigateWeek(direction) {
    const currentStart = '{{ $weekStart->format('Y-m-d') }}';
    const date = new Date(currentStart);
    date.setDate(date.getDate() + (direction * 7));
    
    const newStart = date.toISOString().split('T')[0];
    window.location.href = '{{ route('admin.schedule') }}?week_start=' + newStart;
}
</script>
@endsection
