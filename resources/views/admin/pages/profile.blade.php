@extends('admin.layouts.app')

@section('page-title', __('messages.profile'))
@section('page-subtitle', date('l, F d, Y'))

@section('styles')
<style>
    .profile-container {
        max-width: 1000px;
    }
    
    .profile-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #F1F5F9;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #1E293B;
        font-size: 0.9rem;
    }
    
    .form-input,
    .form-textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }
    
    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #00B86B;
    }
    
    .form-textarea {
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
    }
    
    .form-input:disabled {
        background: #F8FAFC;
        color: #64748B;
    }
    
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .skill-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .skill-badge.teal {
        background: #CCFBF1;
        color: #0F766E;
    }
    
    .skill-badge.green {
        background: #D1FAE5;
        color: #059669;
    }
    
    .skill-badge.purple {
        background: #E9D5FF;
        color: #7C3AED;
    }
    
    .skill-badge.blue {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .skill-badge.orange {
        background: #FFEDD5;
        color: #EA580C;
    }
    
    .skill-badge.red {
        background: #FEE2E2;
        color: #DC2626;
    }
    
    .experience-item {
        padding: 1.25rem;
        background: #F8FAFC;
        border-radius: 8px;
        margin-bottom: 1rem;
        border-left: 3px solid #00B86B;
    }
    
    .experience-item:last-child {
        margin-bottom: 0;
    }
    
    .experience-title {
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .experience-company {
        color: #00B86B;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .experience-period {
        color: #64748B;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }
    
    .experience-description {
        color: #475569;
        font-size: 0.9rem;
    }
    
    .experience-description ul {
        margin: 0.5rem 0;
        padding-left: 1.5rem;
    }
    
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding-top: 1rem;
        border-top: 2px solid #F1F5F9;
    }
    
    .btn {
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }
    
    .btn-primary {
        background: #00B86B;
        color: white;
    }
    
    .btn-primary:hover {
        background: #00915A;
    }
    
    .btn-secondary {
        background: #F1F5F9;
        color: #64748B;
    }
    
    .btn-secondary:hover {
        background: #E2E8F0;
    }
    
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .profile-card {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Profile Information -->
        <div class="profile-card">
            <h3 class="section-title">Profile Information</h3>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input 
                        type="text" 
                        name="full_name" 
                        class="form-input" 
                        value="{{ $profile->full_name ?? $teacher->name }}"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-input" 
                        value="{{ $teacher->email }}"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input 
                        type="tel" 
                        name="phone_number" 
                        class="form-input" 
                        value="{{ $profile->phone_number ?? '' }}"
                    >
                </div>
                
                <div class="form-group">
                    <label class="form-label">Teaching Subject</label>
                    <input 
                        type="text" 
                        name="teaching_subject" 
                        class="form-input" 
                        value="{{ $profile->teaching_subject ?? 'English Language' }}"
                    >
                </div>
            </div>
        </div>
        
        <!-- Bio -->
        <div class="profile-card">
            <h3 class="section-title">Bio</h3>
            
            <div class="form-group">
                <textarea 
                    name="bio" 
                    class="form-textarea"
                    placeholder="Tell us about yourself, your teaching experience, and your approach to education..."
                >{{ $profile->bio ?? 'Passionate English educator with 5+ years of experience teaching business English, general English, kids lessons, exam preparation, and specialized courses. I hold a Master\'s degree in TESOL and am dedicated to creating engaging, student-centered learning environments.' }}</textarea>
            </div>
        </div>
        
        <!-- Skills & Specializations -->
        <div class="profile-card">
            <h3 class="section-title">Skills & Specializations</h3>
            
            <div class="skills-container">
                @php
                    $defaultSkills = ['Business English', 'General English', 'Kids Lesson', 'Exam Prep', 'Academic English', 'Medical English'];
                    $skills = $profile->skills ?? $defaultSkills;
                    $badgeColors = ['teal', 'green', 'purple', 'blue', 'orange', 'red'];
                @endphp
                
                @foreach($skills as $index => $skill)
                    <span class="skill-badge {{ $badgeColors[$index % count($badgeColors)] }}">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
            
            <input type="hidden" name="skills[]" value="Business English">
            <input type="hidden" name="skills[]" value="General English">
            <input type="hidden" name="skills[]" value="Kids Lesson">
            <input type="hidden" name="skills[]" value="Exam Prep">
            <input type="hidden" name="skills[]" value="Academic English">
            <input type="hidden" name="skills[]" value="Medical English">
        </div>
        
        <!-- Teaching Experience -->
        <div class="profile-card">
            <h3 class="section-title">Teaching Experience</h3>
            
            <div class="experience-item">
                <div class="experience-title">Senior English Teacher</div>
                <div class="experience-company">Random English Academy • Online</div>
                <div class="experience-period">2020 - Present</div>
                <div class="experience-description">
                    <ul>
                        <li>Teaching business English to corporate professionals from Fortune 500 companies</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="form-actions">
            <button type="button" class="btn btn-secondary" onclick="window.location.reload()">
                Cancel
            </button>
            <button type="submit" class="btn btn-primary">
                Save Changes
            </button>
        </div>
    </form>
</div>

@if(session('success'))
<script>
    alert('{{ session('success') }}');
</script>
@endif
@endsection
