<header class="header">
    <div class="header-content">
        <div class="logo">
            <img src="{{ asset('icon/eigo.png') }}" alt="Random Eigo Logo">
            <div class="logo-text">
                <h1>Random Eigo</h1>
                <p>{{ __('messages.site_subtitle') }}</p>
            </div>
        </div>
        
        <div class="nav-buttons">
            <div class="lang-switcher">
                <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
                <a href="{{ route('lang.switch', 'ja') }}" class="lang-btn {{ app()->getLocale() == 'ja' ? 'active' : '' }}">日本語</a>
            </div>
            @if($showAuthButtons ?? true)
            <a href="{{ route('login') }}" class="btn btn-primary">{{ __('messages.login') }}</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">{{ __('messages.register') }}</a>
            <a href="#" class="btn btn-outline">{{ __('messages.free_trial') }}</a>
            @endif
        </div>
    </div>
</header>

<style>
    .header {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .logo img {
        height: 50px;
        width: auto;
    }
    
    .logo-text h1 {
        font-size: 1.5rem;
        color: #e74c3c;
        margin: 0;
    }
    
    .logo-text p {
        font-size: 0.75rem;
        color: #666;
        margin: 0;
    }
    
    .nav-buttons {
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    
    .btn {
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .btn-primary {
        background: #00b894;
        color: white;
    }
    
    .btn-primary:hover {
        background: #00a383;
    }
    
    .btn-secondary {
        background: #e74c3c;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #c0392b;
    }
    
    .btn-outline {
        background: white;
        color: #00b894;
        border: 2px solid #00b894;
    }
    
    .btn-outline:hover {
        background: #00b894;
        color: white;
    }
    
    .lang-switcher {
        display: flex;
        gap: 0.5rem;
    }
    
    .lang-btn {
        padding: 0.3rem 0.8rem;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        text-decoration: none;
        color: #333;
    }
    
    .lang-btn.active {
        background: #00b894;
        color: white;
        border-color: #00b894;
    }
    
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
