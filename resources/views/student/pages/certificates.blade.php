@extends('student.layouts.app')

@section('page-title', 'My Certificates')
@section('page-subtitle', 'Your achievements and completed certifications')

@section('styles')
<style>
    .certificates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }
    
    .certificate-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s;
        position: relative;
    }
    
    .certificate-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }
    
    .certificate-header {
        padding: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .certificate-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    
    .certificate-card:nth-child(1) .certificate-header {
        background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
    }
    
    .certificate-card:nth-child(2) .certificate-header {
        background: linear-gradient(135deg, #F093FB 0%, #F5576C 100%);
    }
    
    .certificate-card:nth-child(3) .certificate-header {
        background: linear-gradient(135deg, #4FACFE 0%, #00F2FE 100%);
    }
    
    .certificate-card:nth-child(4) .certificate-header {
        background: linear-gradient(135deg, #43E97B 0%, #38F9D7 100%);
    }
    
    .certificate-card:nth-child(5) .certificate-header {
        background: linear-gradient(135deg, #FA709A 0%, #FEE140 100%);
    }
    
    .certificate-card:nth-child(6) .certificate-header {
        background: linear-gradient(135deg, #30CFD0 0%, #330867 100%);
    }
    
    .certificate-icon {
        width: 64px;
        height: 64px;
        background: rgba(255,255,255,0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }
    
    .certificate-level {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .certificate-name {
        font-size: 1.1rem;
        font-weight: 600;
        opacity: 0.95;
        position: relative;
        z-index: 1;
    }
    
    .certificate-body {
        padding: 1.5rem 2rem 2rem 2rem;
    }
    
    .certificate-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #E2E8F0;
    }
    
    .info-item {
        text-align: center;
    }
    
    .info-label {
        font-size: 0.8rem;
        color: #94A3B8;
        margin-bottom: 0.25rem;
    }
    
    .info-value {
        font-size: 1rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .certificate-actions {
        display: flex;
        gap: 0.75rem;
    }
    
    .cert-btn {
        flex: 1;
        padding: 0.75rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: #00B86B;
        color: white;
    }
    
    .btn-primary:hover {
        background: #00A060;
        transform: translateY(-2px);
    }
    
    .btn-outline {
        background: white;
        color: #64748B;
        border: 2px solid #E2E8F0;
    }
    
    .btn-outline:hover {
        border-color: #00B86B;
        color: #00B86B;
    }
    
    .progress-section {
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
    
    .progress-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .progress-card {
        padding: 1.5rem;
        border: 2px dashed #E2E8F0;
        border-radius: 12px;
        text-align: center;
        transition: all 0.2s;
    }
    
    .progress-card:hover {
        border-color: #00B86B;
        background: #F0FDF4;
    }
    
    .progress-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .progress-title {
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.5rem;
    }
    
    .progress-text {
        color: #64748B;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    .progress-bar {
        height: 8px;
        background: #E2E8F0;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }
    
    .progress-fill {
        height: 100%;
        background: #00B86B;
        border-radius: 4px;
        transition: width 0.3s;
    }
    
    .progress-label {
        font-size: 0.8rem;
        color: #64748B;
    }
    
    @media (max-width: 768px) {
        .certificates-grid {
            grid-template-columns: 1fr;
        }
        
        .progress-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="progress-section">
    <h2 class="section-title">Next Certifications</h2>
    <div class="progress-grid">
        <div class="progress-card">
            <div class="progress-icon">📊</div>
            <h3 class="progress-title">C1 Advanced</h3>
            <p class="progress-text">Complete 20 more lessons</p>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 65%;"></div>
            </div>
            <p class="progress-label">65% Complete</p>
        </div>
        
        <div class="progress-card">
            <div class="progress-icon">💼</div>
            <h3 class="progress-title">Business English Advanced</h3>
            <p class="progress-text">Complete 12 more lessons</p>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 40%;"></div>
            </div>
            <p class="progress-label">40% Complete</p>
        </div>
        
        <div class="progress-card">
            <div class="progress-icon">🎯</div>
            <h3 class="progress-title">TOEIC Preparation</h3>
            <p class="progress-text">Complete 30 more lessons</p>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 20%;"></div>
            </div>
            <p class="progress-label">20% Complete</p>
        </div>
    </div>
</div>

<h2 class="section-title" style="margin-bottom: 1.5rem;">Earned Certificates</h2>

<div class="certificates-grid">
    @forelse($certificates as $index => $certificate)
        <div class="certificate-card">
            <div class="certificate-header">
                <div class="certificate-icon">🏆</div>
                <div class="certificate-level">{{ $certificate->level }}</div>
                <div class="certificate-name">{{ $certificate->certificate_name }}</div>
            </div>
            
            <div class="certificate-body">
                <div class="certificate-info">
                    <div class="info-item">
                        <div class="info-label">Completed</div>
                        <div class="info-value">{{ $certificate->completed_date ? \Carbon\Carbon::parse($certificate->completed_date)->format('M Y') : 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Type</div>
                        <div class="info-value">{{ $certificate->certificate_type ?? 'Standard' }}</div>
                    </div>
                </div>
                
                <div class="certificate-actions">
                    <button class="cert-btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Download
                    </button>
                    <button class="cert-btn btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="18" cy="5" r="3"></circle>
                            <circle cx="6" cy="12" r="3"></circle>
                            <circle cx="18" cy="19" r="3"></circle>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                        </svg>
                        Share
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: white; border-radius: 12px;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">🎓</div>
            <h3 style="color: #1E293B; margin-bottom: 0.5rem;">No certificates earned yet</h3>
            <p style="color: #94A3B8; margin-bottom: 1.5rem;">Complete lessons to earn your first certificate</p>
            <a href="{{ route('student.lessons.book') }}" style="display: inline-block; padding: 0.75rem 2rem; background: #00B86B; color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">Start Learning</a>
        </div>
    @endforelse
</div>
@endsection
