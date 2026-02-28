@extends('superadmin.layouts.app')

@section('page-title', __('messages.sa_courses'))
@section('page-subtitle', __('messages.sa_courses_enrollments'))

@section('styles')
<style>
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .mini-stat {
        background: white;
        padding: 1.25rem;
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
    }
    
    .mini-stat .value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .mini-stat .label {
        font-size: 0.8rem;
        color: #64748B;
        margin-top: 0.2rem;
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
    
    .data-table tr:hover { background: #FAFAFA; }
    
    .status-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-active { background: #DBEAFE; color: #2563EB; }
    .status-completed { background: #DCFCE7; color: #16A34A; }
    .status-cancelled { background: #FEE2E2; color: #DC2626; }
    
    .active-badge { background: #DCFCE7; color: #16A34A; }
    .inactive-badge { background: #FEE2E2; color: #DC2626; }
    
    @media (max-width: 768px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')

<!-- Stats -->
<div class="stats-row">
    <div class="mini-stat">
        <div class="value">{{ $totalCourses }}</div>
        <div class="label">{{ __('messages.sa_total_courses') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value" style="color: #16A34A;">{{ $activeCourses }}</div>
        <div class="label">{{ __('messages.sa_active_courses') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value">{{ $totalEnrollments }}</div>
        <div class="label">{{ __('messages.sa_total_enrollments') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value" style="color: #2563EB;">{{ $activeEnrollments }}</div>
        <div class="label">{{ __('messages.sa_active_enrollments') }}</div>
    </div>
</div>

<!-- Courses -->
<div class="section-card">
    <h3 class="section-title">{{ __('messages.sa_all_courses') }}</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.sa_type') }}</th>
                <th>{{ __('messages.sa_price') }}</th>
                <th>{{ __('messages.sa_duration') }}</th>
                <th>{{ __('messages.sa_enrollments') }}</th>
                <th>{{ __('messages.sa_status') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
            <tr>
                <td>#{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->course_type }}</td>
                <td>¥{{ number_format($course->price) }}</td>
                <td>{{ $course->duration ?? '-' }}</td>
                <td>{{ $course->enrollments_count }}</td>
                <td><span class="status-badge {{ $course->is_active ? 'active-badge' : 'inactive-badge' }}">{{ $course->is_active ? __('messages.active') : 'Inactive' }}</span></td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center; color:#94A3B8; padding:2rem;">{{ __('messages.sa_no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Enrollments -->
<div class="section-card">
    <h3 class="section-title">{{ __('messages.sa_all_enrollments') }}</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('messages.sa_student') }}</th>
                <th>{{ __('messages.sa_course') }}</th>
                <th>{{ __('messages.sa_enrolled_date') }}</th>
                <th>{{ __('messages.sa_credits') }}</th>
                <th>{{ __('messages.sa_status') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
            <tr>
                <td>#{{ $enrollment->id }}</td>
                <td>{{ $enrollment->student->name ?? '-' }}</td>
                <td>{{ $enrollment->course->name ?? '-' }}</td>
                <td>{{ $enrollment->enrolled_date->format('M d, Y') }}</td>
                <td>{{ $enrollment->credits_used }}/{{ $enrollment->credits_purchased }}</td>
                <td><span class="status-badge status-{{ $enrollment->status }}">{{ ucfirst($enrollment->status) }}</span></td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center; color:#94A3B8; padding:2rem;">{{ __('messages.sa_no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
