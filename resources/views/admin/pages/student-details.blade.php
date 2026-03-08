@extends('admin.layouts.app')

@section('page-title', $student->name)
@section('page-subtitle', 'Student Details')

@section('styles')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #00B86B;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .student-profile {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #00B86B 0%, #00915A 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .profile-info h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
        margin: 0 0 0.25rem 0;
    }

    .profile-info p {
        color: #64748B;
        margin: 0;
    }

    .profile-stats {
        display: flex;
        gap: 2rem;
        margin-left: auto;
    }

    .profile-stat {
        text-align: center;
    }

    .profile-stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #00B86B;
    }

    .profile-stat-label {
        color: #64748B;
        font-size: 0.85rem;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 1.5rem;
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

    .lesson-date-box {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        background: #F0FDF4;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .lesson-date-day {
        font-size: 1.3rem;
        font-weight: 700;
        color: #00B86B;
        line-height: 1;
    }

    .lesson-date-month {
        font-size: 0.7rem;
        color: #64748B;
        text-transform: uppercase;
        font-weight: 600;
    }

    .lesson-info {
        flex: 1;
    }

    .lesson-title {
        font-weight: 700;
        font-size: 1.05rem;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }

    .lesson-meta {
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
        .student-profile {
            flex-direction: column;
            align-items: flex-start;
        }

        .profile-stats {
            margin-left: 0;
        }

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
</style>
@endsection

@section('content')
<a href="{{ route('admin.students') }}" class="back-link">
    ← Back to Students
</a>

<div class="student-profile">
    <div class="profile-avatar">
        {{ strtoupper(substr($student->name, 0, 2)) }}
    </div>

    <div class="profile-info">
        <h2>{{ $student->name }}</h2>
        <p>{{ $student->email }}</p>
    </div>

    <div class="profile-stats">
        <div class="profile-stat">
            <div class="profile-stat-value">{{ $lessons->count() }}</div>
            <div class="profile-stat-label">Total Lessons</div>
        </div>
        <div class="profile-stat">
            <div class="profile-stat-value">{{ $lessons->where('status', 'completed')->count() }}</div>
            <div class="profile-stat-label">Completed</div>
        </div>
        <div class="profile-stat">
            <div class="profile-stat-value">{{ $lessons->where('status', 'scheduled')->count() }}</div>
            <div class="profile-stat-label">Scheduled</div>
        </div>
    </div>
</div>

<h3 class="section-title">Lesson History</h3>

<div class="lesson-list">
    @forelse($lessons as $lesson)
        <div class="lesson-item">
            <div class="lesson-date-box">
                <div class="lesson-date-day">{{ $lesson->lesson_date->format('d') }}</div>
                <div class="lesson-date-month">{{ $lesson->lesson_date->format('M') }}</div>
            </div>

            <div class="lesson-info">
                <div class="lesson-title">{{ $lesson->lesson_type }} – {{ $lesson->level }}</div>
                <div class="lesson-meta">{{ $lesson->notes ?? 'No notes' }}</div>
            </div>

            <div class="lesson-details">
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
            No lessons found with this student.
        </div>
    @endforelse
</div>
@endsection
