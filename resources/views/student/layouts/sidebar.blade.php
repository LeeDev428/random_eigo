<div class="sidebar">
    <!-- Logo -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="background: #FF8A00; padding: 8px; border-radius: 8px;"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
            </div>
            <div class="sidebar-logo-text">
                <h3>SpeakEasy</h3>
                <p>English Academy</p>
            </div>
        </div>
    </div>
    
    <!-- User Profile -->
    <div class="user-profile">
        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="user-details">
                <h4>{{ Auth::user()->name }}</h4>
                <p>Intermediate Level</p>
            </div>
        </div>
        <div class="progress-bar">
            <div class="progress-label">
                <span>{{ __('messages.course_progress') }}</span>
                <span>{{ isset($stats) && $stats->weekly_goal_total > 0 ? round(($stats->weekly_goal_current / $stats->weekly_goal_total) * 100) : 75 }}%</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" style="width: {{ isset($stats) && $stats->weekly_goal_total > 0 ? round(($stats->weekly_goal_current / $stats->weekly_goal_total) * 100) : 75 }}%"></div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="sidebar-nav">
        <a href="{{ route('student.dashboard') }}" class="nav-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
            <span>{{ __('messages.dashboard') }}</span>
        </a>
        <a href="{{ route('student.lessons.book') }}" class="nav-item {{ request()->routeIs('student.lessons.book') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
            <span>{{ __('messages.book_lesson') }}</span>
        </a>
        <a href="{{ route('student.courses') }}" class="nav-item {{ request()->routeIs('student.courses') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="7.5 4.21 12 6.81 16.5 4.21"/><polyline points="7.5 19.79 7.5 14.6 3 12"/><polyline points="21 12 16.5 14.6 16.5 19.79"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" x2="12" y1="22.08" y2="12"/></svg>
            <span>{{ __('messages.courses_payment') }}</span>
        </a>
        <a href="{{ route('student.lessons.history') }}" class="nav-item {{ request()->routeIs('student.lessons.history') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>{{ __('messages.lesson_history') }}</span>
        </a>
        <a href="{{ route('student.materials') }}" class="nav-item {{ request()->routeIs('student.materials') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            <span>{{ __('messages.materials') }}</span>
        </a>
        <a href="{{ route('student.certificates') }}" class="nav-item {{ request()->routeIs('student.certificates') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
            <span>{{ __('messages.certificates') }}</span>
        </a>
        <a href="{{ route('student.profile') }}" class="nav-item {{ request()->routeIs('student.profile') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <span>{{ __('messages.my_profile') }}</span>
        </a>
        <a href="{{ route('student.contact') }}" class="nav-item {{ request()->routeIs('student.contact') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <span>{{ __('messages.contact_us') }}</span>
        </a>
        
        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" id="logout-form-student" style="margin-top: 1rem;">
            @csrf
            <button type="button" onclick="confirmLogout('student')" class="nav-item" style="width: 100%; background: none; border: none; text-align: left;">
                <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                <span>{{ __('messages.logout') }}</span>
            </button>
        </form>
    </nav>
</div>

<script>
function confirmLogout(role) {
    if (confirm('{{ __('messages.confirm_logout') }}')) {
        document.getElementById('logout-form-' + role).submit();
    }
}
</script>
