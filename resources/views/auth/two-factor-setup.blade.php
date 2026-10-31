@extends('layouts.guest')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
        <div class="card-header text-center bg-primary text-white mb-4 rounded">
            <h4>Two-Factor Authentication Setup</h4>
        </div>
        <div class="card-body text-center">
            @if (session('status') == 'two-factor-authentication-enabled')
                <div class="alert alert-success" role="alert">
                    Two-factor authentication has been enabled.
                </div>
            @endif

            <p class="mb-4">
                To complete your 2FA setup, scan the QR code below using your authenticator app (e.g., Google Authenticator).
            </p>

            <div class="text-center mb-4">
                {{-- Assuming $qrCodeSvg is passed from the controller --}}
                @isset($qrCodeSvg)
                    {!! $qrCodeSvg !!}
                @else
                    <div class="alert alert-warning">QR Code not available. Please refresh.</div>
                @endisset
            </div>

            <p class="mb-4">
                Alternatively, you can use the setup key: <strong>{{ session('secret') }}</strong>
            </p>

            <h5 class="mt-4">Recovery Codes</h5>
            <p>Store these recovery codes in a safe place. They can be used to log in if you lose access to your authenticator device.</p>
            <div class="text-start mb-4 bg-light p-3 rounded">
                {{-- Assuming $recoveryCodes is passed from the controller and is an array --}}
                @isset($recoveryCodes)
                    <ul class="list-unstyled mb-0 row">
                        @foreach (json_decode(decrypt($recoveryCodes)) as $code)
                            <li class="col-6"><code>{{ $code }}</code></li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Recovery codes not available.</p>
                @endisset
            </div>

            <form method="POST" action="{{ url('/user/two-factor-challenge') }}">
                @csrf
                <div class="mb-3">
                    <label for="code" class="form-label">Verify with Code</label>
                    <input id="code" type="text" class="form-control text-center @error('code') is-invalid @enderror" name="code" required autofocus inputmode="numeric">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Complete Setup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
