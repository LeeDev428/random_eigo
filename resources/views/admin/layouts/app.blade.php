<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Random Eigo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Hiragino Sans', sans-serif;
            background: #F7FAFC;
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
            transition: transform 0.3s ease;
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
        
        .logo-icon {
            flex-shrink: 0;
        }
        
        .sidebar-logo-text h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 0.2rem;
        }
        
        .sidebar-logo-text p {
            font-size: 0.8rem;
            color: #64748B;
        }
        
        .sidebar-nav {
            padding: 1.5rem 1rem;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.875rem 1rem;
            border-radius: 8px;
            color: #64748B;
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }
        
        .nav-item:hover {
            background: #F8FAFC;
            color: #1E293B;
        }
        
        .nav-item.active {
            background: #E0F7EE;
            color: #00B86B;
            font-weight: 600;
        }
        
        .nav-icon {
            flex-shrink: 0;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            transition: margin-left 0.3s ease;
        }
        
        /* Topbar */
        .topbar {
            background: white;
            border-bottom: 1px solid #E2E8F0;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .topbar-left h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 0.2rem;
        }
        
        .topbar-left p {
            font-size: 0.9rem;
            color: #64748B;
        }
        
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .language-switcher {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .lang-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            text-decoration: none;
            color: #64748B;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .lang-btn:hover {
            background: white;
            border-color: #00B86B;
            color: #00B86B;
        }
        
        .notification-btn {
            position: relative;
            padding: 0.5rem;
            background: #F8FAFC;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .notification-btn:hover {
            background: #E2E8F0;
        }
        
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: #EF4444;
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.4rem;
            border-radius: 10px;
            font-weight: 700;
        }
        
        /* Content Area */
        .content {
            padding: 2rem;
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            padding: 0.5rem;
            cursor: pointer;
        }
        
        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .topbar {
                padding: 1rem;
            }
            
            .content {
                padding: 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .topbar-left h1 {
                font-size: 1.25rem;
            }
            
            .topbar-right {
                gap: 0.5rem;
            }
            
            .lang-btn span {
                display: none;
            }
            
            .content {
                padding: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .topbar {
                padding: 0.75rem;
            }
            
            .topbar-left h1 {
                font-size: 1.1rem;
            }
            
            .topbar-left p {
                font-size: 0.8rem;
            }
        }
        
        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        .sidebar-overlay.active {
            display: block;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="topbar-left">
                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                    </button>
                    <div>
                        <h1>@yield('page-title', __('messages.dashboard'))</h1>
                        <p>@yield('page-subtitle', date('l, F d, Y'))</p>
                    </div>
                </div>
                <div class="topbar-right">
                    <!-- Language Switcher -->
                    <div class="language-switcher">
                        <a href="{{ route('lang.switch', app()->getLocale() == 'en' ? 'ja' : 'en') }}" class="lang-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                            <span>{{ app()->getLocale() == 'en' ? 'English' : '日本語' }}</span>
                        </a>
                    </div>
                    
                    <!-- Notifications -->
                    <button class="notification-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                        <span class="notification-badge">3</span>
                    </button>
                </div>
            </div>
            
            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    
    <script>
        // Mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const sidebar = document.querySelector('.sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-open');
                sidebarOverlay.classList.toggle('active');
            });
            
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('mobile-open');
                sidebarOverlay.classList.remove('active');
            });
        }
    </script>
    
    @yield('scripts')
</body>
</html>
