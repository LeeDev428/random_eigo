@extends('student.layouts.app')

@section('page-title', 'Courses & Payment')
@section('page-subtitle', 'Choose your plan and continue your learning journey')

@section('styles')
<style>
    .tabs {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        background: white;
        padding: 0.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .tab {
        flex: 1;
        padding: 0.75rem 1.5rem;
        border: none;
        background: transparent;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        color: #64748B;
    }
    
    .tab.active {
        background: #00B86B;
        color: white;
    }
    
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .course-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        position: relative;
    }
    
    .popular-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.4rem 1rem;
        background: #FEF3C7;
        color: #D97706;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    
    .course-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }
    
    .course-card:nth-child(1) .course-icon {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .course-card:nth-child(2) .course-icon {
        background: #D1FAE5;
        color: #059669;
    }
    
    .course-card:nth-child(3) .course-icon {
        background: #FCE7F3;
        color: #BE185D;
    }
    
    .course-card:nth-child(4) .course-icon {
        background: #E0E7FF;
        color: #6366F1;
    }
    
    .course-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.5rem;
    }
    
    .course-credits {
        color: #64748B;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }
    
    .course-price {
        font-size: 2rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .course-price-unit {
        font-size: 0.9rem;
        color: #64748B;
        margin-bottom: 1.5rem;
    }
    
    .course-features {
        list-style: none;
        padding: 0;
        margin-bottom: 1.5rem;
    }
    
    .course-features li {
        padding: 0.5rem 0;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .enroll-btn {
        width: 100%;
        padding: 0.875rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-primary {
        background: #00B86B;
        color: white;
    }
    
    .btn-primary:hover {
        background: #00A060;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,184,107,0.3);
    }
    
    .btn-outline {
        background: white;
        color: #00B86B;
        border: 2px solid #00B86B;
    }
    
    .btn-outline:hover {
        background: #F0FDF4;
    }
    
    .payment-section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 1.5rem;
    }
    
    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .payment-method {
        padding: 1.5rem;
        border: 2px solid #E2E8F0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }
    
    .payment-method:hover {
        border-color: #00B86B;
        background: #F0FDF4;
    }
    
    .payment-method.selected {
        border-color: #00B86B;
        background: #ECFDF5;
    }
    
    .payment-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .payment-name {
        font-weight: 600;
        color: #1E293B;
    }
    
    .payment-history-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .payment-history-table thead {
        background: #F8FAFC;
    }
    
    .payment-history-table th,
    .payment-history-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #E2E8F0;
    }
    
    .payment-history-table th {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .status-completed {
        background: #D1FAE5;
        color: #059669;
    }
    
    .status-pending {
        background: #FEF3C7;
        color: #D97706;
    }
    
    @media (max-width: 768px) {
        .courses-grid {
            grid-template-columns: 1fr;
        }
        
        .payment-methods {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="tabs">
    <button class="tab active">Course Plans</button>
    <button class="tab">Payment History</button>
</div>

<div class="courses-grid">
    @foreach($courses as $index => $course)
        <div class="course-card">
            @if($index == 1)
                <div class="popular-badge">POPULAR</div>
            @endif
            
            <div class="course-icon">
                @if($index == 0) 📚
                @elseif($index == 1) 🚀
                @elseif($index == 2) 💎
                @else 🎯
                @endif
            </div>
            
            <h3 class="course-name">{{ $course->name }}</h3>
            <p class="course-credits">{{ $course->duration ?? '10 credits' }}</p>
            
            <div class="course-price">¥{{ number_format($course->price) }}</div>
            <div class="course-price-unit">per month</div>
            
            <ul class="course-features">
                @php
                    $features = is_array($course->features) ? $course->features : json_decode($course->features ?? '[]', true);
                @endphp
                @foreach($features ?? [] as $feature)
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00B86B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{ $feature }}
                    </li>
                @endforeach
            </ul>
            
            <button class="enroll-btn {{ $index == 1 ? 'btn-primary' : 'btn-outline' }}">
                {{ $index == 1 ? 'Choose Plan' : 'Enroll Now' }}
            </button>
        </div>
    @endforeach
</div>

<div class="payment-section">
    <h2 class="section-title">Payment Method</h2>
    
    <div class="payment-methods">
        <div class="payment-method selected">
            <div class="payment-icon">💳</div>
            <div class="payment-name">Credit Card</div>
        </div>
        <div class="payment-method">
            <div class="payment-icon">🏦</div>
            <div class="payment-name">Bank Transfer</div>
        </div>
        <div class="payment-method">
            <div class="payment-icon">💰</div>
            <div class="payment-name">PayPal</div>
        </div>
    </div>
</div>

<div class="payment-section">
    <h2 class="section-title">Payment History</h2>
    
    <table class="payment-history-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->created_at->format('M d, Y') }}</td>
                    <td>{{ $payment->course ? $payment->course->name : 'Course Purchase' }}</td>
                    <td>¥{{ number_format($payment->amount) }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($payment->status) }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 2rem; color: #94A3B8;">
                        No payment history yet
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
