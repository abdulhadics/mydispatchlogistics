@extends('layouts.auth')

@section('title', 'Sign In - MyDispatch')

@section('content')
    <div class="auth-header">
        <h2>Welcome back</h2>
        <p>Please enter your details to sign in.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        @if ($errors->any())
            <div class="alert alert-error mb-4"
                style="background: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.2); color: #fca5a5; padding: 1rem; border-radius: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Email -->
        <div class="form-group mb-4">
            <label for="email" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Email
                Address</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-envelope"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email"
                    value="{{ old('email') }}" required autofocus
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
            </div>
        </div>

        <!-- Password -->
        <div class="form-group mb-6">
            <label for="password" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Password</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-lock"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password"
                    required
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
                <button type="button" onclick="togglePasswordVisibility('password')"
                    style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #6b7280; cursor: pointer;">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-between items-center mb-6"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <label class="flex items-center gap-2"
                style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" name="remember" style="accent-color: #8b5cf6; width: 1rem; height: 1rem;">
                <span style="color: #9ca3af; font-size: 0.875rem;">Remember me</span>
            </label>
            <a href="#" style="color: #8b5cf6; font-size: 0.875rem; text-decoration: none;">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-full" style="width: 100%; padding: 0.875rem; font-size: 1rem;">Sign
            In</button>

        <p class="text-center mt-6" style="text-align: center; margin-top: 1.5rem; color: #9ca3af; font-size: 0.875rem;">
            Don't have an account? <a href="{{ route('signup') }}"
                style="color: #8b5cf6; text-decoration: none; font-weight: 600;">Sign up</a>
        </p>
    </form>



    <script>
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection