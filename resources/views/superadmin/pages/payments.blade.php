@extends('superadmin.layouts.app')

@section('page-title', __('messages.sa_payments'))
@section('page-subtitle', __('messages.sa_monitor_payments'))

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
    
    .filter-bar {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        background: white;
        color: #64748B;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .filter-btn:hover { border-color: #7C3AED; color: #7C3AED; }
    .filter-btn.active { background: #7C3AED; color: white; border-color: #7C3AED; }
    
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
    .status-pending { background: #FEF3C7; color: #D97706; }
    .status-failed { background: #FEE2E2; color: #DC2626; }
    .status-refunded { background: #E0E7FF; color: #4F46E5; }
    
    .amount { font-weight: 600; color: #16A34A; }
    
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
        <div class="value" style="color: #16A34A;">¥{{ number_format($totalRevenue) }}</div>
        <div class="label">{{ __('messages.sa_total_revenue') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value" style="color: #2563EB;">¥{{ number_format($revenueThisMonth) }}</div>
        <div class="label">{{ __('messages.sa_revenue_month') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value" style="color: #D97706;">¥{{ number_format($pendingPayments) }}</div>
        <div class="label">{{ __('messages.sa_pending_payments') }}</div>
    </div>
    <div class="mini-stat">
        <div class="value">{{ $totalTransactions }}</div>
        <div class="label">{{ __('messages.sa_total_transactions') }}</div>
    </div>
</div>

<!-- Filters -->
<div class="filter-bar">
    <a href="{{ route('superadmin.payments') }}" class="filter-btn {{ !$status ? 'active' : '' }}">{{ __('messages.sa_all') }}</a>
    <a href="{{ route('superadmin.payments', ['status' => 'completed']) }}" class="filter-btn {{ $status === 'completed' ? 'active' : '' }}">{{ __('messages.sa_completed') }}</a>
    <a href="{{ route('superadmin.payments', ['status' => 'pending']) }}" class="filter-btn {{ $status === 'pending' ? 'active' : '' }}">{{ __('messages.sa_pending') }}</a>
    <a href="{{ route('superadmin.payments', ['status' => 'failed']) }}" class="filter-btn {{ $status === 'failed' ? 'active' : '' }}">Failed</a>
    <a href="{{ route('superadmin.payments', ['status' => 'refunded']) }}" class="filter-btn {{ $status === 'refunded' ? 'active' : '' }}">Refunded</a>
</div>

<!-- Payments Table -->
<div class="section-card">
    <div class="section-header">
        <h3 class="section-title">{{ __('messages.sa_all_payments') }}</h3>
        <span style="font-size: 0.85rem; color: #64748B;">{{ $payments->count() }} {{ __('messages.sa_records') }}</span>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('messages.sa_student') }}</th>
                <th>{{ __('messages.sa_course') }}</th>
                <th>{{ __('messages.sa_amount') }}</th>
                <th>{{ __('messages.sa_method') }}</th>
                <th>{{ __('messages.sa_date') }}</th>
                <th>{{ __('messages.sa_status') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr>
                <td>#{{ $payment->id }}</td>
                <td>{{ $payment->student->name ?? '-' }}</td>
                <td>{{ $payment->course->name ?? '-' }}</td>
                <td class="amount">¥{{ number_format($payment->amount) }}</td>
                <td>{{ $payment->payment_method ?? '-' }}</td>
                <td>{{ $payment->payment_date ? $payment->payment_date->format('M d, Y') : '-' }}</td>
                <td><span class="status-badge status-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center; color:#94A3B8; padding:2rem;">{{ __('messages.sa_no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
