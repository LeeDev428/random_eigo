@extends('admin.layouts.app')

@section('page-title', __('messages.accounts'))
@section('page-subtitle', date('l, F d, Y'))

@section('styles')
<style>
    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 2rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
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
    
    .stat-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    
    .stat-icon-wrapper.green {
        background: #D1FAE5;
        color: #059669;
    }
    
    .stat-icon-wrapper.red {
        background: #FEE2E2;
        color: #DC2626;
    }
    
    .stat-icon-wrapper.blue {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.3rem;
    }
    
    .stat-label {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 1.5rem;
    }
    
    .cancellation-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        margin-bottom: 2rem;
    }
    
    .cancellation-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .cancellation-item {
        display: flex;
        align-items: center;
        padding: 1.25rem;
        border-radius: 8px;
    }
    
    .cancellation-item.yellow {
        background: #FEF3C7;
    }
    
    .cancellation-item.red {
        background: #FEE2E2;
    }
    
    .cancellation-item.blue {
        background: #DBEAFE;
    }
    
    .cancel-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .cancel-icon.yellow {
        color: #F59E0B;
    }
    
    .cancel-icon.red {
        color: #DC2626;
    }
    
    .cancel-icon.blue {
        color: #2563EB;
    }
    
    .cancel-info {
        flex: 1;
    }
    
    .cancel-type {
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .cancel-reason {
        color: #64748B;
        font-size: 0.85rem;
    }
    
    .cancel-count {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .payment-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }
    
    .payment-card {
        background: linear-gradient(135deg, #00B86B 0%, #00915A 100%);
        padding: 2rem;
        border-radius: 12px;
        color: white;
        box-shadow: 0 4px 20px rgba(0,184,107,0.3);
    }
    
    .payment-label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
    }
    
    .payment-amount {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .payment-detail {
        font-size: 0.9rem;
        opacity: 0.85;
    }
    
    .pending-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
    }
    
    .pending-label {
        font-size: 0.9rem;
        color: #64748B;
        margin-bottom: 0.5rem;
    }
    
    .pending-amount {
        font-size: 2rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.5rem;
    }
    
    .pending-detail {
        font-size: 0.85rem;
        color: #64748B;
    }
    
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .payment-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .stat-number {
            font-size: 2rem;
        }
        
        .payment-amount {
            font-size: 2.5rem;
        }
    }
</style>
@endsection

@section('content')
<h2 class="page-title">December 2024 Statistics</h2>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon-wrapper green">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>
        <div class="stat-number">{{ $stats['lessons_completed'] }}</div>
        <div class="stat-label">Lessons Completed</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon-wrapper red">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </div>
        <div class="stat-number">{{ $stats['lessons_cancelled'] }}</div>
        <div class="stat-label">Lessons Cancelled</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon-wrapper blue">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 3v18h18"></path>
                <path d="m19 9-5 5-4-4-3 3"></path>
            </svg>
        </div>
        <div class="stat-number">{{ $stats['completion_rate'] }}%</div>
        <div class="stat-label">Completion Rate</div>
    </div>
</div>

<div class="cancellation-card">
    <h3 class="section-title">Cancellation Breakdown</h3>
    
    <div class="cancellation-list">
        <div class="cancellation-item yellow">
            <div class="cancel-icon yellow">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            
            <div class="cancel-info">
                <div class="cancel-type">Student Cancellations</div>
                <div class="cancel-reason">Within 24 hours notice</div>
            </div>
            
            <div class="cancel-count">{{ $stats['student_cancellations'] }}</div>
        </div>
        
        <div class="cancellation-item red">
            <div class="cancel-icon red">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            
            <div class="cancel-info">
                <div class="cancel-type">No-Show Students</div>
                <div class="cancel-reason">Did not attend scheduled lesson</div>
            </div>
            
            <div class="cancel-count">{{ $stats['no_show_students'] }}</div>
        </div>
        
        <div class="cancellation-item blue">
            <div class="cancel-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            
            <div class="cancel-info">
                <div class="cancel-type">Teacher Cancellations</div>
                <div class="cancel-reason">Personal/emergency reasons</div>
            </div>
            
            <div class="cancel-count">{{ $stats['teacher_cancellations'] }}</div>
        </div>
    </div>
</div>

<h3 class="section-title">Payment Summary</h3>

<div class="payment-grid">
    <div class="payment-card">
        <div class="payment-label">Total Earnings (Dec 2024)</div>
        <div class="payment-amount">${{ number_format($stats['total_earnings']) }}</div>
        <div class="payment-detail">
            {{ $stats['lessons_completed'] }} completed lessons × ${{ $stats['price_per_lesson'] }}/lesson
        </div>
    </div>
    
    <div class="pending-card">
        <div class="pending-label">Pending Payment</div>
        <div class="pending-amount">${{ number_format($stats['pending_payment']) }}</div>
        <div class="pending-detail">Cancelled lessons requiring refund</div>
    </div>
</div>
@endsection
