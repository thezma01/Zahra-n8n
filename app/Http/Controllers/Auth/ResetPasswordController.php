<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse; // Import JsonResponse
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, redirect to the password request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showResetForm(Request $request)
    {
        // Determine if it's an email reset or SMS reset based on request parameters
        if ($request->has('email') && $request->has('token')) {
            return view('auth.passwords.reset')->with(
                ['token' => $request->token, 'email' => $request->email]
            );
        } elseif ($request->has('phone_number') && $request->has('token')) {
            return view('auth.passwords.reset')->with(
                ['token' => $request->token, 'phone_number' => $request->phone_number]
            );
        }

        return redirect()->route('password.choose.method', ['locale' => app()->getLocale()]);
    }


    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        // We will validate only common fields here initially, then more specific
        // validation based on the reset method (email or phone).
        $request->validate([
            'token' => 'required',
            'password' => $this->passwordRules(),
        ], $this->validationErrorMessages());

        // Here we need to differentiate between email and SMS token reset
        if ($request->has('email')) {
            // Further validation for email reset
            $request->validate(['email' => ['required', 'email']], $this->validationErrorMessages());

            // Attempt to reset the password via email token
            $response = $this->broker()->reset(
                $this->credentials($request),
                function ($user, $password) {
                    $this->resetPassword($user, $password);
                }
            );

            if ($response == Password::PASSWORD_RESET) {
                return $this->sendResetResponse($request, $response);
            }
            return $this->sendResetFailedResponse($request, $response);

        } elseif ($request->has('phone_number')) {
            // Attempt to reset the password via SMS token
            return $this->resetBySmsToken($request);
        }

        // If neither email nor phone_number is provided, it's an invalid request
        throw ValidationException::withMessages([
            'token' => [trans('passwords.token', [], app()->getLocale())],
        ]);
    }

    /**
     * Reset the given user's password using an SMS token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function resetBySmsToken(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string'],
        ], $this->validationErrorMessages());

        // Find the user by phone number
        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phone_number' => [trans('passwords.phone_user', [], app()->getLocale())],
            ]);
        }

        // Validate the SMS token
        $smsToken = DB::table('sms_password_reset_tokens')
                      ->where('phone_number', $request->phone_number)
                      ->where('token', $request->token)
                      ->first();

        $tokenExpirationMinutes = config('auth.passwords.users.expire', 60); // Default to 60 minutes if not set

        if (!$smsToken || now()->diffInMinutes($smsToken->created_at) > $tokenExpirationMinutes) {
            throw ValidationException::withMessages([
                'token' => [trans('passwords.token', [], app()->getLocale())],
            ]);
        }

        // Reset the password
        $this->resetPassword($user, $request->password);

        // Delete the token
        DB::table('sms_password_reset_tokens')
            ->where('phone_number', $request->phone_number)
            ->delete();

        // Log the user in after reset if desired
        Auth::guard()->login($user);

        return $this->sendResetResponse($request, Password::PASSWORD_RESET);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => Hash::make($password),
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($user);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            // These are the rules used by SendsPasswordResetEmails trait's reset method
            // We've customized it for our unified reset form, so these are less directly used
            // by our manual resetBySmsToken.
            // The request()->validate() calls handle the actual rules.
            'token' => 'required',
            'email' => 'required_without:phone_number|email', // Make email optional if phone_number is present
            'phone_number' => 'required_without:email|string', // Make phone_number optional if email is present
            'password' => $this->passwordRules(),
        ];
    }

    /**
     * Get the password field validation rules.
     *
     * @return array
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', 'min:8', 'confirmed'];
    }


    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages(): array
    {
        return [
            'password.min' => trans('validation.min.string', ['attribute' => __('Password'), 'min' => 8], app()->getLocale()),
            'password.confirmed' => trans('validation.confirmed', ['attribute' => __('Password')], app()->getLocale()),
            'email.required_without' => trans('validation.required_without', ['attribute' => __('Email'), 'values' => __('Phone Number')], app()->getLocale()),
            'phone_number.required_without' => trans('validation.required_without', ['attribute' => __('Phone Number'), 'values' => __('Email')], app()->getLocale()),
        ];
    }


    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return $request->wantsJson()
                    ? new JsonResponse(['message' => trans($response, [], app()->getLocale())], 200)
                    : redirect($this->redirectPath())->with('status', trans($response, [], app()->getLocale()));
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        throw ValidationException::withMessages([
            'email' => [trans($response, [], app()->getLocale())], // Default to email for failure message
        ]);
    }

    /**
     * Get the redirect path after resetting a password.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
