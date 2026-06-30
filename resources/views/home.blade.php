<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-dark: #533B4D;
            --secondary-pink: #F564A9;
            --light-pink: #FAA4BD;
            --light-cream: #FAE3C6;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .bg-primary-dark { background-color: var(--primary-dark) !important; }
        .text-light-cream { color: var(--light-cream) !important; }
        .text-secondary-pink { color: var(--secondary-pink) !important; }
        .bg-secondary-pink { background-color: var(--secondary-pink) !important; }
        .bg-light-cream { background-color: var(--light-cream) !important; }
        .btn-secondary-pink { background-color: var(--secondary-pink); border-color: var(--secondary-pink); color: white; }
        .btn-secondary-pink:hover { background-color: #e45398; border-color: #e45398; color: white; }
        .banner-section {
            background: linear-gradient(rgba(83, 59, 77, 0.7), rgba(245, 100, 169, 0.5)), url('https://static.vecteezy.com/system/resources/previews/001/447/454/non_2x/bakery-daily-fresh-cake-donut-and-cupcake-banner-vector.jpg') no-repeat center center/cover;
            color: white; padding: 100px 0;
        }
        .about-section {
            background-color: var(--light-cream); padding: 80px 0;
            background: linear-gradient(rgba(250, 227, 198, 0.8), rgba(250, 227, 198, 0.8)), url('https://assets.epicurious.com/photos/62b9e092ba4911ad9d7f93ac/4:3/w_5005,h_3754,c_limit/ChiffonCake_HERO_062322_36161.jpg') no-repeat center center/cover;
            background-blend-mode: multiply;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-light-cream" href="#">CakeWorld</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#order">Order Cake</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="home" class="banner-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4 text-light-cream"> zahra Sweeten Your Day with CakeWorld</h1>
            <p class="lead text-light-cream mb-5">Delicious cakes for every occasion, baked with love and the finest ingredients.</p>
            <a href="#order" class="btn btn-lg btn-secondary-pink rounded-pill shadow">Order Your Cake Now!</a>
        </div>
    </header>

    <section id="about" class="about-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="display-5 fw-bold text-primary-dark mb-4">About Our Bakery</h2>
                    <p class="lead text-primary-dark mb-4">
                        At CakeWorld, we believe every celebration deserves a centerpiece.
                        Our journey began with a passion for baking and a commitment to quality.
                        We craft exquisite cakes, cupcakes, and pastries using traditional recipes and fresh, local ingredients.
                        Join us in creating sweet memories, one slice at a time.
                    </p>
                    <p class="text-primary-dark">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="order" class="py-5 bg-light-cream">
        <div class="container">
            <h2 class="text-center display-5 fw-bold text-primary-dark mb-5">Place Your Cake Order</h2>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow p-4 rounded-3 border-0">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('cake.order') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="cake_name" class="form-label text-primary-dark">Cake Name</label>
                                    <input type="text" class="form-control" id="cake_name" name="cake_name" required value="{{ old('cake_name') }}">
                                    @error('cake_name')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label text-primary-dark">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label text-primary-dark">Price ($)</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" required value="{{ old('price') }}">
                                    @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="flavour" class="form-label text-primary-dark">Flavour</label>
                                    <input type="text" class="form-control" id="flavour" name="flavour" required value="{{ old('flavour') }}">
                                    @error('flavour')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="size" class="form-label text-primary-dark">Size</label>
                                    <select class="form-select" id="size" name="size" required>
                                        <option value="">Select Size</option>
                                        <option value="Small" {{ old('size') == 'Small' ? 'selected' : '' }}>Small</option>
                                        <option value="Medium" {{ old('size') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="Large" {{ old('size') == 'Large' ? 'selected' : '' }}>Large</option>
                                    </select>
                                    @error('size')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-secondary-pink btn-lg rounded-pill shadow-sm">Submit Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact" class="bg-primary-dark text-light-cream text-center py-5">
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
</body>
</html>
