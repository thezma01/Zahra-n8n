<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Authentication')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ===== CSS Reset & Base ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #7886C7;
            --secondary: #A9B5DF;
            --dark: #2D336B;
            --light: #FFF2F2;
            --white: #FFFFFF;
            --error: #E74C3C;
            --error-bg: #FDEDEC;
            --success: #27AE60;
            --success-bg: #EAFAF1;
            --shadow: 0 10px 40px rgba(45, 51, 107, 0.12);
            --shadow-sm: 0 4px 12px rgba(45, 51, 107, 0.08);
            --shadow-hover: 0 14px 48px rgba(45, 51, 107, 0.18);
            --radius: 12px;
            --radius-sm: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* ===== Background Decorations ===== */
        body::before {
            content: '';
            position: fixed;
            top: -120px;
            right: -120px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            opacity: 0.12;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--dark));
            opacity: 0.08;
            z-index: 0;
        }

        /* ===== Auth Container ===== */
        .auth-container {
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 1;
        }

        /* ===== Card ===== */
        .auth-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 48px 40px;
            transition: var(--transition);
            border: 1px solid rgba(169, 181, 223, 0.15);
        }

        .auth-card:hover {
            box-shadow: var(--shadow-hover);
        }

        /* ===== Logo / Brand ===== */
        .auth-brand {
            text-align: center;
            margin-bottom: 36px;
        }

        .auth-brand-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--dark));
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 6px 20px rgba(120, 134, 199, 0.35);
        }

        .auth-brand-icon svg {
            width: 28px;
            height: 28px;
            color: var(--white);
        }

        .auth-brand h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -0.5px;
        }

        .auth-brand p {
            font-size: 14px;
            color: var(--primary);
            margin-top: 6px;
            font-weight: 400;
        }

        /* ===== Alert Messages ===== */
        .alert {
            padding: 14px 18px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success);
            border: 1px solid rgba(39, 174, 96, 0.2);
        }

        .alert-error {
            background: var(--error-bg);
            color: var(--error);
            border: 1px solid rgba(231, 76, 60, 0.2);
        }

        .alert svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* ===== Form Groups ===== */
        .form-group {
            margin-bottom: 22px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--secondary);
            transition: var(--transition);
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            color: var(--dark);
            background: var(--light);
            border: 2px solid transparent;
            border-radius: var(--radius);
            outline: none;
            transition: var(--transition);
        }

        .form-control::placeholder {
            color: var(--secondary);
            font-weight: 400;
        }

        .form-control:focus {
            background: var(--white);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(120, 134, 199, 0.15);
        }

        .form-control:focus + svg,
        .form-control:focus ~ svg {
            color: var(--primary);
        }

        .input-wrapper:focus-within svg {
            color: var(--primary);
        }

        .form-control.is-invalid {
            border-color: var(--error);
            background: var(--white);
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.1);
        }

        /* ===== Toggle Password ===== */
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--secondary);
            transition: var(--transition);
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        .toggle-password svg {
            position: static;
            transform: none;
            width: 18px;
            height: 18px;
            pointer-events: auto;
        }

        /* ===== Error Messages ===== */
        .error-message {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            font-size: 12px;
            font-weight: 500;
            color: var(--error);
            animation: slideDown 0.25s ease;
        }

        .error-message svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Submit Button ===== */
        .btn-primary {
            width: 100%;
            padding: 15px 24px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            color: var(--white);
            background: linear-gradient(135deg, var(--primary), var(--dark));
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
            margin-top: 8px;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 51, 107, 0.35);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(45, 51, 107, 0.25);
        }

        /* ===== Divider ===== */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 28px 0;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--secondary), transparent);
            opacity: 0.4;
        }

        .auth-divider span {
            font-size: 12px;
            font-weight: 500;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ===== Footer Link ===== */
        .auth-footer {
            text-align: center;
            margin-top: 28px;
        }

        .auth-footer p {
            font-size: 14px;
            color: var(--primary);
        }

        .auth-footer a {
            color: var(--dark);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
        }

        .auth-footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
            border-radius: 1px;
        }

        .auth-footer a:hover {
            color: var(--primary);
        }

        .auth-footer a:hover::after {
            width: 100%;
        }

        /* ===== Responsive ===== */
        @media (max-width: 520px) {
            .auth-card {
                padding: 36px 24px;
                border-radius: 16px;
            }

            .auth-brand h1 {
                font-size: 22px;
            }

            .auth-brand-icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
            }

            .auth-brand-icon svg {
                width: 24px;
                height: 24px;
            }

            body::before {
                width: 250px;
                height: 250px;
                top: -80px;
                right: -80px;
            }

            body::after {
                width: 200px;
                height: 200px;
                bottom: -60px;
                left: -60px;
            }
        }

        @media (max-width: 360px) {
            .auth-card {
                padding: 28px 18px;
            }
        }

        /* ===== Fade-in Animation ===== */
        .auth-card {
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="auth-container">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
