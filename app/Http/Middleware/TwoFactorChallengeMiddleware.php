<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorChallengeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If the user is not logged in, allow them to proceed (e.g., to public routes or login page)
        if (!$user) {
            return $next($request);
        }

        // If 2FA is not enabled for the user OR they have already passed the 2FA challenge for this session
        // then allow them to proceed.
        if (!$user->two_factor_enabled_at || $request->session()->has('two_factor_passed_at')) {
            return $next($request);
        }

        // If user has 2FA enabled, has not passed the challenge, AND is trying to access a protected route
        // (i.e., not already on the 2FA challenge or verification routes)
        if (! $request->routeIs('two-factor.challenge') && ! $request->routeIs('two-factor.verify')) {
             // Redirect to the 2FA challenge page
             return redirect()->route('two-factor.challenge');
        }

        // If the user is authenticated, has 2FA enabled, has not passed the challenge,
        // but is already on the challenge or verify route, allow them to proceed to complete the challenge.
        return $next($request);
    }
}

