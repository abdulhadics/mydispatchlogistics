<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user();
            $user->last_login = now();

            if (!$user->email_verified_at) {
                $otp = rand(100000, 999999);
                $user->otp_code = $otp;
                $user->otp_expires_at = Carbon::now()->addMinutes(10);
                $user->save();

                Mail::to($user->email)->send(new OtpMail($otp));

                return redirect()->route('otp.verify');
            }

            $user->save();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:customer,driver,dispatcher',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'pending',
            'otp_code' => $otp = rand(100000, 999999),
            'otp_expires_at' => Carbon::now()->addMinutes(10),
        ]);



        // Do not auto-login. Do not send OTP yet. 
        // User must login to trigger the OTP flow.

        return redirect()->route('login')->with('success', 'Account created successfully. Please sign in to verify your account.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showVerifyOtp()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->otp_code === $request->otp && Carbon::now()->lt($user->otp_expires_at)) {
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->email_verified_at = now();
            $user->save();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    public function resendOtp(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $otp = rand(100000, 999999);
        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));

        return back()->with('message', 'A new OTP has been sent to your email.');
    }
}
