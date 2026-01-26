@extends('admin.layouts.app')

@section('page-title', __('messages.lesson_history'))
@section('page-subtitle', date('l, F d, Y'))

@section('styles')
<style>
    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .history-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .filter-dropdown {
        padding: 0.75rem 1.5rem;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        background: white;
        font-weight: 600;
        cursor: pointer;
    }
    
    .lesson-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .lesson-item {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .student-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #00B86B 0%, #00915A 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .student-avatar.blue {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    }
    
    .student-avatar.orange {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
    }
    
    .student-avatar.pink {
        background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);
    }
    
    .student-avatar.purple {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
    }
    
    .lesson-info {
        flex: 1;
    }
    
    .student-name {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .lesson-type {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    .lesson-details {
        display: flex;
        gap: 3rem;
        align-items: center;
    }
    
    .detail-group {
        text-align: right;
    }
    
    .detail-label {
        color: #64748B;
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }
    
    .detail-value {
        color: #1E293B;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .status-badge {
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .status-completed {
        background: #D1FAE5;
        color: #059669;
    }
    
    .status-cancelled {
        background: #FEE2E2;
        color: #DC2626;
    }
    
    .status-scheduled {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    @media (max-width: 1024px) {
        .lesson-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .lesson-details {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
            width: 100%;
        }
        
        .detail-group {
            text-align: left;
        }
    }
    
    @media (max-width: 768px) {
        .history-header {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="history-header">
    <h2 class="history-title">Lesson History</h2>
    
    <select class="filter-dropdown">
        <option>Last 30 Days</option>
        <option>Last 60 Days</option>
        <option>Last 90 Days</option>
        <option>All Time</option>
    </select>
</div>

<div class="lesson-list">
    @php
        $avatarColors = ['green', 'blue', 'orange', 'pink', 'purple'];
    @endphp
    
    @forelse($lessons as $index => $lesson)
        <div class="lesson-item">
            <div class="student-avatar {{ $avatarColors[$index % count($avatarColors)] }}">
                {{ strtoupper(substr($lesson->student_name, 0, 2)) }}
            </div>
            
            <div class="lesson-info">
                <div class="student-name">{{ $lesson->student_name }}</div>
                <div class="lesson-type">{{ $lesson->lesson_type }} – {{ $lesson->level }}</div>
            </div>
            
            <div class="lesson-details">
                <div class="detail-group">
                    <div class="detail-label">Date</div>
                    <div class="detail-value">{{ $lesson->lesson_date->format('M d, Y') }}</div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-label">Time</div>
                    <div class="detail-value">
                        {{ \Carbon\Carbon::parse($lesson->start_time)->format('g:i A') }} - 
                        {{ \Carbon\Carbon::parse($lesson->end_time)->format('g:i A') }}
                    </div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <span class="status-badge status-{{ $lesson->status }}">
                            @if($lesson->status === 'completed')
                                ● Completed
                            @elseif($lesson->status === 'cancelled')
                                ● Cancelled
                            @else
                                ● Scheduled
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 3rem; color: #94A3B8; background: white; border-radius: 12px;">
            No lesson history found.
        </div>
    @endforelse
</div>
@endsection
