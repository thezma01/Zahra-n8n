<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ChoosePasswordResetMethodController extends Controller
{
    /**
     * Display the form to choose password reset method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showChooseMethodForm(Request $request)
    {
        return view('auth.passwords.choose_method');
    }

    /**
     * Redirects to the appropriate forgot password form based on choice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function chooseMethod(Request $request)
    {
        $request->validate([
            'method' => ['required', 'in:email,sms'],
        ]);

        $locale = app()->getLocale();

        if ($request->method === 'email') {
            return redirect()->route('password.request', ['locale' => $locale]);
        }

        return redirect()->route('password.phone.request', ['locale' => $locale]);
    }
}
