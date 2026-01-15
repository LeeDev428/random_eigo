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
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
        gap: 12px;
    }
    
    .logo img {
        height: 50px;
        width: auto;
    }
    
    .logo-text h1 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1F6FE5;
        margin: 0;
    }
    
    .logo-text p {
        font-size: 0.7rem;
        color: #666666;
        margin: 0;
        font-weight: 400;
    }
    
    .nav-buttons {
        display: flex;
        gap: 0.8rem;
        align-items: center;
    }
    
    .btn {
        padding: 0.6rem 1.8rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
        font-size: 0.95rem;
    }
    
    .btn-primary {
        background: #00B86B;
        color: white;
        box-shadow: 0 3px 12px rgba(0,184,107,0.25);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 18px rgba(0,184,107,0.35);
        background: #00a05d;
    }
    
    .btn-secondary {
        background: #FF8A00;
        color: white;
        box-shadow: 0 3px 12px rgba(255,138,0,0.25);
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 18px rgba(255,138,0,0.35);
        background: #e67d00;
    }
    
    .btn-outline {
        background: white;
        color: #222222;
        border: 2px solid #CCCCCC;
    }
    
    .btn-outline:hover {
        background: #F5F5F5;
        border-color: #1F6FE5;
        color: #1F6FE5;
        transform: translateY(-2px);
    }
    
    .lang-switcher {
        display: flex;
        gap: 0.3rem;
        background: #F5F5F5;
        padding: 0.3rem;
        border-radius: 50px;
    }
    
    .lang-btn {
        padding: 0.4rem 1rem;
        background: transparent;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 0.9rem;
        text-decoration: none;
        color: #666666;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .lang-btn.active {
        background: #00B86B;
        color: white;
        box-shadow: 0 2px 8px rgba(0,184,107,0.25);
    }
    
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
        }
        
        .nav-buttons {
            flex-wrap: wrap;
            justify-content: center;
        }
    }
</style>
