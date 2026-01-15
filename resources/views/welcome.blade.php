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
            min-height: 600px;
            padding: 3rem 2rem;
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
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .hero-highlight {
            display: inline;
            color: #FF8A00;
            font-size: 3.5rem;
            font-weight: 800;
        }
        
        .online-badge {
            display: inline-block;
            background: white;
            color: #FF8A00;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 2rem 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .age-box {
            background: white;
            display: inline-block;
            padding: 1rem 2rem;
            border-radius: 50px;
            margin-top: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .age-box strong {
            color: #222222;
            font-size: 1rem;
            display: block;
            margin-bottom: 0.3rem;
        }
        
        .age-box span {
            color: #222222;
            font-size: 1.1rem;
        }
        
        .features {
            max-width: 1200px;
            margin: -80px auto 4rem;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            position: relative;
            z-index: 3;
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
        
        .feature-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
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
        
        @media (max-width: 768px) {
            .hero {
                min-height: 500px;
            }
            
            .hero h2 {
                font-size: 2rem;
            }
            
            .hero-highlight {
                font-size: 2rem;
            }
            
            .online-badge {
                font-size: 1.3rem;
            }
            
            .features {
                margin-top: 2rem;
                gap: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <x-header :showAuthButtons="true" />
    
    <section class="hero">
        <div class="hero-content">
            <h2>
                Learning English<br>
                starts with<br>
                something <span class="hero-highlight">ランダム</span>
            </h2>
            
            <div class="online-badge">
                オンライン英会話
            </div>
            
            <div class="age-box">
                <strong>対象年齢</strong>
                <span>3才~小学生・中学生・高校生</span>
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
