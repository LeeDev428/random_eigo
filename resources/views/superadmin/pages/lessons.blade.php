@extends('superadmin.layouts.app')

@section('page-title', __('messages.sa_all_lessons'))
@section('page-subtitle', __('messages.sa_monitor_lessons'))

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
    
    .filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        background: white;
        color: #64748B;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .filter-btn:hover { border-color: #7C3AED; color: #7C3AED; }
    .filter-btn.active { background: #7C3AED; color: white; border-color: #7C3AED; }
    
    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-left: auto;
    }
    
    .search-input {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        font-size: 0.9rem;
        outline: none;
        width: 250px;
    }
    
    .search-input:focus { border-color: #7C3AED; }
    
    .search-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: none;
        background: #7C3AED;
        color: white;
        cursor: pointer;
        font-size: 0.9rem;
    }
    
    .section-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
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
    
    .status-completed { background: #DCFCE7; color: #16A34A; }
    .status-scheduled { background: #DBEAFE; color: #2563EB; }
    .status-cancelled { background: #FEE2E2; color: #DC2626; }
    
    .count-label {
        color: #64748B;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .filters { flex-direction: column; }
        .search-box { margin-left: 0; width: 100%; }
        .search-input { width: 100%; }
    }
</style>
@endsection

@section('content')

<!-- Stats Row -->
<div class="stats-row">
    <div class="mini-stat">
        <div class="value">{{ $totalLessons }}</div>
        <div class="label">{{ __('messages.sa_total_lessons') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value" style="color: #16A34A;">{{ $completedLessons }}</div>
        <div class="label">{{ __('messages.sa_completed') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value" style="color: #2563EB;">{{ $scheduledLessons }}</div>
        <div class="label">{{ __('messages.sa_scheduled') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value" style="color: #DC2626;">{{ $cancelledLessons }}</div>
        <div class="label">{{ __('messages.sa_cancelled') }}</div>
    </div>
</div>

<!-- Filters -->
<div class="filters">
    <a href="{{ route('superadmin.lessons', ['status' => 'all', 'search' => $search]) }}" class="filter-btn {{ $status === 'all' ? 'active' : '' }}">{{ __('messages.sa_all') }}</a>
    <a href="{{ route('superadmin.lessons', ['status' => 'scheduled', 'search' => $search]) }}" class="filter-btn {{ $status === 'scheduled' ? 'active' : '' }}">{{ __('messages.sa_scheduled') }}</a>
    <a href="{{ route('superadmin.lessons', ['status' => 'completed', 'search' => $search]) }}" class="filter-btn {{ $status === 'completed' ? 'active' : '' }}">{{ __('messages.sa_completed') }}</a>
    <a href="{{ route('superadmin.lessons', ['status' => 'cancelled', 'search' => $search]) }}" class="filter-btn {{ $status === 'cancelled' ? 'active' : '' }}">{{ __('messages.sa_cancelled') }}</a>
    
    <form class="search-box" method="GET" action="{{ route('superadmin.lessons') }}">
        <input type="hidden" name="status" value="{{ $status }}">
        <input type="text" name="search" class="search-input" placeholder="{{ __('messages.sa_search_lessons') }}" value="{{ $search }}">
        <button type="submit" class="search-btn">{{ __('messages.sa_search') }}</button>
    </form>
</div>

<div class="section-card">
    <div class="count-label">{{ $lessons->count() }} {{ __('messages.sa_lessons_found') }}</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('messages.sa_date') }}</th>
                <th>{{ __('messages.sa_time') }}</th>
                <th>{{ __('messages.sa_student') }}</th>
                <th>{{ __('messages.sa_teacher') }}</th>
                <th>{{ __('messages.sa_type') }}</th>
                <th>{{ __('messages.level') }}</th>
                <th>{{ __('messages.sa_status') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lessons as $lesson)
            <tr>
                <td>#{{ $lesson->id }}</td>
                <td>{{ $lesson->lesson_date->format('M d, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($lesson->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($lesson->end_time)->format('H:i') }}</td>
                <td>{{ $lesson->student_name }}</td>
                <td>{{ $lesson->teacher->name ?? '-' }}</td>
                <td>{{ $lesson->lesson_type }}</td>
                <td>{{ $lesson->level }}</td>
                <td><span class="status-badge status-{{ $lesson->status }}">{{ ucfirst($lesson->status) }}</span></td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center; color:#94A3B8; padding:2rem;">{{ __('messages.sa_no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
