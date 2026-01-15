<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.site_title') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Hiragino Sans', 'Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
            line-height: 1.6;
            color: #222222;
            background: #FFFFFF;
        }
        
        .hero {
            background: linear-gradient(to right, rgba(135, 206, 250, 0.7) 0%, rgba(173, 216, 230, 0.6) 100%), url('{{ asset('eigolandingpageimage.jpg') }}') center/cover;
            min-height: 500px;
            padding: 3rem 2rem 2rem;
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(135, 206, 250, 0.3) 0%, rgba(173, 216, 230, 0.2) 50%, rgba(255, 255, 255, 0.1) 100%);
            pointer-events: none;
        }
        
        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            text-align: left;
            width: 100%;
        }
        
        .hero h2 {
            color: #1F6FE5;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .hero-highlight {
            display: inline;
            color: #FF8A00;
            font-size: 3rem;
            font-weight: 800;
        }
        
        .online-badge {
            display: inline-block;
            background: white;
            color: #FF8A00;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 1.2rem 0 0.8rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .age-box {
            background: white;
            display: inline-block;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            margin-top: 0.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .age-box strong {
            color: #222222;
            font-size: 0.85rem;
            display: block;
            margin-bottom: 0.2rem;
            font-weight: 600;
        }
        
        .age-box span {
            color: #222222;
            font-size: 0.9rem;
        }
        
        .features {
            max-width: 1200px;
            margin: 3rem auto 4rem;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            position: relative;
        }
        
        .feature-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        }
        
        .feature-card:nth-child(1) h3 { color: #00B86B; }
        .feature-card:nth-child(2) h3 { color: #1F6FE5; }
        .feature-card:nth-child(3) h3 { color: #FF8A00; }
        
        .feature-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .feature-card p {
            color: #666666;
            line-height: 1.8;
            font-size: 1rem;
        }
        
        .cta-section {
            background: #F5F5F5;
            padding: 5rem 2rem;
            text-align: center;
        }
        
        .cta-box {
            background: white;
            max-width: 800px;
            margin: 0 auto;
            padding: 4rem 3rem;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
        
        .cta-box h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #222222;
        }
        
        .cta-box .btn {
            font-size: 1.3rem;
            padding: 1.2rem 4rem;
            background: #FF8A00;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            display: inline-block;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 6px 25px rgba(255,138,0,0.3);
        }
        
        .cta-box .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 35px rgba(255,138,0,0.4);
            background: #e67d00;
        }
        
        .footer {
            background: #222222;
            color: white;
            padding: 3rem;
            text-align: center;
        }
        
        /* Tablet */
        @media (max-width: 1024px) {
            .hero h2 {
                font-size: 2.5rem;
            }
            
            .hero-highlight {
                font-size: 2.5rem;
            }
            
            .online-badge {
                font-size: 1.2rem;
                padding: 0.5rem 1.3rem;
            }
            
            .age-box {
                padding: 0.5rem 1.3rem;
            }
            
            .features {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.5rem;
            }
        }
        
        /* Mobile */
        @media (max-width: 768px) {
            .hero {
                min-height: auto;
                padding: 2rem 1rem 2rem;
            }
            
            .hero h2 {
                font-size: 1.6rem;
            }
            
            .hero-highlight {
                font-size: 1.6rem;
            }
            
            .online-badge {
                font-size: 1rem;
                padding: 0.45rem 1.2rem;
                margin: 1rem 0 0.6rem;
            }
            
            .age-box {
                padding: 0.5rem 1.2rem;
            }
            
            .age-box strong {
                font-size: 0.75rem;
            }
            
            .age-box span {
                font-size: 0.8rem;
            }
            
            .features {
                margin: 2rem auto 3rem;
                padding: 0 1rem;
                grid-template-columns: 1fr;
                gap: 1.5rem;
                z-index: 3;
            }
            
            .feature-card {
                padding: 2rem 1.5rem;
            }
            
            .feature-card h3 {
                font-size: 1.4rem;
            }
            
            .feature-card p {
                font-size: 0.9rem;
            }
            
            .cta-section {
                padding: 3rem 1rem;
            }
            
            .cta-box {
                padding: 2.5rem 1.5rem;
            }
            
            .cta-box h3 {
                font-size: 1.4rem;
            }
            
            .cta-box .btn {
                font-size: 1rem;
                padding: 1rem 2.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .hero {
                padding: 1.5rem 0.8rem 2rem;
            }
            
            .hero h2 {
                font-size: 1.3rem;
            }
            
            .hero-highlight {
                font-size: 1.3rem;
            }
            
            .online-badge {
                font-size: 0.9rem;
                padding: 0.4rem 1rem;
            }
            
            .age-box {
                padding: 0.45rem 1rem;
            }
            
            .age-box strong {
                font-size: 0.7rem;
            }
            
            .age-box span {
                font-size: 0.75rem;
            }
            
            .features {
                margin: 1.5rem auto 2rem;
                padding: 0 0.8rem;
            }
            
            .feature-card {
                padding: 1.5rem 1.2rem;
            }
            
            .feature-card h3 {
                font-size: 1.2rem;
            }
            
            .feature-card p {
                font-size: 0.85rem;
            }
            
            .cta-box {
                padding: 2rem 1.2rem;
            }
            
            .cta-box h3 {
                font-size: 1.2rem;
            }
            
            .cta-box .btn {
                font-size: 0.95rem;
                padding: 0.9rem 2rem;
            }
        }
    </style>
</head>
<body>
    <x-header :showAuthButtons="true" />
    
    <section class="hero">
        <div class="hero-content">
            <h2>
                {{ __('messages.hero_title') }}<br>
                <span class="hero-highlight">{{ __('messages.hero_subtitle') }}</span>
            </h2>
            
            <div class="online-badge">
                {{ __('messages.online_english_conversation') }}
            </div>
            
            <div class="age-box">
                <strong>{{ __('messages.target_age') }}</strong>
                <span>{{ __('messages.age_range') }}</span>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="feature-card">
            <h3>{{ __('messages.feature_1_title') }}</h3>
            <p>{!! __('messages.feature_1_desc') !!}</p>
        </div>
        
        <div class="feature-card">
            <h3>{{ __('messages.feature_2_title') }}</h3>
            <p>{!! __('messages.feature_2_desc') !!}</p>
        </div>

        <div class="feature-card">
            <h3>{{ __('messages.feature_3_title') }}</h3>
            <p>{!! __('messages.feature_3_desc') !!}</p>
        </div>
    </section>
    
    <section class="cta-section">
        <div class="cta-box">
            <h3>{{ __('messages.cta_title') }}</h3>
            <a href="{{ route('register') }}" class="btn">{{ __('messages.cta_button') }}</a>
        </div>
    </section>
    
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Random Eigo. All rights reserved.</p>
    </footer>
</body>
</html>
