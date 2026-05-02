<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showSignup()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.signup');
    }

    /**
     * Handle user registration.
     */
    public function register(SignupRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome! Your account has been created successfully.');
    }

    /**
     * Show the login form.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle user login.
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $credentials = [
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'))->with('success', 'Welcome back! You have logged in successfully.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show the dashboard (protected page after login).
     */
    public function dashboard()
    {
        return view('auth.dashboard');
    }
}
