<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CakeWorld Blog - Sweet Inspirations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('resources/css/blog.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-light-cream" href="/">CakeWorld</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/blog">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#footer-contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="blog-hero text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold text-white mb-3">Delicious Stories & Sweet Tips</h1>
            <p class="lead text-white-50">Explore our world of baking, recipes, and cake inspirations.</p>
        </div>
    </header>

    <section class="blog-posts py-5 bg-light-cream">
        <div class="container">
            <h2 class="text-center display-5 fw-bold text-primary-dark mb-5">Our Latest Posts</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 blog-card">
                        <img src="https://via.placeholder.com/400x250/FAA4BD/533B4D?text=Cake+Recipe" class="card-img-top" alt="Perfect Sponge Cake">
                        <div class="card-body">
                            <h5 class="card-title text-primary-dark">The Art of Perfect Sponge Cake</h5>
                            <p class="card-text text-secondary-pink small mb-2">October 26, 2023</p>
                            <p class="card-text text-muted">Discover the secrets to baking a light, fluffy sponge cake every time...</p>
                            <a href="#" class="btn btn-secondary-pink btn-sm stretched-link">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 blog-card">
                        <img src="https://via.placeholder.com/400x250/F564A9/FAE3C6?text=Decoration+Tips" class="card-img-top" alt="Cake Decorating Tips">
                        <div class="card-body">
                            <h5 class="card-title text-primary-dark">5 Essential Cake Decorating Tips</h5>
                            <p class="card-text text-secondary-pink small mb-2">October 20, 2023</p>
                            <p class="card-text text-muted">Elevate your cakes with these simple yet effective decorating techniques...</p>
                            <a href="#" class="btn btn-secondary-pink btn-sm stretched-link">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 blog-card">
                        <img src="https://via.placeholder.com/400x250/533B4D/FAA4BD?text=Seasonal+Bakes" class="card-img-top" alt="Autumn Delights">
                        <div class="card-body">
                            <h5 class="card-title text-primary-dark">Seasonal Bakes: Autumn Delights</h5>
                            <p class="card-text text-secondary-pink small mb-2">October 15, 2023</p>
                            <p class="card-text text-muted">Warm up your autumn with these cozy and delicious seasonal cake recipes...</p>
                            <a href="#" class="btn btn-secondary-pink btn-sm stretched-link">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer-contact" class="bg-primary-dark text-light-cream text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; 2023 CakeWorld. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('resources/js/blog.js') }}"></script>
</body>
</html>
