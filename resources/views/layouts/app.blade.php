<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Helpora')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff;
            padding: 0 60px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: #4f46e5;
            text-decoration: none;
        }

        .navbar-brand span {
            color: #f59e0b;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 35px;
            align-items: center;
        }

        .navbar-nav a {
            text-decoration: none;
            color: #555;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-nav a:hover,
        .navbar-nav a.active {
            color: #4f46e5;
        }

        .navbar-nav .btn-contact {
            background-color: #4f46e5;
            color: #fff;
            padding: 10px 24px;
            border-radius: 25px;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
        }

        .navbar-nav .btn-contact:hover {
            background-color: #3730a3;
            transform: translateY(-1px);
        }

        /* Footer */
        .footer {
            background-color: #1e1b4b;
            color: #a5b4fc;
            text-align: center;
            padding: 30px 60px;
            font-size: 14px;
            margin-top: 60px;
        }

        .footer a {
            color: #a5b4fc;
            text-decoration: none;
        }

        .footer a:hover {
            color: #fff;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 20px;
            }
            .navbar-nav {
                gap: 15px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar">
        <a href="/" class="navbar-brand">Helpo<span>ra</span></a>
        <ul class="navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active btn-contact' : '' }}">Contact</a></li>
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Helpora. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
