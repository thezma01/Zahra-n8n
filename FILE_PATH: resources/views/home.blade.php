<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake World</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FAE3C6;
        }
        .navbar {
            background-color: #533B4D;
        }
        .banner {
            background-image: url('https://static.vecteezy.com/system/resources/previews/001/447/454/non_2x/bakery-daily-fresh-cake-donut-and-cupcake-banner-vector.jpg');
            height: 100vh;
            background-size: cover;
            background-position: center;
        }
        .about {
            background-color: #F564A9;
            padding: 20px;
        }
        .order-form {
            background-color: #FAA4BD;
            padding: 20px;
        }
        .footer {
            background-color: #533B4D;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cake World</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h1 class="display-4">Welcome to Cake World</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <img src="https://assets.epicurious.com/photos/62b9e092ba4911ad9d7f93ac/4:3/w_5005,h_3754,c_limit/ChiffonCake_HERO_062322_36161.jpg" alt="Chiffon Cake" class="img-fluid">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="order-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Order Form</h2>
                            <form method="POST" action="{{ route('home.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="cake_name" class="form-label">Cake Name</label>
                                    <input type="text" class="form-control" id="cake_name" name="cake_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="flavour" class="form-label">Flavour</label>
                                    <input type="text" class="form-control" id="flavour" name="flavour" required>
                                </div>
                                <div class="mb-3">
                                    <label for="size" class="form-label">Size</label>
                                    <input type="text" class="form-control" id="size" name="size" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Order Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <p>&copy; 2024 Cake World</p>
                    <p>Email: <a href="mailto:support@cakeworld.com">support@cakeworld.com</a></p>
                    <p>Phone: +92 300 1234567</p>
                    <p>Address: Karachi, Pakistan</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
