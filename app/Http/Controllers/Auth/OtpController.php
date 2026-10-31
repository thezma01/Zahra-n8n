<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OtpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // The challenge and verify methods might be used during a guest state (after password, before full login)
        $this->middleware('guest')->only(['challenge', 'verify']);
        // The sendOtp method can be triggered by an authenticated user for verification purposes
        $this->middleware('auth')->except(['challenge', 'verify']);
    }

    /**
     * Generate and send an OTP to the user's email.
     * This can be called by an authenticated user, or during a login flow
     * if the user needs to pass an OTP challenge instead of 2FA.
     */
    public function sendOtp(Request $request)
    {
        $user = Auth::user();

        // If 'login.id' is in session (from LoginController after password auth)
        if ($request->session()->has('login.id')) {
            $user = User::find($request->session()->get('login.id'));
        } elseif (!Auth::check()) {
            return redirect()->route('login')->withErrors(['message' => 'Authentication required to send OTP.']);
        }
        
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User not found.']);
        }

        // Generate a 6-digit OTP
        $otp = (string) random_int(100000, 999999);
        $expiresAt = now()->addMinutes(5); // OTP valid for 5 minutes

        // Store hashed OTP in user record
        $user->otp_secret = Hash::make($otp);
        $user->otp_expires_at = $expiresAt;
        $user->save();

        // Send OTP via email
        Mail::to($user->email)->send(new OtpMail($otp, $user));

        // Redirect to OTP challenge form, with a success message
        return redirect()->route('otp.challenge')->with('status', 'A One-Time Password has been sent to your email.');
    }

    /**
     * Show the OTP challenge form.
     * Accessible to users who need to verify an OTP.
     */
    public function challenge(Request $request)
    {
        // Ensure there's a user associated with the OTP challenge (either logged in or via session('login.id'))
        if (!$request->session()->has('login.id') && !Auth::check()) {
            return redirect()->route('login');
        }

        return view('auth.otp.challenge');
    }

    /**
     * Verify the OTP code.
     * This can be called during a login flow or for other verification purposes.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'digits:6'],
        ]);

        $user = Auth::user();
        if ($request->session()->has('login.id')) {
            $user = User::find($request->session()->get('login.id'));
        }

        if (!$user) {
            return redirect()->route('login')->withErrors(['otp' => 'User not found for OTP verification.']);
        }

        // Check if OTP exists and is not expired
        if (!$user->otp_secret || !$user->otp_expires_at || $user->otp_expires_at->isPast()) {
            return back()->withErrors(['otp' => 'OTP has expired or is invalid. Please request a new one.']);
        }

        // Verify the OTP
        if (!Hash::check($request->otp, $user->otp_secret)) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        // OTP is valid and not expired, clear it from user record
        $user->otp_secret = null;
        $user->otp_expires_at = null;
        $user->save();

        // If it's part of the login flow (after password, before full login)
        if ($request->session()->has('login.id')) {
            $remember = $request->session()->pull('remember', false);
            $request->session()->forget('login.id');
            Auth::login($user, $remember);
            $request->session()->put('two_factor_passed_at', now()->timestamp); // Mark as passed, similar to 2FA
            return redirect()->intended('/home');
        }

        // For other verification purposes, redirect to a confirmation or dashboard.
        return redirect()->route('home')->with('status', 'OTP verified successfully!');
    }
}

