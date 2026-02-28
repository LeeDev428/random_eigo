@extends('superadmin.layouts.app')

@section('page-title', $user->name)
@section('page-subtitle', $user->role === 'admin' ? __('messages.sa_teacher_details') : __('messages.sa_student_details'))

@section('styles')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #7C3AED;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }
    
    .back-link:hover {
        text-decoration: underline;
    }
    
    .user-header {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .user-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }
    
    .avatar-teacher { background: linear-gradient(135deg, #00B86B, #00915A); }
    .avatar-student { background: linear-gradient(135deg, #3B82F6, #2563EB); }
    
    .user-meta h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
    }
    
    .user-meta p {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    .role-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }
    
    .role-admin { background: #E0F7EE; color: #00B86B; }
    .role-student { background: #DBEAFE; color: #3B82F6; }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .detail-card {
        background: white;
        padding: 1.25rem;
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
    }
    
    .detail-card .label {
        font-size: 0.8rem;
        color: #64748B;
        margin-bottom: 0.3rem;
    }
    
    .detail-card .value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .section-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        margin-bottom: 1.5rem;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 1rem;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table th {
        text-align: left;
        padding: 0.75rem 0.5rem;
        font-size: 0.8rem;
        color: #64748B;
        font-weight: 600;
        border-bottom: 1px solid #E2E8F0;
        text-transform: uppercase;
    }
    
    .data-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.9rem;
        border-bottom: 1px solid #F1F5F9;
        color: #1E293B;
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-completed { background: #DCFCE7; color: #16A34A; }
    .status-scheduled { background: #DBEAFE; color: #2563EB; }
    .status-cancelled { background: #FEE2E2; color: #DC2626; }
    .status-paid { background: #DCFCE7; color: #16A34A; }
    .status-pending { background: #FEF3C7; color: #D97706; }
    .status-active { background: #DBEAFE; color: #2563EB; }
    
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }
    
    .info-item {
        padding: 0.5rem 0;
    }
    
    .info-item .label {
        font-size: 0.8rem;
        color: #64748B;
    }
    
    .info-item .value {
        font-weight: 600;
        color: #1E293B;
    }
    
    @media (max-width: 768px) {
        .user-header {
            flex-direction: column;
            text-align: center;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

<a href="{{ route('superadmin.users') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    {{ __('messages.sa_back_to_users') }}
</a>

<!-- User Header -->
<div class="user-header">
    <div class="user-avatar {{ $user->role === 'admin' ? 'avatar-teacher' : 'avatar-student' }}">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
    <div class="user-meta">
        <h2>{{ $user->name }} <span class="role-badge role-{{ $user->role }}">{{ $user->role === 'admin' ? 'Teacher' : ucfirst($user->role) }}</span></h2>
        <p>{{ $user->email }} &middot; {{ __('messages.sa_joined') }}: {{ $user->created_at->format('M d, Y') }}</p>
    </div>
</div>

<!-- Quick Stats -->
<div class="detail-grid">
    <div class="detail-card">
        <div class="label">{{ __('messages.sa_total_lessons') }}</div>
        <div class="value">{{ $totalLessons }}</div>
    </div>
    <div class="detail-card">
        <div class="label">{{ __('messages.sa_completed') }}</div>
        <div class="value">{{ $completedLessons }}</div>
    </div>
    @if($user->role === 'student' && isset($enrollments))
    <div class="detail-card">
        <div class="label">{{ __('messages.sa_enrollments') }}</div>
        <div class="value">{{ $enrollments->count() }}</div>
    </div>
    @endif
    @if($user->role === 'student' && isset($certificates))
    <div class="detail-card">
        <div class="label">{{ __('messages.certificates') }}</div>
        <div class="value">{{ $certificates->count() }}</div>
    </div>
    @endif
    @if($user->role === 'admin' && isset($profile) && $profile)
    <div class="detail-card">
        <div class="label">{{ __('messages.sa_subject') }}</div>
        <div class="value" style="font-size:1rem;">{{ $profile->teaching_subject ?? '-' }}</div>
    </div>
    @endif
</div>

<!-- Profile Info (Teacher) -->
@if($user->role === 'admin' && isset($profile) && $profile)
<div class="section-card">
    <h3 class="section-title">{{ __('messages.sa_teacher_profile') }}</h3>
    <div class="info-grid">
        <div class="info-item">
            <div class="label">{{ __('messages.sa_full_name') }}</div>
            <div class="value">{{ $profile->full_name }}</div>
        </div>
        <div class="info-item">
            <div class="label">{{ __('messages.sa_phone') }}</div>
            <div class="value">{{ $profile->phone_number ?? '-' }}</div>
        </div>
        <div class="info-item">
            <div class="label">{{ __('messages.sa_subject') }}</div>
            <div class="value">{{ $profile->teaching_subject ?? '-' }}</div>
        </div>
        <div class="info-item">
            <div class="label">{{ __('messages.sa_skills') }}</div>
            <div class="value">{{ is_array($profile->skills) ? implode(', ', $profile->skills) : '-' }}</div>
        </div>
    </div>
    @if($profile->bio)
    <div style="margin-top:1rem;">
        <div class="label" style="font-size:0.8rem; color:#64748B; margin-bottom:0.3rem;">{{ __('messages.sa_bio') }}</div>
        <p style="font-size:0.9rem; color:#475569;">{{ $profile->bio }}</p>
    </div>
    @endif
</div>
@endif

<!-- Student Stats -->
@if($user->role === 'student' && isset($stats) && $stats)
<div class="section-card">
    <h3 class="section-title">{{ __('messages.sa_learning_stats') }}</h3>
    <div class="info-grid">
        <div class="info-item">
            <div class="label">{{ __('messages.sa_days_learning') }}</div>
            <div class="value">{{ $stats->days_learning }}</div>
        </div>
        <div class="info-item">
            <div class="label">{{ __('messages.sa_hours_studied') }}</div>
            <div class="value">{{ $stats->hours_studied }}</div>
        </div>
        <div class="info-item">
            <div class="label">{{ __('messages.sa_attendance') }}</div>
            <div class="value">{{ $stats->attendance_rate }}%</div>
        </div>
        <div class="info-item">
            <div class="label">{{ __('messages.sa_weekly_goal') }}</div>
            <div class="value">{{ $stats->weekly_goal_current }}/{{ $stats->weekly_goal_total }}</div>
        </div>
    </div>
</div>
@endif

<!-- Recent Lessons -->
<div class="section-card">
    <h3 class="section-title">{{ __('messages.sa_recent_lessons') }}</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>{{ __('messages.sa_date') }}</th>
                <th>{{ __('messages.sa_type') }}</th>
                <th>{{ $user->role === 'admin' ? __('messages.sa_student') : __('messages.sa_teacher') }}</th>
                <th>{{ __('messages.sa_time') }}</th>
                <th>{{ __('messages.sa_status') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lessons as $lesson)
            <tr>
                <td>{{ $lesson->lesson_date->format('M d, Y') }}</td>
                <td>{{ $lesson->lesson_type }}</td>
                <td>{{ $user->role === 'admin' ? $lesson->student_name : ($lesson->teacher->name ?? '-') }}</td>
                <td>{{ \Carbon\Carbon::parse($lesson->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($lesson->end_time)->format('H:i') }}</td>
                <td><span class="status-badge status-{{ $lesson->status }}">{{ ucfirst($lesson->status) }}</span></td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; color:#94A3B8;">{{ __('messages.sa_no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Student Payments -->
@if($user->role === 'student' && isset($payments) && $payments->count() > 0)
<div class="section-card">
    <h3 class="section-title">{{ __('messages.sa_payment_history') }}</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>{{ __('messages.sa_date') }}</th>
                <th>{{ __('messages.sa_amount') }}</th>
                <th>{{ __('messages.sa_method') }}</th>
                <th>{{ __('messages.sa_description') }}</th>
                <th>{{ __('messages.sa_status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->payment_date->format('M d, Y') }}</td>
                <td>¥{{ number_format($payment->amount) }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->description }}</td>
                <td><span class="status-badge status-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
