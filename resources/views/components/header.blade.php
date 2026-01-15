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
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        position: sticky;
        top: 0;
        z-index: 100;
        backdrop-filter: blur(10px);
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
        height: 55px;
        width: auto;
    }
    
    .logo-text h1 {
        font-size: 1.6rem;
        font-weight: 800;
        background: linear-gradient(135deg, #00D98E 0%, #4A9DEC 50%, #FF7A3D 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }
    
    .logo-text p {
        font-size: 0.75rem;
        color: #6c757d;
        margin: 0;
        font-weight: 500;
    }
    
    .nav-buttons {
        display: flex;
        gap: 0.8rem;
        align-items: center;
    }
    
    .btn {
        padding: 0.6rem 1.6rem;
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
        background: linear-gradient(135deg, #00D98E 0%, #4A9DEC 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(0,217,142,0.2);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,217,142,0.3);
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #FF7A3D 0%, #FFD700 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(255,122,61,0.2);
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255,122,61,0.3);
    }
    
    .btn-outline {
        background: white;
        color: #4A9DEC;
        border: 2px solid #4A9DEC;
    }
    
    .btn-outline:hover {
        background: #4A9DEC;
        color: white;
        transform: translateY(-2px);
    }
    
    .lang-switcher {
        display: flex;
        gap: 0.4rem;
        background: #f8f9fa;
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
        color: #6c757d;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .lang-btn.active {
        background: linear-gradient(135deg, #00D98E 0%, #4A9DEC 100%);
        color: white;
        box-shadow: 0 2px 10px rgba(0,217,142,0.2);
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
