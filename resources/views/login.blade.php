<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login_title') }} - Random Eigo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Hiragino Sans', 'Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            max-width: 1000px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
        }
        
        .left-panel {
            background: linear-gradient(135deg, #00b894 0%, #00a383 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        
        .left-panel img {
            height: 100px;
            margin-bottom: 2rem;
            filter: brightness(0) invert(1);
        }
        
        .left-panel h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .left-panel p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }
        
        .right-panel {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .form-header {
            margin-bottom: 2rem;
        }
        
        .form-header h2 {
            color: #2d3436;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        
        .lang-switcher {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        
        .lang-btn {
            padding: 0.4rem 1rem;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
        }
        
        .lang-btn.active {
            background: #00b894;
            color: white;
            border-color: #00b894;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2d3436;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #00b894;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .remember-me input {
            width: auto;
        }
        
        .forgot-link {
            color: #00b894;
            text-decoration: none;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
        }
        
        .btn {
            width: 100%;
            padding: 1rem;
            background: #00b894;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #00a383;
        }
        
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            color: #b2bec3;
            position: relative;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #dfe6e9;
        }
        
        .divider::before {
            left: 0;
        }
        
        .divider::after {
            right: 0;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #636e72;
        }
        
        .register-link a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .back-home {
            text-align: center;
            margin-top: 1rem;
        }
        
        .back-home a {
            color: #636e72;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .back-home a:hover {
            color: #2d3436;
        }
        
        .error {
            background: #ff7675;
            color: white;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
            }
            
            .left-panel {
                padding: 2rem;
            }
            
            .left-panel img {
                height: 60px;
            }
            
            .left-panel h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-panel">
            <img src="{{ asset('icon/eigo.png') }}" alt="Random Eigo Logo">
            <h1>Random Eigo</h1>
            <p>{{ __('messages.site_subtitle') }}</p>
        </div>
        
        <div class="right-panel">
            <div class="form-header">
                <h2>{{ __('messages.login_title') }}</h2>
                <div class="lang-switcher">
                    <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
                    <a href="{{ route('lang.switch', 'ja') }}" class="lang-btn {{ app()->getLocale() == 'ja' ? 'active' : '' }}">日本語</a>
                </div>
            </div>
            
            @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">{{ __('messages.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">{{ __('messages.password') }}</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>{{ __('messages.remember_me') }}</span>
                    </label>
                    <a href="#" class="forgot-link">{{ __('messages.forgot_password') }}</a>
                </div>
                
                <button type="submit" class="btn">{{ __('messages.login') }}</button>
            </form>
            
            <div class="divider">or</div>
            
            <div class="register-link">
                {{ __('messages.no_account') }}
                <a href="{{ route('register') }}">{{ __('messages.register') }}</a>
            </div>
            
            <div class="back-home">
                <a href="{{ route('home') }}">← Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
