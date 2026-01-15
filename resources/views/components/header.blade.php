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
        padding: 0.8rem 1rem;
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
        gap: 0.8rem;
    }
    
    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .logo img {
        height: 45px;
        width: auto;
    }
    
    .logo-text h1 {
        font-size: 1.4rem;
        font-weight: 800;
        color: #1F6FE5;
        margin: 0;
        line-height: 1.2;
    }
    
    .logo-text p {
        font-size: 0.65rem;
        color: #666666;
        margin: 0;
        font-weight: 400;
        line-height: 1.2;
    }
    
    .nav-buttons {
        display: flex;
        gap: 0.6rem;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
        font-size: 0.9rem;
        white-space: nowrap;
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
        gap: 0.2rem;
        background: #F5F5F5;
        padding: 0.25rem;
        border-radius: 50px;
    }
    
    .lang-btn {
        padding: 0.35rem 0.9rem;
        background: transparent;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 0.85rem;
        text-decoration: none;
        color: #666666;
        font-weight: 500;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .lang-btn.active {
        background: #00B86B;
        color: white;
        box-shadow: 0 2px 8px rgba(0,184,107,0.25);
    }
    
    /* Tablet */
    @media (max-width: 1024px) {
        .header-content {
            gap: 0.6rem;
        }
        
        .btn {
            padding: 0.5rem 1.2rem;
            font-size: 0.85rem;
        }
        
        .logo img {
            height: 40px;
        }
        
        .logo-text h1 {
            font-size: 1.2rem;
        }
        
        .logo-text p {
            font-size: 0.6rem;
        }
    }
    
    /* Mobile */
    @media (max-width: 768px) {
        .header {
            padding: 0.6rem 0.8rem;
        }
        
        .header-content {
            gap: 0.5rem;
        }
        
        .logo {
            gap: 8px;
        }
        
        .logo img {
            height: 35px;
        }
        
        .logo-text h1 {
            font-size: 1rem;
        }
        
        .logo-text p {
            font-size: 0.55rem;
        }
        
        .nav-buttons {
            width: 100%;
            justify-content: center;
            gap: 0.4rem;
        }
        
        .btn {
            padding: 0.45rem 1rem;
            font-size: 0.8rem;
        }
        
        .lang-btn {
            padding: 0.3rem 0.7rem;
            font-size: 0.75rem;
        }
    }
    
    /* Extra Small Mobile */
    @media (max-width: 480px) {
        .header {
            padding: 0.5rem 0.6rem;
        }
        
        .logo img {
            height: 30px;
        }
        
        .logo-text h1 {
            font-size: 0.9rem;
        }
        
        .logo-text p {
            display: none;
        }
        
        .btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
        }
        
        .btn-outline {
            display: none;
        }
        
        .lang-btn {
            padding: 0.25rem 0.6rem;
            font-size: 0.7rem;
        }
    }
</style>
