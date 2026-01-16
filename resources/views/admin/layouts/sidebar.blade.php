<div class="sidebar">
    <!-- Logo -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('icon/eigo.png') }}" alt="Random Eigo">
            <div class="sidebar-logo-text">
                <h3>Random English</h3>
                <p>Teacher Dashboard</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">📊</span>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.schedule') }}" class="nav-item {{ request()->routeIs('admin.schedule') ? 'active' : '' }}">
            <span class="nav-icon">📅</span>
            <span>Schedule</span>
        </a>
        <a href="{{ route('admin.materials') }}" class="nav-item {{ request()->routeIs('admin.materials') ? 'active' : '' }}">
            <span class="nav-icon">📚</span>
            <span>Lesson Materials</span>
        </a>
        <a href="{{ route('admin.students') }}" class="nav-item {{ request()->routeIs('admin.students') ? 'active' : '' }}">
            <span class="nav-icon">👥</span>
            <span>Students</span>
        </a>
        <a href="{{ route('admin.accounts') }}" class="nav-item {{ request()->routeIs('admin.accounts') ? 'active' : '' }}">
            <span class="nav-icon">📈</span>
            <span>Accounts</span>
        </a>
        <a href="{{ route('admin.profile') }}" class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <span class="nav-icon">👤</span>
            <span>Profile</span>
        </a>
    </nav>
</div>
