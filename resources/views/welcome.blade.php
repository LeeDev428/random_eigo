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
            color: #2c3e50;
            background: #f8f9fa;
        }
        
        .hero {
            background: linear-gradient(135deg, #00D98E 0%, #4A9DEC 100%);
            padding: 5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect fill="white" fill-opacity="0.03" width="50" height="50" x="0" y="0"/><rect fill="white" fill-opacity="0.03" width="50" height="50" x="50" y="50"/></svg>');
            pointer-events: none;
        }
        
        .hero-content {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .hero h2 {
            color: white;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .hero-highlight {
            display: inline-block;
            background: rgba(255,255,255,0.95);
            color: #FF7A3D;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            font-size: 2rem;
            font-weight: 700;
            margin: 1.5rem 0;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .age-box {
            background: rgba(255,255,255,0.9);
            display: inline-block;
            padding: 1.2rem 2.5rem;
            border-radius: 50px;
            margin-top: 2rem;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
        
        .age-box strong {
            color: #FF7A3D;
            font-size: 1.1rem;
        }
        
        .features {
            max-width: 1100px;
            margin: 4rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
        }
        
        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-color: #00D98E;
        }
        
        .feature-card:nth-child(1) h3 { color: #00D98E; }
        .feature-card:nth-child(2) h3 { color: #4A9DEC; }
        .feature-card:nth-child(3) h3 { color: #FF7A3D; }
        
        .feature-card h3 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
        }
        
        .feature-card p {
            color: #6c757d;
            line-height: 1.8;
            font-size: 1.05rem;
        }
        
        .cta-section {
            background: linear-gradient(135deg, #FFD700 0%, #FF7A3D 100%);
            padding: 4rem 2rem;
            text-align: center;
            margin: 3rem 0;
        }
        
        .cta-box {
            background: rgba(255,255,255,0.95);
            max-width: 700px;
            margin: 0 auto;
            padding: 3rem;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }
        
        .cta-box h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #2c3e50;
        }
        
        .cta-box .btn {
            font-size: 1.2rem;
            padding: 1.2rem 3.5rem;
            background: linear-gradient(135deg, #00D98E 0%, #4A9DEC 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            display: inline-block;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0,217,142,0.3);
        }
        
        .cta-box .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,217,142,0.4);
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            padding: 2.5rem;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .hero h2 {
                font-size: 2rem;
            }
            
            .hero-highlight {
                font-size: 1.5rem;
            }
            
            .features {
                gap: 1.5rem;
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
