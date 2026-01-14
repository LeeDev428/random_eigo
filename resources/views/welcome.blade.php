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
            color: #333;
        }
        
        .hero {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 4rem 2rem;
            text-align: center;
        }
        
        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .hero h2 {
            color: #2d3436;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .hero-highlight {
            display: inline-block;
            background: #00b894;
            color: white;
            padding: 0.5rem 2rem;
            border-radius: 10px;
            font-size: 2.5rem;
            margin: 1rem 0;
        }
        
        .age-box {
            background: white;
            display: inline-block;
            padding: 1rem 2rem;
            border-radius: 10px;
            margin-top: 1rem;
        }
        
        .age-box strong {
            color: #e74c3c;
        }
        
        .features {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-card h3 {
            color: #00b894;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .feature-card p {
            color: #666;
            line-height: 1.8;
        }
        
        .cta-section {
            background: #fff9e6;
            padding: 3rem 2rem;
            text-align: center;
        }
        
        .cta-box {
            background: white;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        
        .cta-box h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: #2d3436;
        }
        
        .cta-box .btn {
            font-size: 1.2rem;
            padding: 1rem 3rem;
            background: #00b894;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .cta-box .btn:hover {
            background: #00a383;
        }
        
        .footer {
            background: #2d3436;
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .hero h2 {
                font-size: 1.8rem;
            }
            
            .hero-highlight {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <x-header :showAuthButtons="true" />
    
    <section class="hero">
        <div class="hero-content">
            <h2>{{ __('messages.hero_title') }}</h2>
            <div class="hero-highlight">{{ __('messages.hero_subtitle') }}</div>
            
            <div class="age-box">
                <strong>{{ __('messages.target_age') }}</strong><br>
                {{ __('messages.age_range') }}
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
