@extends('layouts.guest')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <div class="card-header text-center bg-primary text-white mb-4 rounded">
            <h4>OTP Verification</h4>
        </div>
        <div class="card-body">
            <p class="text-center mb-4">
                A One-Time Password (OTP) has been sent to your email address (or phone number). Please enter it below to proceed.
            </p>

            <form method="POST" action="{{ route('verify.otp') }}">
                @csrf

                <div class="mb-3">
                    <label for="otp_code" class="form-label">{{ __('OTP Code') }}</label>
                    <input id="otp_code" type="text" class="form-control text-center @error('otp_code') is-invalid @enderror" name="otp_code" required autocomplete="one-time-code" autofocus inputmode="numeric" maxlength="6">
                    @error('otp_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Verify OTP') }}
                    </button>
                    <a class="btn btn-link text-center mt-2" href="{{ route('resend.otp') }}">
                        {{ __('Resend OTP') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
