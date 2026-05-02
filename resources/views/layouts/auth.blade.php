<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Authentication') — {{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        /* =========================================================
           CSS CUSTOM PROPERTIES — Color Palette
        ========================================================= */
        :root {
            --color-primary:    #7886C7;
            --color-secondary:  #A9B5DF;
            --color-dark:       #2D336B;
            --color-light:      #FFF2F2;
            --color-white:      #FFFFFF;
            --color-error:      #E53E3E;
            --color-error-bg:   #FFF5F5;
            --color-success:    #38A169;
            --color-success-bg: #F0FFF4;
            --color-text:       #1A202C;
            --color-text-muted: #718096;
            --color-border:     #E2E8F0;
            --color-input-bg:   #FAFBFF;

            --shadow-sm:  0 1px 3px rgba(45, 51, 107, 0.08), 0 1px 2px rgba(45, 51, 107, 0.05);
            --shadow-md:  0 4px 6px rgba(45, 51, 107, 0.07), 0 2px 4px rgba(45, 51, 107, 0.05);
            --shadow-lg:  0 10px 40px rgba(45, 51, 107, 0.12), 0 4px 16px rgba(45, 51, 107, 0.08);
            --shadow-xl:  0 20px 60px rgba(45, 51, 107, 0.15), 0 8px 24px rgba(45, 51, 107, 0.10);

            --radius-sm:  6px;
            --radius-md:  12px;
            --radius-lg:  20px;
            --radius-xl:  28px;

            --transition: 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* =========================================================
           RESET & BASE
        ========================================================= */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--color-light);
            color: var(--color-text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            position: relative;
            overflow-x: hidden;
        }

        /* =========================================================
           DECORATIVE BACKGROUND
        ========================================================= */
        body::before,
        body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        body::before {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(120, 134, 199, 0.18) 0%, transparent 70%);
            top: -200px;
            right: -200px;
        }

        body::after {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(169, 181, 223, 0.15) 0%, transparent 70%);
            bottom: -150px;
            left: -150px;
        }

        /* =========================================================
           AUTH WRAPPER
        ========================================================= */
        .auth-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 460px;
        }

        /* =========================================================
           BRAND / LOGO AREA
        ========================================================= */
        .auth-brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-brand__logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-dark) 100%);
            border-radius: var(--radius-md);
            margin-bottom: 12px;
            box-shadow: 0 8px 24px rgba(120, 134, 199, 0.40);
        }

        .auth-brand__logo svg {
            width: 28px;
            height: 28px;
            fill: var(--color-white);
        }

        .auth-brand__name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-dark);
            letter-spacing: -0.02em;
        }

        /* =========================================================
           AUTH CARD
        ========================================================= */
        .auth-card {
            background: var(--color-white);
            border-radius: var(--radius-xl);
            padding: 40px 40px 36px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(169, 181, 223, 0.20);
            animation: slideUp 0.45s cubic-bezier(0.4, 0, 0.2, 1) both;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================================================
           CARD HEADER
        ========================================================= */
        .auth-card__header {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-card__title {
            font-size: 1.625rem;
            font-weight: 700;
            color: var(--color-dark);
            letter-spacing: -0.025em;
            margin-bottom: 6px;
        }

        .auth-card__subtitle {
            font-size: 0.9rem;
            color: var(--color-text-muted);
            font-weight: 400;
            line-height: 1.5;
        }

        /* =========================================================
           FLASH MESSAGES
        ========================================================= */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .alert--success {
            background-color: var(--color-success-bg);
            color: var(--color-success);
            border: 1px solid rgba(56, 161, 105, 0.25);
        }

        .alert--error {
            background-color: var(--color-error-bg);
            color: var(--color-error);
            border: 1px solid rgba(229, 62, 62, 0.25);
        }

        .alert__icon {
            flex-shrink: 0;
            width: 18px;
            height: 18px;
            margin-top: 1px;
        }

        /* =========================================================
           FORM ELEMENTS
        ========================================================= */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--color-dark);
            margin-bottom: 8px;
            letter-spacing: 0.01em;
        }

        .form-label span.required {
            color: var(--color-primary);
            margin-left: 2px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--color-secondary);
            pointer-events: none;
            transition: color var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-icon svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .form-input {
            width: 100%;
            height: 48px;
            padding: 0 16px 0 44px;
            background: var(--color-input-bg);
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 0.9375rem;
            color: var(--color-text);
            transition: border-color var(--transition), box-shadow var(--transition), background-color var(--transition);
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .form-input::placeholder {
            color: #B0BAD0;
            font-size: 0.9rem;
        }

        .form-input:hover {
            border-color: var(--color-secondary);
        }

        .form-input:focus {
            border-color: var(--color-primary);
            background-color: var(--color-white);
            box-shadow: 0 0 0 3px rgba(120, 134, 199, 0.15);
        }

        .form-input:focus + .input-icon,
        .input-wrapper:focus-within .input-icon {
            color: var(--color-primary);
        }

        /* Input with icon on the right (password toggle) */
        .form-input--has-toggle {
            padding-right: 48px;
        }

        .input-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--color-secondary);
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color var(--transition);
            outline: none;
            border-radius: 4px;
        }

        .input-toggle:hover,
        .input-toggle:focus {
            color: var(--color-primary);
        }

        .input-toggle svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Error state */
        .form-input.is-invalid {
            border-color: var(--color-error);
            background-color: #FFF8F8;
        }

        .form-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.12);
        }

        .form-error {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8125rem;
            color: var(--color-error);
            margin-top: 6px;
            font-weight: 500;
            animation: fadeIn 0.2s ease;
        }

        .form-error svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-4px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* =========================================================
           FORM OPTIONS ROW (remember me + forgot)
        ========================================================= */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
        }

        .form-checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--color-primary);
            cursor: pointer;
            border-radius: 4px;
        }

        .form-checkbox__label {
            font-size: 0.875rem;
            color: var(--color-text-muted);
            font-weight: 400;
        }

        .form-link {
            font-size: 0.875rem;
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color var(--transition);
        }

        .form-link:hover {
            color: var(--color-dark);
            text-decoration: underline;
        }

        /* =========================================================
           SUBMIT BUTTON
        ========================================================= */
        .btn-auth {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            height: 50px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-dark) 100%);
            color: var(--color-white);
            border: none;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 0.9375rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            cursor: pointer;
            transition: transform var(--transition), box-shadow var(--transition), opacity var(--transition);
            box-shadow: 0 4px 16px rgba(120, 134, 199, 0.40);
            outline: none;
            position: relative;
            overflow: hidden;
        }

        .btn-auth::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.10) 0%, transparent 60%);
            opacity: 0;
            transition: opacity var(--transition);
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(120, 134, 199, 0.50);
        }

        .btn-auth:hover::before {
            opacity: 1;
        }

        .btn-auth:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(120, 134, 199, 0.30);
        }

        .btn-auth:focus-visible {
            outline: 2px solid var(--color-primary);
            outline-offset: 3px;
        }

        .btn-auth svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* =========================================================
           DIVIDER
        ========================================================= */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
        }

        .auth-divider__line {
            flex: 1;
            height: 1px;
            background: var(--color-border);
        }

        .auth-divider__text {
            font-size: 0.8125rem;
            color: var(--color-text-muted);
            font-weight: 500;
            white-space: nowrap;
        }

        /* =========================================================
           CARD FOOTER LINK
        ========================================================= */
        .auth-card__footer {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--color-border);
            font-size: 0.9rem;
            color: var(--color-text-muted);
        }

        .auth-card__footer a {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            transition: color var(--transition);
        }

        .auth-card__footer a:hover {
            color: var(--color-dark);
            text-decoration: underline;
        }

        /* =========================================================
           PASSWORD STRENGTH
        ========================================================= */
        .password-strength {
            margin-top: 8px;
        }

        .password-strength__bar {
            height: 4px;
            background: var(--color-border);
            border-radius: 99px;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .password-strength__fill {
            height: 100%;
            border-radius: 99px;
            transition: width 0.3s ease, background-color 0.3s ease;
            width: 0%;
        }

        .password-strength__label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--color-text-muted);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */
        @media (max-width: 500px) {
            .auth-card {
                padding: 32px 24px 28px;
                border-radius: var(--radius-lg);
            }

            .auth-card__title {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 360px) {
            .auth-card {
                padding: 28px 20px 24px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="auth-wrapper">
        <!-- Brand -->
        <div class="auth-brand">
            <div class="auth-brand__logo">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div class="auth-brand__name">{{ config('app.name', 'Laravel') }}</div>
        </div>

        <!-- Card -->
        <div class="auth-card">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="alert alert--success" role="alert">
                    <svg class="alert__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert--error" role="alert">
                    <svg class="alert__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <script>
        /**
         * Toggle password visibility
         */
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';

            const eyeOpen  = btn.querySelector('.icon-eye-open');
            const eyeClose = btn.querySelector('.icon-eye-close');
            if (eyeOpen)  eyeOpen.style.display  = isHidden ? 'none'  : 'block';
            if (eyeClose) eyeClose.style.display = isHidden ? 'block' : 'none';

            btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
        }

        /**
         * Password strength meter
         */
        function checkPasswordStrength(value) {
            let score = 0;
            if (value.length >= 8)                           score++;
            if (value.length >= 12)                          score++;
            if (/[A-Z]/.test(value))                         score++;
            if (/[0-9]/.test(value))                         score++;
            if (/[^A-Za-z0-9]/.test(value))                  score++;

            const fill  = document.getElementById('strengthFill');
            const label = document.getElementById('strengthLabel');
            if (!fill || !label) return;

            const levels = [
                { width: '0%',   color: '#E2E8F0', text: '' },
                { width: '25%',  color: '#E53E3E', text: 'Weak' },
                { width: '50%',  color: '#DD6B20', text: 'Fair' },
                { width: '75%',  color: '#D69E2E', text: 'Good' },
                { width: '100%', color: '#38A169', text: 'Strong' },
            ];

            const level = levels[Math.min(score, 4)];
            fill.style.width           = level.width;
            fill.style.backgroundColor = level.color;
            label.textContent          = level.text;
            label.style.color          = level.color;
        }

        /**
         * Real-time confirm password validation
         */
        function checkPasswordMatch() {
            const password        = document.getElementById('password');
            const confirm         = document.getElementById('password_confirmation');
            const matchMsg        = document.getElementById('confirmMatchMsg');
            if (!password || !confirm || !matchMsg) return;

            if (confirm.value.length === 0) {
                matchMsg.textContent = '';
                return;
            }

            if (password.value === confirm.value) {
                matchMsg.textContent = '✓ Passwords match';
                matchMsg.style.color = '#38A169';
            } else {
                matchMsg.textContent = '✗ Passwords do not match';
                matchMsg.style.color = '#E53E3E';
            }
        }

        // Bind on DOM ready
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function () {
                    checkPasswordStrength(this.value);
                    checkPasswordMatch();
                });
            }

            const confirmInput = document.getElementById('password_confirmation');
            if (confirmInput) {
                confirmInput.addEventListener('input', checkPasswordMatch);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
