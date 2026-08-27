<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>
<body>
    @include('components/navbar')
    <section class="banner">
        <img src="https://st-gdx.dancf.com/gaodingx/0/uxms/design/20210122-101837-cf22.png" alt="Banner Image">
        <div class="overlay">
            <h1>Elevating Your Ecommerce Experience</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <button>Explore More</button>
        </div>
    </section>
    @include('components/about')
    @include('components/services')
    @include('components/portfolio')
    @include('components/call-to-action')
    @include('components/footer')
    <script src="{{ asset('js/portfolio.js') }}"></script>
</body>
</html>
