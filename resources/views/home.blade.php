<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake World - Delicious Cakes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root{--p:#533B4D;--s:#F564A9;--lp:#FAA4BD;--ly:#FAE3C6;}
        body{font-family:sans-serif;}
        .bg-p{background-color:var(--p)!important;}.text-p{color:var(--p)!important;}
        .bg-s{background-color:var(--s)!important;}.text-s{color:var(--s)!important;}
        .bg-lp{background-color:var(--lp)!important;}.text-lp{color:var(--lp)!important;}
        .bg-ly{background-color:var(--ly)!important;}.text-ly{color:var(--ly)!important;}
        .btn-custom{background-color:var(--s);color:white;border:none;}.btn-custom:hover{background-color:var(--p);color:white;}
        .navbar-brand,.nav-link{color:white!important;}.navbar-brand:hover,.nav-link:hover{color:var(--ly)!important;}
        .banner-section{background:url('https://static.vecteezy.com/system/resources/previews/001/447/454/non_2x/bakery-daily-fresh-cake-donut-and-cupcake-banner-vector.jpg') no-repeat center center/cover;min-height:400px;display:flex;align-items:center;justify-content:center;}
        .banner-text{background-color:rgba(83,59,77,0.7);padding:2rem;border-radius:.5rem;}
        .about-section img{max-width:100%;height:auto;border-radius:.5rem;}
        .form-card{border:none;box-shadow:0 0.5rem 1rem rgba(0,0,0,0.15);}
        footer a{color:var(--ly);text-decoration:none;}footer a:hover{color:white;}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-p py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">Cake World</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#order">Order Now</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header id="home" class="banner-section text-white text-center">
        <div class="container banner-text">
            <h1 class="display-3 fw-bold mb-3">Freshly Baked Delights</h1>
            <p class="lead mb-4">Crafting happiness, one cake at a time.</p>
            <a href="#order" class="btn btn-lg btn-custom px-4 py-2">Order Your Cake!</a>
        </div>
    </header>
    <section id="about" class="py-5 bg-ly">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://assets.epicurious.com/photos/62b9e092ba4911ad9d7f93ac/4:3/w_5005,h_3754,c_limit/ChiffonCake_HERO_062322_36161.jpg" alt="About Cake World" class="img-fluid">
                </div>
                <div class="col-md-6 text-p">
                    <h2 class="display-5 fw-bold mb-4">About Our Bakery</h2>
                    <p class="lead">Welcome to Cake World, where every creation is a testament to passion and perfection. We use only the finest ingredients to bake delightful cakes, perfect for every occasion.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="order" class="py-5 bg-lp">
        <div class="container">
            <h2 class="text-center display-5 fw-bold mb-5 text-p">Place Your Cake Order</h2>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="card form-card p-4">
                        <div class="card-body">
                            @if (session('success'))<div class="alert alert-success text-center">{{ session('success') }}</div>@endif
                            <form action="{{ route('cake.order.store') }}" method="POST">
                                @csrf
                                <div class="mb-3"><label for="cake_name" class="form-label text-p">Cake Name</label><input type="text" class="form-control @error('cake_name') is-invalid @enderror" id="cake_name" name="cake_name" value="{{ old('cake_name') }}" required>@error('cake_name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                <div class="mb-3"><label for="description" class="form-label text-p">Description</label><textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                <div class="mb-3"><label for="price" class="form-label text-p">Price</label><input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required min="0">@error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                <div class="mb-3"><label for="flavour" class="form-label text-p">Flavour</label><input type="text" class="form-control @error('flavour') is-invalid @enderror" id="flavour" name="flavour" value="{{ old('flavour') }}" required>@error('flavour')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                <div class="mb-4"><label for="size" class="form-label text-p">Size (e.g., Small, Medium, Large)</label><input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="size" value="{{ old('size') }}" required>@error('size')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                <div class="d-grid"><button type="submit" class="btn btn-custom btn-lg">Submit Order</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer id="contact" class="bg-p text-white py-5">
        <div class="container text-center">
            <h3 class="fw-bold mb-4">Contact Us</h3>
            <p class="mb-1">Email: <a href="mailto:support@cakeworld.com">support@cakeworld.com</a></p><p class="mb-1">Phone: <a href="tel:+923001234567">+92 300 1234567</a></p><p class="mb-4">Address: Karachi, Pakistan</p>
            <div class="social-icons mb-3">
                <a href="#" class="text-white mx-2 fs-4"><i class="bi bi-facebook"></i></a><a href="#" class="text-white mx-2 fs-4"><i class="bi bi-twitter"></i></a><a href="#" class="text-white mx-2 fs-4"><i class="bi bi-instagram"></i></a><a href="#" class="text-white mx-2 fs-4"><i class="bi bi-pinterest"></i></a>
            </div>
            <p class="mb-0">&copy; {{ date('Y') }} Cake World. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
