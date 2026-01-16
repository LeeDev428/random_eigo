@extends('student.layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back! Ready to continue learning?')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .stat-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #718096;
        font-size: 0.95rem;
    }
    
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
    }
    
    .section-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
    }
    
    .lesson-item {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        border: 2px solid #E2E8F0;
        border-radius: 12px;
        margin-bottom: 1rem;
    }
    
    .lesson-avatar {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .lesson-avatar.green {
        background: linear-gradient(135deg, #00B86B 0%, #00915A 100%);
    }
    
    .lesson-details {
        flex: 1;
    }
    
    .lesson-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
    }
    
    .lesson-teacher {
        color: #718096;
        font-size: 0.9rem;
    }
    
    .lesson-time {
        text-align: right;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .time-label {
        font-size: 0.85rem;
        color: #718096;
    }
    
    .time-value {
        font-size: 1rem;
        font-weight: 600;
    }
    
    .lesson-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .btn {
        padding: 0.5rem 1.2rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-primary {
        background: #3B82F6;
        color: white;
    }
    
    .btn-primary:hover {
        background: #2563EB;
    }
    
    .btn-outline {
        background: white;
        color: #E53E3E;
        border: 2px solid #E53E3E;
    }
    
    .btn-outline:hover {
        background: #FEE;
    }
    
    .quick-actions {
        background: #2D3748;
        color: white;
    }
    
    .quick-actions .section-title {
        color: white;
        margin-bottom: 1.5rem;
    }
    
    .action-item {
        background: #4A5568;
        padding: 1.2rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        display: flex;
        gap: 1rem;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        color: white;
    }
    
    .action-item:hover {
        background: #5A6778;
        transform: translateX(5px);
    }
    
    .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    
    .action-icon.orange {
        background: #FF8A00;
    }
    
    .action-icon.blue {
        background: #3B82F6;
    }
    
    .action-icon.green {
        background: #00B86B;
    }
    
    .action-content h4 {
        font-size: 1rem;
        margin-bottom: 0.2rem;
    }
    
    .action-content p {
        font-size: 0.85rem;
        color: #CBD5E0;
    }
    
    @media (max-width: 1200px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background: #EBF5FF;">
                    📖
                </div>
                <div class="stat-badge" style="background: #C3F4D8; color: #00B86B;">
                    Active
                </div>
            </div>
            <div class="stat-value">24</div>
            <div class="stat-label">Lessons Completed</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background: #FFF3E0;">
                    ⏱️
                </div>
                <div class="stat-badge" style="background: #E0F2FE; color: #3B82F6;">
                    36 hrs
                </div>
            </div>
            <div class="stat-value">8</div>
            <div class="stat-label">Credits Remaining</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background: #E8F5E9;">
                    ✅
                </div>
                <div class="stat-badge" style="background: #FEF3C7; color: #D97706;">
                    +2
                </div>
            </div>
            <div class="stat-value">3</div>
            <div class="stat-label">Certificates Earned</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background: #EDE9FE;">
                    📈
                </div>
                <div class="stat-badge" style="background: #DBEAFE; color: #3B82F6;">
                    B2
                </div>
            </div>
            <div class="stat-value">B1+</div>
            <div class="stat-label">Current Level</div>
        </div>
    </div>
    
    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Upcoming Lessons -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">Upcoming Lessons</h2>
            </div>
            
            <div class="lesson-item">
                <div class="lesson-avatar">JM</div>
                <div class="lesson-details">
                    <div class="lesson-title">Business English Conversation</div>
                    <div class="lesson-teacher">with James Miller</div>
                </div>
                <div class="lesson-time">
                    <div class="time-label">Tomorrow</div>
                    <div class="time-value">10:00 AM</div>
                </div>
                <div class="lesson-actions">
                    <button class="btn btn-primary">Join</button>
                    <button class="btn btn-outline">Cancel</button>
                </div>
            </div>
            
            <div class="lesson-item">
                <div class="lesson-avatar green">EW</div>
                <div class="lesson-details">
                    <div class="lesson-title">Grammar Workshop</div>
                    <div class="lesson-teacher">with Emma Wilson</div>
                </div>
                <div class="lesson-time">
                    <div class="time-label">Jan 15</div>
                    <div class="time-value">2:00 PM</div>
                </div>
                <div class="lesson-actions">
                    <button class="btn btn-primary">Details</button>
                    <button class="btn btn-outline">Cancel</button>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="section-card quick-actions">
            <h2 class="section-title">Quick Actions</h2>
            
            <a href="{{ route('student.lessons.book') }}" class="action-item">
                <div class="action-icon orange">
                    ➕
                </div>
                <div class="action-content">
                    <h4>Book New Lesson</h4>
                    <p>Find available teachers</p>
                </div>
            </a>
            
            <a href="{{ route('student.materials') }}" class="action-item">
                <div class="action-icon blue">
                    📥
                </div>
                <div class="action-content">
                    <h4>Download Materials</h4>
                    <p>Access course resources</p>
                </div>
            </a>
            
            <a href="{{ route('student.contact') }}" class="action-item">
                <div class="action-icon green">
                    💬
                </div>
                <div class="action-content">
                    <h4>Get Help</h4>
                    <p>Contact support team</p>
                </div>
            </a>
        </div>
    </div>
@endsection
