<div class="sidebar">
    <!-- Logo -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="background: #7C3AED; padding: 8px; border-radius: 8px;"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <div class="sidebar-logo-text">
                <h3>Random English</h3>
                <p>{{ __('messages.sa_panel') }}</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="sidebar-nav">
        <a href="{{ route('superadmin.dashboard') }}" class="nav-item {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
            <span>{{ __('messages.dashboard') }}</span>
        </a>
        <a href="{{ route('superadmin.users') }}" class="nav-item {{ request()->routeIs('superadmin.users*') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <span>{{ __('messages.sa_users') }}</span>
        </a>
        <a href="{{ route('superadmin.lessons') }}" class="nav-item {{ request()->routeIs('superadmin.lessons') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
            <span>{{ __('messages.sa_all_lessons') }}</span>
        </a>
        <a href="{{ route('superadmin.courses') }}" class="nav-item {{ request()->routeIs('superadmin.courses') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            <span>{{ __('messages.sa_courses') }}</span>
        </a>
        <a href="{{ route('superadmin.payments') }}" class="nav-item {{ request()->routeIs('superadmin.payments') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="20" y2="10"/><line x1="18" x2="18" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="16"/></svg>
            <span>{{ __('messages.sa_payments') }}</span>
        </a>
        <a href="{{ route('superadmin.materials') }}" class="nav-item {{ request()->routeIs('superadmin.materials') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <span>{{ __('messages.sa_materials') }}</span>
        </a>
        
        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" id="logout-form-superadmin" style="margin-top: 1rem;">
            @csrf
            <button type="button" onclick="confirmLogout('superadmin')" class="nav-item" style="width: 100%; background: none; border: none; text-align: left;">
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
