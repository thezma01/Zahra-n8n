<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Products</h1>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="https://via.placeholder.com/200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text">Price: ${{ $product['price'] }}</p>
                            <p class="card-text">Quantity: {{ $product['quantity'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

<?php
$products = [
    ['name' => 'Product 1', 'price' => 10.99, 'quantity' => 5],
    ['name' => 'Product 2', 'price' => 9.99, 'quantity' => 10],
    ['name' => 'Product 3', 'price' => 12.99, 'quantity' => 7],
];
?>