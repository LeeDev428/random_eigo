<div class="sidebar">
    <!-- Logo -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('icon/eigo.png') }}" alt="Random Eigo">
            <div class="sidebar-logo-text">
                <h3>Random Eigo</h3>
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
                <span>Course Progress</span>
                <span>75%</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" style="width: 75%"></div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="sidebar-nav">
        <a href="{{ route('student.dashboard') }}" class="nav-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">📊</span>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('student.lessons.book') }}" class="nav-item {{ request()->routeIs('student.lessons.book') ? 'active' : '' }}">
            <span class="nav-icon">📅</span>
            <span>Book a Lesson</span>
        </a>
        <a href="{{ route('student.courses') }}" class="nav-item {{ request()->routeIs('student.courses') ? 'active' : '' }}">
            <span class="nav-icon">🎓</span>
            <span>Courses & Payment</span>
        </a>
        <a href="{{ route('student.lessons.history') }}" class="nav-item {{ request()->routeIs('student.lessons.history') ? 'active' : '' }}">
            <span class="nav-icon">📝</span>
            <span>Lesson History</span>
        </a>
        <a href="{{ route('student.materials') }}" class="nav-item {{ request()->routeIs('student.materials') ? 'active' : '' }}">
            <span class="nav-icon">📚</span>
            <span>Materials</span>
        </a>
        <a href="{{ route('student.certificates') }}" class="nav-item {{ request()->routeIs('student.certificates') ? 'active' : '' }}">
            <span class="nav-icon">🎖️</span>
            <span>Certificates</span>
        </a>
        <a href="{{ route('student.profile') }}" class="nav-item {{ request()->routeIs('student.profile') ? 'active' : '' }}">
            <span class="nav-icon">👤</span>
            <span>My Profile</span>
        </a>
        <a href="{{ route('student.contact') }}" class="nav-item {{ request()->routeIs('student.contact') ? 'active' : '' }}">
            <span class="nav-icon">💬</span>
            <span>Contact Us</span>
        </a>
    </nav>
</div>
