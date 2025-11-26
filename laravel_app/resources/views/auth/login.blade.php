@extends('layouts.app')

@section('title', 'Sign In - MyDispatch')
@section('description', 'Sign in to your MyDispatch account to access your dashboard and manage your logistics operations.')
@section('body_class', 'login-page')

@section('content')
    <div class="login-container">
        <div class="login-card">
            <!-- Logo and Header -->
            <div class="login-header">
                <div class="login-logo">
                    <div class="logo-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                </div>
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to your MyDispatch account</p>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="password" name="password" class="form-input"
                            placeholder="Enter your password" required autocomplete="current-password">
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember_me" name="remember" class="checkbox">
                        <label for="remember_me" class="checkbox-label">Remember me</label>
                    </div>

                    <a href="#" class="forgot-password">
                        Forgot your password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary btn-full">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>

                <!-- Sign Up Link -->
                <div class="login-footer">
                    <p>Don't have an account?
                        <a href="{{ route('signup') }}" class="signup-link">Sign up here</a>
                    </p>
                </div>
            </form>

            <!-- Demo Credentials -->
            <div class="demo-credentials">
                <h3>Demo Credentials</h3>
                <div class="demo-account">
                    <strong>Admin:</strong> admin@logistics.com / admin123
                </div>
                <div class="demo-account">
                    <strong>Driver:</strong> driver@example.com / driver123
                </div>
                <div class="demo-account">
                    <strong>Customer:</strong> customer@example.com / customer123
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Login Page Styles */
        .login-page {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 2rem 0;
        }

        .login-page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.05) 0%, transparent 40%);
            pointer-events: none;
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }

        .login-card {
            background: rgba(23, 23, 23, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(38, 38, 38, 0.8);
            border-radius: 24px;
            padding: 3rem 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .login-logo .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #a3a3a3;
            font-size: 1.125rem;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #737373;
            z-index: 2;
        }

        .form-input {
            padding-left: 48px;
            padding-right: 48px;
            width: 100%;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #737373;
            cursor: pointer;
            padding: 4px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #a855f7;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox {
            width: 16px;
            height: 16px;
            accent-color: #a855f7;
        }

        .checkbox-label {
            color: #a3a3a3;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .forgot-password {
            color: #a855f7;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #c084fc;
        }

        .btn-full {
            width: 100%;
            padding: 16px;
            font-size: 1.125rem;
            margin-top: 1rem;
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(38, 38, 38, 0.8);
        }

        .login-footer p {
            color: #a3a3a3;
            margin: 0;
        }

        .signup-link {
            color: #a855f7;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link:hover {
            color: #c084fc;
        }

        .demo-credentials {
            margin-top: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .demo-credentials h3 {
            color: #fff;
            font-size: 1rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .demo-account {
            color: #a3a3a3;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .demo-account:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .demo-account strong {
            color: #a855f7;
        }
    </style>
@endsection