@extends('superadmin.layouts.app')

@section('page-title', __('messages.dashboard'))
@section('page-subtitle', __('messages.sa_overview'))

@section('styles')
<style>
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
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
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
        color: #1E293B;
        line-height: 1;
    }
    
    .stat-label {
        color: #64748B;
        font-size: 0.85rem;
    }
    
    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .section-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E293B;
        margin: 0;
    }
    
    .view-all-link {
        color: #7C3AED;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .view-all-link:hover {
        text-decoration: underline;
    }
    
    /* Table */
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
    
    .role-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .role-admin { background: #E0F7EE; color: #00B86B; }
    .role-student { background: #DBEAFE; color: #3B82F6; }
    
    .full-width {
        grid-column: 1 / -1;
    }
    
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon" style="background: #EDE9FE;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_teachers'] }}</div>
        <div class="stat-label">{{ __('messages.sa_total_teachers') }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon" style="background: #DBEAFE;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_students'] }}</div>
        <div class="stat-label">{{ __('messages.total_students') }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon" style="background: #DCFCE7;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_lessons'] }}</div>
        <div class="stat-label">{{ __('messages.sa_total_lessons') }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon" style="background: #FEF3C7;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="20" y2="10"/><line x1="18" x2="18" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="16"/></svg>
            </div>
        </div>
        <div class="stat-value">¥{{ number_format($stats['total_revenue']) }}</div>
        <div class="stat-label">{{ __('messages.sa_total_revenue') }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon" style="background: #E0F7EE;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00B86B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 12 20 22 4 22 4 12"/><rect width="20" height="5" x="2" y="7" rx="1"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_courses'] }}</div>
        <div class="stat-label">{{ __('messages.sa_active_courses') }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon" style="background: #FEE2E2;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_materials'] }}</div>
        <div class="stat-label">{{ __('messages.sa_total_materials') }}</div>
    </div>
</div>

<!-- Lesson Breakdown -->
<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));">
    <div class="stat-card">
        <div class="stat-value" style="color: #16A34A; font-size: 1.5rem;">{{ $stats['completed_lessons'] }}</div>
        <div class="stat-label">{{ __('messages.sa_completed') }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: #2563EB; font-size: 1.5rem;">{{ $stats['scheduled_lessons'] }}</div>
        <div class="stat-label">{{ __('messages.sa_scheduled') }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: #DC2626; font-size: 1.5rem;">{{ $stats['cancelled_lessons'] }}</div>
        <div class="stat-label">{{ __('messages.sa_cancelled') }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: #7C3AED; font-size: 1.5rem;">{{ $stats['active_enrollments'] }}</div>
        <div class="stat-label">{{ __('messages.sa_active_enrollments') }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: #D97706; font-size: 1.5rem;">¥{{ number_format($stats['revenue_this_month']) }}</div>
        <div class="stat-label">{{ __('messages.sa_revenue_month') }}</div>
    </div>
</div>

<!-- Recent Activity -->
<div class="content-grid">
    <!-- Recent Lessons -->
    <div class="section-card">
        <div class="section-header">
            <h3 class="section-title">{{ __('messages.sa_recent_lessons') }}</h3>
            <a href="{{ route('superadmin.lessons') }}" class="view-all-link">{{ __('messages.view_all') }}</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>{{ __('messages.sa_student') }}</th>
                    <th>{{ __('messages.sa_teacher') }}</th>
                    <th>{{ __('messages.sa_date') }}</th>
                    <th>{{ __('messages.sa_status') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLessons as $lesson)
                <tr>
                    <td>{{ $lesson->student_name }}</td>
                    <td>{{ $lesson->teacher->name ?? '-' }}</td>
                    <td>{{ $lesson->lesson_date->format('M d') }}</td>
                    <td><span class="status-badge status-{{ $lesson->status }}">{{ ucfirst($lesson->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:#94A3B8;">{{ __('messages.sa_no_data') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Recent Payments -->
    <div class="section-card">
        <div class="section-header">
            <h3 class="section-title">{{ __('messages.sa_recent_payments') }}</h3>
            <a href="{{ route('superadmin.payments') }}" class="view-all-link">{{ __('messages.view_all') }}</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>{{ __('messages.sa_student') }}</th>
                    <th>{{ __('messages.sa_amount') }}</th>
                    <th>{{ __('messages.sa_date') }}</th>
                    <th>{{ __('messages.sa_status') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPayments as $payment)
                <tr>
                    <td>{{ $payment->student->name ?? '-' }}</td>
                    <td>¥{{ number_format($payment->amount) }}</td>
                    <td>{{ $payment->payment_date->format('M d') }}</td>
                    <td><span class="status-badge status-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:#94A3B8;">{{ __('messages.sa_no_data') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Recent Users -->
    <div class="section-card full-width">
        <div class="section-header">
            <h3 class="section-title">{{ __('messages.sa_recent_users') }}</h3>
            <a href="{{ route('superadmin.users') }}" class="view-all-link">{{ __('messages.view_all') }}</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.sa_role') }}</th>
                    <th>{{ __('messages.sa_joined') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="role-badge role-{{ $user->role }}">{{ $user->role === 'admin' ? 'Teacher' : ucfirst($user->role) }}</span></td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:#94A3B8;">{{ __('messages.sa_no_data') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
