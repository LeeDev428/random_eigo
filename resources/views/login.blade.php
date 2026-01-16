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
            background: #F5F5F5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .login-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-container {
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
            background: linear-gradient(135deg, #1F6FE5 0%, #00B86B 100%);
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
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle fill="white" fill-opacity="0.05" cx="50" cy="50" r="40"/></svg>');
        }
        
        @keyframes float {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
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
            border-color: #1F6FE5;
            background: white;
            box-shadow: 0 0 0 3px rgba(31,111,229,0.1);
        }
        
        .password-wrapper {
            position: relative;
        }
        
        .password-wrapper input {
            padding-right: 3rem;
        }
        
        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #64748B;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .toggle-password:hover {
            color: #1F6FE5;
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
            color: #1F6FE5;
            text-decoration: none;
            font-weight: 600;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
            color: #00B86B;
        }
        
        .btn {
            width: 100%;
            padding: 1rem;
            background: #00B86B;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,184,107,0.25);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,184,107,0.35);
            background: #00a05d;
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
            color: #FF8A00;
            text-decoration: none;
            font-weight: 700;
        }
        
        .register-link a:hover {
            text-decoration: underline;
            color: #e67d00;
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
    <x-header :showAuthButtons="false" />
    
    <div class="login-wrapper">
        <div class="login-container">
            <div class="left-panel">
                <img src="{{ asset('icon/eigo.png') }}" alt="Random Eigo Logo">
                <h1>Random Eigo</h1>
                <p>{{ __('messages.site_subtitle') }}</p>
            </div>
            
            <div class="right-panel">
                <div class="form-header">
                    <h2>{{ __('messages.login_title') }}</h2>
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
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                <svg id="eye-icon-password" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="eye-off-icon-password" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                            </button>
                        </div>
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
    </div>
    
    <script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const eyeIcon = document.getElementById('eye-icon-' + fieldId);
        const eyeOffIcon = document.getElementById('eye-off-icon-' + fieldId);
        
        if (field.type === 'password') {
            field.type = 'text';
            eyeIcon.style.display = 'none';
            eyeOffIcon.style.display = 'block';
        } else {
            field.type = 'password';
            eyeIcon.style.display = 'block';
            eyeOffIcon.style.display = 'none';
        }
    }
    </script>
</body>
</html>
