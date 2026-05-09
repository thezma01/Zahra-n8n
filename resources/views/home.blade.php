<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #533B4D;
            --secondary-accent: #F564A9;
            --light-accent: #FAA4BD;
            --text-color: #FAE3C6;
        }
        .bg-primary-custom { background-color: var(--primary-bg) !important; }
        .text-secondary-custom { color: var(--secondary-accent) !important; }
        .btn-custom { background-color: var(--secondary-accent); border-color: var(--secondary-accent); color: white; }
        .btn-custom:hover { background-color: var(--light-accent); border-color: var(--light-accent); }
        .hero-banner {
            background: url('https://static.vecteezy.com/system/resources/previews/001/447/454/non_2x/bakery-daily-fresh-cake-donut-and-cupcake-banner-vector.jpg') no-repeat center center/cover;
            min-height: 400px; display: flex; align-items: center; justify-content: center; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Cake World</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#order">Order Cake</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-banner text-center">
        <h1>Welcome to Cake World!</h1>
        <p class="lead">Delicious cakes for every occasion.</p>
    </header>

    <section id="about" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4 text-secondary-custom">About Us</h2>
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0"><img src="https://assets.epicurious.com/photos/62b9e092ba4911ad9d7f93ac/4:3/w_5005,h_3754,c_limit/ChiffonCake_HERO_062322_36161.jpg" class="img-fluid rounded shadow" alt="About Cake World"></div>
                <div class="col-md-6">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Our passion is crafting delightful cakes that bring joy to every celebration. We use only the finest ingredients to ensure a memorable experience for you and your loved ones.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="order" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4 text-secondary-custom">Place Your Cake Order</h2>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            @if (session('success'))
                                <div class="alert alert-success text-center">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger text-center">{{ session('error') }}</div>
                            @endif
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="cake_name" class="form-label">Cake Name</label>
                                    <input type="text" class="form-control @error('cake_name') is-invalid @enderror" id="cake_name" name="cake_name" value="{{ old('cake_name') }}" required>
                                    @error('cake_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="flavour" class="form-label">Flavour</label>
                                    <input type="text" class="form-control @error('flavour') is-invalid @enderror" id="flavour" name="flavour" value="{{ old('flavour') }}" required>
                                    @error('flavour')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="size" class="form-label">Size</label>
                                    <select class="form-select @error('size') is-invalid @enderror" id="size" name="size" required>
                                        <option value="" disabled selected>Select Size</option>
                                        <option value="Small" {{ old('size') == 'Small' ? 'selected' : '' }}>Small</option>
                                        <option value="Medium" {{ old('size') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="Large" {{ old('size') == 'Large' ? 'selected' : '' }}>Large</option>
                                    </select>
                                    @error('size')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <button type="submit" class="btn btn-custom w-100">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact" class="bg-primary-custom text-light py-5">
        <div class="container text-center">
            <h3 class="mb-3">Cake World</h3>
            <p>Email: support@cakeworld.com</p>
            <p>Phone: +92 300 1234567</p>
            <p>Address: Karachi, Pakistan</p>
            <div class="social-icons mt-4">
                <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#" class="text-light mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="#" class="text-light mx-2"><i class="fab fa-instagram fa-lg"></i></a>
            </div>
            <p class="mt-3 mb-0">&copy; {{ date('Y') }} Cake World. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

