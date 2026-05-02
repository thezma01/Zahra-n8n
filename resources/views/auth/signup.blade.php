@extends('layouts.auth-layout')

@section('title', 'Create Account')

@section('content')
<div class="card auth-card">
    <div class="auth-header text-center text-white">
        <div class="mb-2">
            <i class="bi bi-person-plus-fill fs-1"></i>
        </div>
        <h4 class="fw-bold mb-1">Create Account</h4>
        <p class="mb-0 opacity-75 small">Join us today, it's free!</p>
    </div>

    <div class="card-body p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-500 text-dark small">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text border-2 border-end-0 rounded-start" style="border-color:#e8ecf4; background:#fff;">
                        <i class="bi bi-person" style="color:#7886C7;"></i>
                    </span>
                    <input type="text" id="name" name="name"
                        class="form-control auth-input border-start-0 rounded-end @error('name') is-invalid @enderror"
                        placeholder="John Doe"
                        value="{{ old('name') }}"
                        autocomplete="name">
                </div>
                @error('name')
                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-500 text-dark small">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text border-2 border-end-0 rounded-start" style="border-color:#e8ecf4; background:#fff;">
                        <i class="bi bi-envelope" style="color:#7886C7;"></i>
                    </span>
                    <input type="email" id="email" name="email"
                        class="form-control auth-input border-start-0 rounded-end @error('email') is-invalid @enderror"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        autocomplete="email">
                </div>
                @error('email')
                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-500 text-dark small">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-2 border-end-0 rounded-start" style="border-color:#e8ecf4; background:#fff;">
                        <i class="bi bi-lock" style="color:#7886C7;"></i>
                    </span>
                    <input type="password" id="password" name="password"
                        class="form-control auth-input border-start-0 @error('password') is-invalid @enderror"
                        placeholder="Min. 8 characters"
                        autocomplete="new-password">
                    <button type="button" class="toggle-password btn btn-outline-secondary" data-target="password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-500 text-dark small">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text border-2 border-end-0 rounded-start" style="border-color:#e8ecf4; background:#fff;">
                        <i class="bi bi-shield-lock" style="color:#7886C7;"></i>
                    </span>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control auth-input border-start-0 @error('password_confirmation') is-invalid @enderror"
                        placeholder="Repeat your password"
                        autocomplete="new-password">
                    <button type="button" class="toggle-password btn btn-outline-secondary" data-target="password_confirmation">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-auth w-100 mb-3">
                <i class="bi bi-person-check me-2"></i>Create Account
            </button>

            <hr class="divider">

            <p class="text-center text-muted small mb-0">
                Already have an account?
                <a href="{{ route('login') }}" class="auth-link ms-1">Sign in</a>
            </p>
        </form>
    </div>
</div>
@endsection
