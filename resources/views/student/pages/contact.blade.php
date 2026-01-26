@extends('student.layouts.app')

@section('page-title', 'Contact Us')
@section('page-subtitle', 'Get in touch with our support team')

@section('styles')
<style>
    .contact-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    
    .contact-form-section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 1.5rem;
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
    
    .required {
        color: #EF4444;
    }
    
    .form-input,
    .form-select,
    .form-textarea {
        padding: 0.875rem;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.2s;
        font-family: inherit;
    }
    
    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #00B86B;
        box-shadow: 0 0 0 3px rgba(0,184,107,0.1);
    }
    
    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }
    
    .submit-btn {
        padding: 1rem 2rem;
        border: none;
        background: #00B86B;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .submit-btn:hover {
        background: #00A060;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,184,107,0.3);
    }
    
    .info-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .info-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .info-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 1.5rem;
    }
    
    .info-item {
        display: flex;
        align-items: start;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .info-item:last-child {
        margin-bottom: 0;
    }
    
    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .icon-blue {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .icon-green {
        background: #D1FAE5;
        color: #059669;
    }
    
    .icon-purple {
        background: #E0E7FF;
        color: #6366F1;
    }
    
    .info-content h4 {
        font-weight: 600;
        color: #1E293B;
        margin-bottom: 0.25rem;
    }
    
    .info-content p {
        color: #64748B;
        font-size: 0.9rem;
    }
    
    .faq-card {
        background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
        padding: 2rem;
        border-radius: 12px;
        color: white;
        text-align: center;
    }
    
    .faq-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .faq-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .faq-text {
        opacity: 0.9;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }
    
    .faq-btn {
        padding: 0.75rem 1.5rem;
        border: 2px solid white;
        background: transparent;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .faq-btn:hover {
        background: white;
        color: #667EEA;
    }
    
    .response-time {
        background: #F0FDF4;
        border: 1px solid #86EFAC;
        padding: 1rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    
    .response-time-icon {
        color: #00B86B;
    }
    
    .response-time-text {
        color: #166534;
        font-size: 0.9rem;
    }
    
    @media (max-width: 1024px) {
        .contact-layout {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="contact-layout">
    <div class="contact-form-section">
        <h2 class="section-title">Send us a message</h2>
        
        <div class="response-time">
            <svg class="response-time-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <span class="response-time-text">We typically respond within 24 hours</span>
        </div>
        
        <form class="form-grid" method="POST" action="{{ route('student.contact.send') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">
                    Name <span class="required">*</span>
                </label>
                <input type="text" name="name" class="form-input" value="{{ auth()->user()->name }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Email Address <span class="required">*</span>
                </label>
                <input type="email" name="email" class="form-input" value="{{ auth()->user()->email }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Subject <span class="required">*</span>
                </label>
                <select name="subject" class="form-select" required>
                    <option value="">Select a topic...</option>
                    <option value="technical">Technical Support</option>
                    <option value="billing">Billing & Payment</option>
                    <option value="lessons">Lesson Scheduling</option>
                    <option value="account">Account Management</option>
                    <option value="feedback">Feedback & Suggestions</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Message <span class="required">*</span>
                </label>
                <textarea name="message" class="form-textarea" placeholder="Please describe your inquiry in detail..." required></textarea>
            </div>
            
            <button type="submit" class="submit-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
                Send Message
            </button>
        </form>
    </div>
    
    <div class="info-sidebar">
        <div class="info-card">
            <h3 class="info-title">Contact Information</h3>
            
            <div class="info-item">
                <div class="info-icon icon-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div class="info-content">
                    <h4>Email</h4>
                    <p>support@randomeigo.com</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon icon-green">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="info-content">
                    <h4>Support Hours</h4>
                    <p>Mon-Fri: 9:00 AM - 6:00 PM (JST)</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon icon-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                </div>
                <div class="info-content">
                    <h4>Live Chat</h4>
                    <p>Available during support hours</p>
                </div>
            </div>
        </div>
        
        <div class="faq-card">
            <div class="faq-icon">💡</div>
            <h3 class="faq-title">Need Quick Answers?</h3>
            <p class="faq-text">Check out our FAQ section for instant help with common questions</p>
            <button class="faq-btn">View FAQ</button>
        </div>
    </div>
</div>
@endsection
