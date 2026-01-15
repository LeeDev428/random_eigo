<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.register_title') }} - Random Eigo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Hiragino Sans', 'Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
            background: #F5F5F5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .register-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .register-container {
            background: white;
            border-radius: 25px;
            box-shadow: 0 10px 50px rgba(0,0,0,0.08);
            max-width: 1000px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
        }
        
        .left-panel {
            background: linear-gradient(135deg, #FF8A00 0%, #FFD400 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .left-panel::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><polygon fill="white" fill-opacity="0.05" points="50,10 90,90 10,90"/></svg>');
        }
        
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(50px, 50px) rotate(360deg); }
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
            padding: 0.9rem 1.2rem;
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #222222;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #FF8A00;
            background: white;
            box-shadow: 0 0 0 3px rgba(255,138,0,0.1);
        }
        
        .btn {
            width: 100%;
            padding: 1rem;
            background: #FF8A00;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255,138,0,0.25);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,138,0,0.35);
            background: #e67d00;
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
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #636e72;
        }
        
        .login-link a {
            color: #1F6FE5;
            text-decoration: none;
            font-weight: 700;
        }
        
        .login-link a:hover {
            text-decoration: underline;
            color: #00B86B;
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
            .register-container {
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
    <x-header :showAuthButtons="false" />
    
    <div class="register-wrapper">
        <div class="register-container">
            <div class="left-panel">
                <img src="{{ asset('icon/eigo.png') }}" alt="Random Eigo Logo">
                <h1>Random Eigo</h1>
                <p>{{ __('messages.site_subtitle') }}</p>
            </div>
            
            <div class="right-panel">
                <div class="form-header">
                    <h2>{{ __('messages.register_title') }}</h2>
                </div>
                
                @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">{{ __('messages.name') }}</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">{{ __('messages.email') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">{{ __('messages.password') }}</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('messages.password_confirmation') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    
                    <button type="submit" class="btn">{{ __('messages.register') }}</button>
                </form>
                
                <div class="divider">or</div>
                
                <div class="login-link">
                    {{ __('messages.have_account') }}
                    <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
                </div>
                
                <div class="back-home">
                    <a href="{{ route('home') }}">← Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
