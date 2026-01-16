<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Teacher Dashboard') - Random Eigo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Hiragino Sans', sans-serif;
            background: #F8FAFC;
            color: #1E293B;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 260px;
            background: white;
            border-right: 1px solid #E2E8F0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
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
            color: #00B86B;
        }
        
        .sidebar-logo-text p {
            font-size: 0.75rem;
            color: #64748B;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .nav-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #64748B;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .nav-item:hover {
            background: #F1F5F9;
            color: #00B86B;
        }
        
        .nav-item.active {
            background: #E0F7EE;
            color: #00B86B;
            border-left: 3px solid #00B86B;
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
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
            color: #64748B;
            font-size: 0.9rem;
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
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
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
            background: #F8FAFC;
            border-radius: 8px;
            text-decoration: none;
            color: #475569;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
            border: 1px solid #E2E8F0;
        }
        
        .lang-btn:hover {
            background: #F1F5F9;
        }
        
        .content-area {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background: #EF4444;
            border-radius: 50%;
            color: white;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
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
        @include('admin.layouts.sidebar')
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="topbar-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-subtitle', date('l, F d, Y'))</p>
                </div>
                <div class="topbar-right">
                    <!-- Language Switcher -->
                    <div class="language-switcher">
                        <a href="{{ route('lang.switch', app()->getLocale() == 'en' ? 'ja' : 'en') }}" class="lang-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                            <span>{{ app()->getLocale() == 'en' ? '日本語' : 'English' }}</span>
                        </a>
                    </div>
                    
                    <button class="notification-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                        <span class="notification-badge">2</span>
                    </button>
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
