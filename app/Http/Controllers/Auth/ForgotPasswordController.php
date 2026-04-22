<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse; // Import JsonResponse
use Illuminate\Support\Str; // For token generation

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link via email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm(Request $request)
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user via email.
     * Overrides SendsPasswordResetEmails::sendResetLinkEmail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message
        // that we should show to the user.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request),
            function ($user, $token) {
                // Here we call our custom notification for email
                $user->sendPasswordResetNotification($token, 'email');
            }
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Display the form to request a password reset code via phone.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showPhoneRequestForm(Request $request)
    {
        return view('auth.passwords.phone');
    }

    /**
     * Send a reset code to the given user via SMS.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetCodeSms(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string'],
        ]);

        // Find the user by phone number
        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return back()->withErrors(['phone_number' => trans('passwords.phone_user', [], app()->getLocale())]);
        }

        // Generate a simple numeric token for SMS (e.g., 6 digits)
        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Clear any old tokens for this phone number
        DB::table('sms_password_reset_tokens')->where('phone_number', $user->phone_number)->delete();

        // Store the token in the sms_password_reset_tokens table
        DB::table('sms_password_reset_tokens')->insert([
            'phone_number' => $user->phone_number,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Send the SMS notification
        $user->sendPasswordResetNotification($token, 'sms');

        return back()->with('status', trans('passwords.sms_sent', [], app()->getLocale()));
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $request->wantsJson()
                    ? new JsonResponse(['message' => trans($response, [], app()->getLocale())], 200)
                    : back()->with('status', trans($response, [], app()->getLocale()));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return $request->wantsJson()
                    ? new JsonResponse(['message' => trans($response, [], app()->getLocale())], 422)
                    : back()->withErrors(['email' => trans($response, [], app()->getLocale())]);
    }
}
