@extends('student.layouts.app')

@section('page-title', 'My Profile')
@section('page-subtitle', 'Manage your personal information and learning preferences')

@section('styles')
<style>
    .profile-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    
    .profile-section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #E2E8F0;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .edit-btn {
        padding: 0.5rem 1rem;
        border: 2px solid #00B86B;
        background: white;
        color: #00B86B;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .edit-btn:hover {
        background: #00B86B;
        color: white;
    }
    
    .form-grid {
        display: grid;
        gap: 1.5rem;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
    }
    
    .form-input {
        padding: 0.875rem;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.2s;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #00B86B;
        box-shadow: 0 0 0 3px rgba(0,184,107,0.1);
    }
    
    .form-input:disabled {
        background: #F8FAFC;
        cursor: not-allowed;
    }
    
    .save-btn {
        padding: 0.875rem 2rem;
        border: none;
        background: #00B86B;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 1rem;
    }
    
    .save-btn:hover {
        background: #00A060;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,184,107,0.3);
    }
    
    .stats-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    
    .stats-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 1.5rem;
    }
    
    .stat-item {
        margin-bottom: 1.5rem;
    }
    
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    .stat-value {
        font-weight: 700;
        color: #1E293B;
        font-size: 1.1rem;
    }
    
    .stat-bar {
        height: 8px;
        background: #E2E8F0;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .stat-fill {
        height: 100%;
        background: linear-gradient(90deg, #00B86B 0%, #00D87E 100%);
        border-radius: 4px;
        transition: width 0.3s;
    }
    
    .weekly-goal {
        background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
        padding: 1.5rem;
        border-radius: 12px;
        color: white;
        margin-bottom: 1.5rem;
    }
    
    .goal-label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
    }
    
    .goal-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .goal-bar {
        height: 8px;
        background: rgba(255,255,255,0.3);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }
    
    .goal-fill {
        height: 100%;
        background: white;
        border-radius: 4px;
    }
    
    .goal-text {
        font-size: 0.85rem;
        opacity: 0.9;
    }
    
    .quick-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .quick-stat {
        text-align: center;
        padding: 1rem;
        background: #F8FAFC;
        border-radius: 8px;
    }
    
    .quick-stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .quick-stat-label {
        font-size: 0.8rem;
        color: #64748B;
    }
    
    .security-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #E2E8F0;
    }
    
    .security-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
    }
    
    .security-info h4 {
        font-weight: 600;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .security-info p {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    .change-btn {
        padding: 0.5rem 1rem;
        border: 1px solid #E2E8F0;
        background: white;
        color: #64748B;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .change-btn:hover {
        border-color: #00B86B;
        color: #00B86B;
    }
    
    @media (max-width: 1024px) {
        .profile-layout {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="profile-layout">
    <div>
        <div class="profile-section">
            <div class="section-header">
                <h2 class="section-title">Personal Information</h2>
                <button class="edit-btn">Edit Profile</button>
            </div>
            
            <form class="form-grid">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-input" value="{{ auth()->user()->name }}" disabled>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-input" value="{{ auth()->user()->email }}" disabled>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-input" value="+81 90-1234-5678" disabled>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-input" value="Tokyo, Japan" disabled>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Time Zone</label>
                    <input type="text" class="form-input" value="Asia/Tokyo (GMT+9)" disabled>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Language Preference</label>
                    <select class="form-input" disabled>
                        <option>English</option>
                        <option>日本語</option>
                    </select>
                </div>
                
                <button type="submit" class="save-btn" style="display: none;">Save Changes</button>
            </form>
            
            <div class="security-section">
                <h3 style="font-weight: 700; color: #1E293B; margin-bottom: 1rem;">Account Security</h3>
                
                <div class="security-item">
                    <div class="security-info">
                        <h4>Password</h4>
                        <p>Last changed 3 months ago</p>
                    </div>
                    <button class="change-btn">Change Password</button>
                </div>
                
                <div class="security-item">
                    <div class="security-info">
                        <h4>Two-Factor Authentication</h4>
                        <p>Add an extra layer of security</p>
                    </div>
                    <button class="change-btn">Enable</button>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <div class="stats-card">
            <h3 class="stats-title">Learning Statistics</h3>
            
            <div class="quick-stats">
                <div class="quick-stat">
                    <div class="quick-stat-value">{{ $stats->days_learning ?? 156 }}</div>
                    <div class="quick-stat-label">Days Learning</div>
                </div>
                <div class="quick-stat">
                    <div class="quick-stat-value">{{ $stats->hours_studied ?? 36 }}h</div>
                    <div class="quick-stat-label">Hours Studied</div>
                </div>
            </div>
            
            <div class="weekly-goal">
                <div class="goal-label">Weekly Goal</div>
                <div class="goal-value">{{ $stats->weekly_goal_current ?? 4 }}/{{ $stats->weekly_goal_total ?? 5 }} lessons</div>
                <div class="goal-bar">
                    <div class="goal-fill" style="width: {{ (($stats->weekly_goal_current ?? 4) / ($stats->weekly_goal_total ?? 5)) * 100 }}%;"></div>
                </div>
                <div class="goal-text">Keep it up! You're almost there!</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-header">
                    <span class="stat-label">Attendance Rate</span>
                    <span class="stat-value">{{ $stats->attendance_rate ?? 92 }}%</span>
                </div>
                <div class="stat-bar">
                    <div class="stat-fill" style="width: {{ $stats->attendance_rate ?? 92 }}%;"></div>
                </div>
            </div>
            
            <div class="stat-item">
                <div class="stat-header">
                    <span class="stat-label">Current Streak</span>
                    <span class="stat-value">12 days</span>
                </div>
                <div class="stat-bar">
                    <div class="stat-fill" style="width: 80%;"></div>
                </div>
            </div>
        </div>
        
        <div class="stats-card">
            <h3 class="stats-title">Learning Level</h3>
            
            <div style="text-align: center; padding: 1rem 0;">
                <div style="font-size: 3rem; font-weight: 700; color: #00B86B; margin-bottom: 0.5rem;">
                    B1+
                </div>
                <p style="color: #64748B; margin-bottom: 1.5rem;">Intermediate</p>
                
                <div class="stat-bar" style="margin-bottom: 0.5rem;">
                    <div class="stat-fill" style="width: 70%;"></div>
                </div>
                <p style="color: #64748B; font-size: 0.85rem;">70% progress to B2</p>
            </div>
        </div>
    </div>
</div>
@endsection
