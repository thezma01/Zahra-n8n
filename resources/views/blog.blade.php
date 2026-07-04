<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CakeWorld Blog - Sweet Stories & Recipes</title>
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
                    <li class="nav-item"><a class="nav-link" href="/#order">Order Cake</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="blog-banner-section text-center py-5">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3 text-light-cream">Our Sweet Blog</h1>
            <p class="lead text-light-cream mb-0">Delightful stories, baking tips, and culinary inspiration from CakeWorld.</p>
        </div>
    </header>

    <section class="blog-posts py-5 bg-light-cream">
        <div class="container">
            <h2 class="text-center display-5 fw-bold text-primary-dark mb-5">Latest Articles</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <div class="col">
                    <div class="card h-100 shadow-sm blog-card">
                        <img src="https://static.vecteezy.com/system/resources/previews/022/924/761/non_2x/homemade-carrot-cake-with-cream-cheese-frosting-and-walnuts-fresh-and-tasty-for-fall-season-ai-generated-free-photo.jpeg" class="card-img-top" alt="Carrot Cake Recipe">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary-dark fw-bold">Baking the Perfect Carrot Cake</h5>
                            <p class="card-text text-muted small mb-2">October 26, 2023 by Admin</p>
                            <p class="card-text">Discover our secret recipe for a moist and flavorful carrot cake with creamy cheese frosting...</p>
                            <a href="#" class="mt-auto btn btn-sm btn-secondary-pink rounded-pill align-self-start">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm blog-card">
                        <img src="https://static.vecteezy.com/system/resources/previews/022/689/108/non_2x/delicious-chocolate-cake-with-chocolate-cream-on-the-top-free-photo.jpeg" class="card-img-top" alt="Chocolate Delights">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary-dark fw-bold">Chocolate Lover's Guide: Top 5 Desserts</h5>
                            <p class="card-text text-muted small mb-2">September 15, 2023 by Chef Anna</p>
                            <p class="card-text">Indulge in the rich world of chocolate with our top picks for ultimate cocoa enjoyment...</p>
                            <a href="#" class="mt-auto btn btn-sm btn-secondary-pink rounded-pill align-self-start">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm blog-card">
                        <img src="https://assets.epicurious.com/photos/62b9e092ba4911ad9d7f93ac/4:3/w_5005,h_3754,c_limit/ChiffonCake_HERO_062322_36161.jpg" class="card-img-top" alt="Cake Decorating Tips">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary-dark fw-bold">Mastering Cake Decoration Techniques</h5>
                            <p class="card-text text-muted small mb-2">August 01, 2023 by Design Team</p>
                            <p class="card-text">Elevate your cakes from delicious to dazzling with these professional decorating tips...</p>
                            <a href="#" class="mt-auto btn btn-sm btn-secondary-pink rounded-pill align-self-start">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-primary-dark text-light-cream text-center py-5">
        <div class="container">
            <h3 class="fw-bold mb-4">CakeWorld</h3>
            <div class="row justify-content-center mb-4">
                <div class="col-md-4">
                    <p class="mb-1"><i class="bi bi-envelope me-2"></i> support@cakeworld.com</p>
                    <p class="mb-1"><i class="bi bi-phone me-2"></i> +92 300 1234567</p>
                    <p class="mb-0"><i class="bi bi-geo-alt me-2"></i> Karachi, Pakistan</p>
                </div>
            </div>
            <div class="social-icons mb-4">
                <a href="#" class="text-light-cream fs-4 mx-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light-cream fs-4 mx-2"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-light-cream fs-4 mx-2"><i class="bi bi-twitter"></i></a>
            </div>
            <p class="mb-0">&copy; 2023 CakeWorld. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('resources/js/blog.js') }}"></script>
</body>
</html>
