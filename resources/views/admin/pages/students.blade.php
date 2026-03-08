@extends('admin.layouts.app')

@section('page-title', __('messages.students'))
@section('page-subtitle', date('l, F d, Y'))

@section('styles')
<style>
    .students-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .students-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
    }

    .students-count {
        color: #64748B;
        font-size: 0.95rem;
    }

    .student-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .student-item {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        text-decoration: none;
        color: inherit;
        transition: box-shadow 0.2s;
    }

    .student-item:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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

    .student-info {
        flex: 1;
    }

    .student-name {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }

    .student-email {
        color: #64748B;
        font-size: 0.9rem;
    }

    .student-stats {
        display: flex;
        gap: 3rem;
        align-items: center;
    }

    .stat-group {
        text-align: right;
    }

    .stat-label {
        color: #64748B;
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        color: #1E293B;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .view-btn {
        padding: 0.5rem 1.2rem;
        background: #00B86B;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        text-decoration: none;
    }

    .view-btn:hover {
        background: #00915A;
    }

    @media (max-width: 1024px) {
        .student-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .student-stats {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
            width: 100%;
        }

        .stat-group {
            text-align: left;
        }
    }

    @media (max-width: 768px) {
        .students-header {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="students-header">
    <div>
        <h2 class="students-title">My Students</h2>
        <p class="students-count">{{ $students->count() }} student{{ $students->count() !== 1 ? 's' : '' }}</p>
    </div>
</div>

<div class="student-list">
    @php
        $avatarColors = ['green', 'blue', 'orange', 'pink', 'purple'];
    @endphp

    @forelse($students as $index => $student)
        <a href="{{ route('admin.students.show', $student->id) }}" class="student-item">
            <div class="student-avatar {{ $avatarColors[$index % count($avatarColors)] }}">
                {{ strtoupper(substr($student->name, 0, 2)) }}
            </div>

            <div class="student-info">
                <div class="student-name">{{ $student->name }}</div>
                <div class="student-email">{{ $student->email }}</div>
            </div>

            <div class="student-stats">
                <div class="stat-group">
                    <div class="stat-label">Total Lessons</div>
                    <div class="stat-value">{{ $student->total_lessons }}</div>
                </div>

                <div class="stat-group">
                    <div class="stat-label">Completed</div>
                    <div class="stat-value">{{ $student->completed_lessons }}</div>
                </div>

                <div class="stat-group">
                    <div class="stat-label">Last Lesson</div>
                    <div class="stat-value">
                        @if($student->last_lesson)
                            {{ $student->last_lesson->lesson_date->format('M d, Y') }}
                        @else
                            —
                        @endif
                    </div>
                </div>
            </div>

            <span class="view-btn">View</span>
        </a>
    @empty
        <div style="text-align: center; padding: 3rem; color: #94A3B8; background: white; border-radius: 12px;">
            No students found.
        </div>
    @endforelse
</div>
@endsection
