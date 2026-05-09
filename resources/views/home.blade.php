<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake World - Delicious Cakes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        :root{--primary-color:#533B4D;--accent-color:#F564A9;--light-accent-color:#FAA4BD;--background-color:#FAE3C6;}
        body{font-family:'Arial',sans-serif;background-color:var(--background-color);color:var(--primary-color);}
        .bg-primary-custom{background-color:var(--primary-color)!important;}
        .text-primary-custom{color:var(--primary-color)!important;}
        .bg-accent-custom{background-color:var(--accent-color)!important;}
        .btn-accent-custom{background-color:var(--accent-color);border-color:var(--accent-color);color:#fff;}
        .btn-accent-custom:hover{background-color:var(--primary-color);border-color:var(--primary-color);}
        .navbar-custom{background-color:var(--primary-color);}
        .footer-custom{background-color:var(--primary-color);color:#fff;}
        .card-custom{background-color:#fff;border-color:var(--light-accent-color);}
        .banner-img{max-height:400px;object-fit:cover;}
        .about-img{max-height:300px;object-fit:cover;}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3">
        <div class="container">
            <a class="navbar-brand fs-4" href="#">Cake World</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#order">Order Now</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="home" class="position-relative text-center d-flex align-items-center justify-content-center overflow-hidden" style="min-height:400px;">
        <img src="https://static.vecteezy.com/system/resources/previews/001/447/454/non_2x/bakery-daily-fresh-cake-donut-and-cupcake-banner-vector.jpg" class="position-absolute w-100 h-100 banner-img" alt="Delicious Cakes Banner">
        <div class="position-absolute w-100 h-100" style="background-color:rgba(83,59,77,0.6);"></div>
        <div class="container text-white z-1">
            <h1 class="display-3 fw-bold mb-3">Freshly Baked Delights</h1>
            <p class="lead mb-4">Taste the sweetness of perfection with our handcrafted cakes.</p>
            <a href="#order" class="btn btn-lg btn-accent-custom rounded-pill px-4">Order Your Cake</a>
        </div>
    </section>
    <section id="about" class="py-5 bg-light-accent-custom">
        <div class="container my-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://assets.epicurious.com/photos/62b9e092ba4911ad9d7f93ac/4:3/w_5005,h_3754,c_limit/ChiffonCake_HERO_062322_36161.jpg" class="img-fluid rounded shadow about-img w-100" alt="About Cake">
                </div>
                <div class="col-md-6 text-primary-custom">
                    <h2 class="display-5 fw-bold mb-4">About Our Bakery</h2>
                    <p class="lead">At Cake World, we believe every occasion deserves a special cake. Crafted with passion and the finest ingredients, our cakes are more than just desserts; they are edible works of art designed to bring joy.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="order" class="py-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg p-4 card-custom">
                        <div class="card-body">
                            <h2 class="text-center text-primary-custom fw-bold mb-4">Place Your Custom Cake Order</h2>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                            @endif
                            <form action="{{ url('/order') }}" method="POST"> @csrf
                                <div class="mb-3"><label for="cake_name" class="form-label">Cake Name</label><input type="text" class="form-control @error('cake_name') is-invalid @enderror" id="cake_name" name="cake_name" value="{{ old('cake_name') }}" required>@error('cake_name') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                                <div class="mb-3"><label for="description" class="form-label">Description</label><textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2" required>{{ old('description') }}</textarea>@error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                                <div class="mb-3"><label for="price" class="form-label">Price ($)</label><input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>@error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                                <div class="mb-3"><label for="flavour" class="form-label">Flavour</label><input type="text" class="form-control @error('flavour') is-invalid @enderror" id="flavour" name="flavour" value="{{ old('flavour') }}" required>@error('flavour') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                                <div class="mb-4"><label for="size" class="form-label">Size</label><input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="size" value="{{ old('size') }}" required>@error('size') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                                <div class="d-grid"><button type="submit" class="btn btn-lg btn-accent-custom rounded-pill">Submit Order</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer-custom py-5">
        <div class="container text-center text-white">
            <h4 class="mb-3">Cake World</h4>
            <p class="mb-1">Email: <a href="mailto:support@cakeworld.com" class="text-white text-decoration-none">support@cakeworld.com</a></p>
            <p class="mb-1">Phone: +92 300 1234567</p>
            <p class="mb-3">Address: Karachi, Pakistan</p>
            <div class="social-icons">
                <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
            </div>
            <p class="mt-3 mb-0">&copy; {{ date('Y') }} Cake World. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
