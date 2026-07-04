@extends('layouts.guest')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <div class="card-header text-center bg-primary text-white mb-4 rounded">
            <h4>Two-Factor Challenge</h4>
        </div>
        <div class="card-body">
            <p class="text-center mb-4">
                Please enter the six-digit code from your authenticator application, or one of your recovery codes.
            </p>

            <form method="POST" action="{{ url('/two-factor-challenge') }}">
                @csrf

                <div class="mb-3">
                    <label for="code" class="form-label">Authenticator Code</label>
                    <input id="code" type="text" class="form-control text-center @error('code') is-invalid @enderror" name="code" required autofocus inputmode="numeric">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4 text-center">
                    <p class="mb-2">Or, use a recovery code:</p>
                    <input id="recovery_code" type="text" class="form-control text-center @error('recovery_code') is-invalid @enderror" name="recovery_code" placeholder="Enter recovery code">
                    @error('recovery_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
