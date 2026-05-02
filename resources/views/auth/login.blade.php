@extends('layouts.auth-layout')

@section('title', 'Sign In')

@section('content')
<div class="card auth-card">
    <div class="auth-header text-center text-white">
        <div class="mb-2">
            <i class="bi bi-box-arrow-in-right fs-1"></i>
        </div>
        <h4 class="fw-bold mb-1">Welcome Back</h4>
        <p class="mb-0 opacity-75 small">Sign in to your account</p>
    </div>

    <div class="card-body p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" novalidate>
            @csrf

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
                        placeholder="Your password"
                        autocomplete="current-password">
                    <button type="button" class="toggle-password btn btn-outline-secondary" data-target="password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 d-flex align-items-center justify-content-between">
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1">
                    <label class="form-check-label small text-muted" for="remember">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-auth w-100 mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>

            <hr class="divider">

            <p class="text-center text-muted small mb-0">
                Don't have an account?
                <a href="{{ route('signup') }}" class="auth-link ms-1">Create one</a>
            </p>
        </form>
    </div>
</div>
@endsection
