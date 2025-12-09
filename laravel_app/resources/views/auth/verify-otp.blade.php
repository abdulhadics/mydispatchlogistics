@extends('layouts.auth')

@section('title', 'Verify OTP - MyDispatch')

@section('content')
    <div class="auth-header">
        <h2>Verify OTP</h2>
        <p>Please enter the one-time password sent to your email.</p>
    </div>

    <form method="POST" action="{{ route('otp.verify') }}" class="login-form">
        @csrf

        @if ($errors->any())
            <div class="alert alert-error mb-4"
                style="background: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.2); color: #fca5a5; padding: 1rem; border-radius: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success mb-4"
                style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: #6ee7b7; padding: 1rem; border-radius: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        <div class="form-group mb-6">
            <label for="otp" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">One-Time
                Password</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-key"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="text" id="otp" name="otp" class="form-input" placeholder="Enter OTP" required autofocus
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-full"
            style="width: 100%; padding: 0.875rem; font-size: 1rem;">Verify</button>

    </form>

    <form method="POST" action="{{ route('otp.resend') }}" class="mt-4">
        @csrf
        <p class="text-center mt-6" style="text-align: center; margin-top: 1.5rem; color: #9ca3af; font-size: 0.875rem;">
            Didn't receive code?
            <button type="submit"
                style="background:none; border:none; color: #8b5cf6; text-decoration: none; font-weight: 600; cursor: pointer; padding: 0;">Resend</button>
        </p>
    </form>
@endsection