<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Dashboard') - Random Eigo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Hiragino Sans', sans-serif;
            background: #F5F5F5;
            color: #222222;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #2D3748;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar-logo img {
            width: 40px;
            height: 40px;
        }
        
        .sidebar-logo-text h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
        }
        
        .sidebar-logo-text p {
            font-size: 0.75rem;
            color: #A0AEC0;
        }
        
        .user-profile {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }
        
        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #00B86B;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .user-details h4 {
            font-size: 1rem;
            margin-bottom: 0.2rem;
        }
        
        .user-details p {
            font-size: 0.85rem;
            color: #A0AEC0;
        }
        
        .progress-bar {
            margin-top: 0.5rem;
        }
        
        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            margin-bottom: 0.3rem;
            color: #A0AEC0;
        }
        
        .progress-track {
            height: 8px;
            background: #4A5568;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #FF8A00 0%, #FFD400 100%);
            border-radius: 10px;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .nav-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #A0AEC0;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .nav-item:hover {
            background: rgba(255,255,255,0.05);
            color: white;
        }
        
        .nav-item.active {
            background: #3B82F6;
            color: white;
        }
        
        .nav-icon {
            font-size: 1.2rem;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
        }
        
        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .topbar-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        
        .topbar-title p {
            color: #718096;
            font-size: 0.95rem;
        }
        
        .topbar-right {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .notification-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #F7FAFC;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background: #E53E3E;
            border-radius: 50%;
            color: white;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .date-display {
            text-align: right;
        }
        
        .date-display .day {
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .date-display .date {
            color: #718096;
            font-size: 0.85rem;
        }
        
        .language-switcher {
            display: flex;
            align-items: center;
        }
        
        .lang-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            background: #F7FAFC;
            border-radius: 8px;
            text-decoration: none;
            color: #4A5568;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .lang-btn:hover {
            background: #EDF2F7;
        }
        
        .content-area {
            padding: 2rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .topbar {
                padding: 1rem;
            }
            
            .content-area {
                padding: 1rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('student.layouts.sidebar')
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="topbar-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-subtitle', 'Welcome back! Ready to continue learning?')</p>
                </div>
                <div class="topbar-right">
                    <!-- Language Switcher -->
                    <div class="language-switcher">
                        <a href="{{ route('lang.switch', app()->getLocale() == 'en' ? 'ja' : 'en') }}" class="lang-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                            <span>{{ app()->getLocale() == 'en' ? '日本語' : 'English' }}</span>
                        </a>
                    </div>
                    
                    <button class="notification-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="date-display">
                        <div class="day">{{ __('messages.today') }}</div>
                        <div class="date">{{ date('D, M d') }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>
    
    @yield('scripts')
</body>
</html>
