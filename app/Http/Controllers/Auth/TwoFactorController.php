<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FAQrCode\Google2FA as Google2FAQrCode;

class TwoFactorController extends Controller
{
    protected Google2FA $google2fa;
    protected Google2FAQrCode $google2faQrCode;

    public function __construct(Google2FA $google2fa, Google2FAQrCode $google2faQrCode)
    {
        $this->google2fa = $google2fa;
        $this->google2faQrCode = $google2faQrCode;

        // Methods that require an authenticated user
        $this->middleware('auth')->except(['challenge', 'verify']);
        // Methods for the 2FA challenge flow (user has passed password but not fully logged in)
        // These methods will rely on session('login.id')
        $this->middleware('guest')->only(['challenge', 'verify']);
    }

    /**
     * Show the 2FA setup page (generate QR code and secret).
     * Accessible by authenticated users to enable 2FA.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // If 2FA is already enabled, redirect or show status
        if ($user->two_factor_enabled_at && $user->two_factor_secret) {
            return redirect()->route('home')->with('info', 'Two-Factor Authentication is already enabled.');
        }

        // Generate a new secret key
        $secret = $this->google2fa->generateSecretKey();

        // Temporarily store the secret in session until it's confirmed
        $request->session()->put('two_factor.secret', $secret);

        // Generate QR code SVG
        $qrCodeSvg = $this->google2faQrCode->get(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('auth.two-factor.setup', compact('secret', 'qrCodeSvg'));
    }

    /**
     * Enable 2FA after verifying the initial code.
     * Accessible by authenticated users to confirm and store 2FA.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'digits:6'],
        ]);

        $user = Auth::user();
        $secret = $request->session()->get('two_factor.secret');

        if (empty($secret)) {
            return redirect()->route('two-factor.setup')->withErrors(['message' => '2FA setup timed out or an invalid state. Please restart.']);
        }

        if (!$this->google2fa->verifyKey($secret, $request->code)) {
            return back()->withErrors(['code' => 'Invalid 2FA code. Please try again.']);
        }

        $user->two_factor_secret = encrypt($secret); // Encrypt and store the secret
        $recoveryCodes = $this->generateRecoveryCodes();
        $user->two_factor_recovery_codes = encrypt(json_encode($recoveryCodes)); // Encrypt and store JSON of codes
        $user->two_factor_enabled_at = now();
        $user->save();

        $request->session()->forget('two_factor.secret'); // Clear secret from session

        return redirect()->route('home')
                         ->with('status', 'Two-Factor Authentication has been enabled successfully!')
                         ->with('recoveryCodes', $recoveryCodes); // Pass recovery codes to display once
    }

    /**
     * Disable 2FA.
     * Accessible by authenticated users to disable 2FA.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_enabled_at = null;
        $user->save();

        return redirect()->route('home')->with('status', 'Two-Factor Authentication has been disabled.');
    }

    /**
     * Show the 2FA challenge form.
     * Accessible to users who have passed password auth but need 2FA.
     */
    public function challenge(Request $request)
    {
        // Ensure a user ID is in session, indicating they've passed password auth
        if (!$request->session()->has('login.id')) {
            return redirect()->route('login');
        }

        $user = \App\Models\User::find($request->session()->get('login.id'));

        // Ensure the user exists and has 2FA enabled
        if (!$user || !$user->two_factor_enabled_at || !$user->two_factor_secret) {
            return redirect()->route('login');
        }

        return view('auth.two-factor.challenge');
    }

    /**
     * Verify the 2FA code or recovery code during the challenge.
     * Accessible to users who have passed password auth but need 2FA.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required_without:recovery_code', 'string', 'digits:6'],
            'recovery_code' => ['required_without:code', 'string'],
        ]);

        $userId = $request->session()->get('login.id');
        $user = \App\Models\User::find($userId);

        if (!$user || !$user->two_factor_enabled_at || !$user->two_factor_secret) {
            return redirect()->route('login')->withErrors(['message' => 'Invalid 2FA challenge state. Please log in again.']);
        }

        // Verify TOTP code
        if ($request->filled('code')) {
            $secret = decrypt($user->two_factor_secret);
            if ($this->google2fa->verifyKey($secret, $request->code)) {
                $this->completeTwoFactorChallenge($request, $user);
                return redirect()->intended('/home');
            }
            return back()->withErrors(['code' => 'Invalid 2FA code.']);
        }

        // Verify recovery code
        if ($request->filled('recovery_code')) {
            $recoveryCodes = json_decode(decrypt($user->two_factor_recovery_codes), true);
            foreach ($recoveryCodes as $key => $code) {
                // Using hash_equals to prevent timing attacks
                if (hash_equals($code, $request->recovery_code)) {
                    // Remove the used recovery code to prevent reuse
                    unset($recoveryCodes[$key]);
                    $user->two_factor_recovery_codes = encrypt(json_encode(array_values($recoveryCodes))); // Re-encrypt updated list
                    $user->save();
                    $this->completeTwoFactorChallenge($request, $user);
                    return redirect()->intended('/home');
                }
            }
            return back()->withErrors(['recovery_code' => 'Invalid recovery code.']);
        }

        return back()->withErrors(['message' => 'Please provide either a 2FA code or a recovery code.']);
    }

    /**
     * Regenerate new recovery codes.
     * Accessible by authenticated users to regenerate recovery codes.
     */
    public function regenerateRecoveryCodes(Request $request)
    {
        $user = Auth::user();
        if (!$user->two_factor_enabled_at) {
            return back()->withErrors(['message' => '2FA is not enabled for your account.']);
        }

        $recoveryCodes = $this->generateRecoveryCodes();
        $user->two_factor_recovery_codes = encrypt(json_encode($recoveryCodes));
        $user->save();

        return back()->with('status', 'New recovery codes have been generated.')->with('recoveryCodes', $recoveryCodes);
    }

    /**
     * Generate 8 unique recovery codes.
     */
    protected function generateRecoveryCodes(): array
    {
        return collect(range(0, 7))->map(function () {
            return Str::random(10).'-'.Str::random(10);
        })->all();
    }

    /**
     * Complete the two-factor authentication challenge by logging the user in and marking session.
     */
    protected function completeTwoFactorChallenge(Request $request, $user)
    {
        $remember = $request->session()->pull('remember', false); // Retrieve and remove 'remember' flag
        $request->session()->forget('login.id'); // Clear temporary login ID
        Auth::login($user, $remember); // Log in the user properly with 'remember' status
        $request->session()->put('two_factor_passed_at', now()->timestamp); // Mark 2FA as passed for session
    }
}

