<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = '/home'; // Assuming a /home route exists

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     */
    protected function authenticated(Request $request, $user)
    {
        // Check if 2FA is enabled for the user
        if ($user->two_factor_enabled_at && $user->two_factor_secret) {
            // Log out the user immediately after successful password authentication
            Auth::logout();
            // Store user ID in session for the 2FA challenge
            $request->session()->put('login.id', $user->id);
            // Store remember me status if applicable
            if ($request->filled('remember')) {
                $request->session()->put('remember', true);
            }
            // Redirect to 2FA challenge page
            return redirect()->route('two-factor.challenge');
        }

        // If 2FA is not enabled, proceed to the intended path
        return redirect()->intended($this->redirectPath());
    }
}

