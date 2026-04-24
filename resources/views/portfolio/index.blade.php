<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portfolio – Elevating Your Ecommerce Experience</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Portfolio CSS -->
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}" />
</head>
<body>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Hero / Banner --}}
    @include('components.hero')

    {{-- About Section --}}
    @include('components.about')

    {{-- Services Section --}}
    @include('components.services', ['services' => $services])

    {{-- Portfolio Showcase --}}
    @include('components.portfolio-showcase', ['portfolioItems' => $portfolioItems])

    {{-- Call to Action --}}
    @include('components.cta')

    {{-- Footer --}}
    @include('components.footer')

    <!-- Portfolio JS -->
    <script src="{{ asset('js/portfolio.js') }}"></script>
</body>
</html>
