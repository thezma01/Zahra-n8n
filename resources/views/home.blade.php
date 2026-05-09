<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake World - Delicious Cakes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Cake World</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#order">Order</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner Section -->
    <section id="home" class="banner-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold">Taste the Sweetness</h1>
            <p class="lead mb-4">Handcrafted cakes for your special moments.</p>
            <a href="#order" class="btn btn-lg btn-primary-custom shadow">Order Your Cake!</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <img src="https://assets.epicurious.com/photos/62b9e092ba4911ad9d7f93ac/4:3/w_5005,h_3754,c_limit/ChiffonCake_HERO_062322_36161.jpg" class="img-fluid about-img" alt="About Cake World">
                </div>
                <div class="col-md-6">
                    <h2 class="display-5 text-primary-custom fw-bold">Our Story</h2>
                    <p class="lead">At Cake World, every celebration deserves a masterpiece. Crafted with passion and the finest ingredients, our cakes are designed to bring joy and unforgettable memories.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cake Order Form Section -->
    <section id="order" class="py-5 bg-light-peach">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5">
                            <h2 class="card-title text-center text-primary-custom fw-bold mb-4">Order Custom Cake</h2>
                            @if(session('success'))
                                <div class="alert alert-success fade show mb-4" role="alert">
                                    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <div class="mb-3"><label for="cake_name" class="form-label">Cake Name</label><input type="text" class="form-control" id="cake_name" name="cake_name" required></div>
                                <div class="mb-3"><label for="description" class="form-label">Description</label><textarea class="form-control" id="description" name="description" rows="2" required></textarea></div>
                                <div class="row mb-3">
                                    <div class="col-md-4"><label for="price" class="form-label">Price ($)</label><input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required></div>
                                    <div class="col-md-4"><label for="flavour" class="form-label">Flavour</label><input type="text" class="form-control" id="flavour" name="flavour" required></div>
                                    <div class="col-md-4"><label for="size" class="form-label">Size</label>
                                        <select class="form-select" id="size" name="size" required>
                                            <option value="">Choose...</option><option value="Small">Small</option>
                                            <option value="Medium">Medium</option><option value="Large">Large</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-grid mt-4"><button type="submit" class="btn btn-lg btn-primary-custom shadow">Place Order</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer-section py-5 text-center">
        <div class="container">
            <h4 class="text-white mb-3">Cake World</h4>
            <p class="mb-1">Email: <a href="mailto:support@cakeworld.com" class="text-white text-decoration-none">support@cakeworld.com</a></p>
            <p class="mb-1">Phone: +92 300 1234567</p>
            <p class="mb-0">Address: Karachi, Pakistan</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
