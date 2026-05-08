<!-- Extend the basic layout -->
@extends('layouts.basic')

<!-- Define the content section -->
@section('content')
    <!-- Section Header -->
    <section class="text-center">
        <h1 class="mb-3">What Our Clients Say</h1>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </section>

    <!-- Testimonials Cards -->
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <img src="https://via.placeholder.com/50" class="img-fluid rounded-circle mb-3" alt="Client Image">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text text-muted">CEO, XYZ Corp</p>
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <img src="https://via.placeholder.com/50" class="img-fluid rounded-circle mb-3" alt="Client Image">
                        <h5 class="card-title">Jane Doe</h5>
                        <p class="card-text text-muted">CTO, ABC Inc</p>
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <img src="https://via.placeholder.com/50" class="img-fluid rounded-circle mb-3" alt="Client Image">
                        <h5 class="card-title">Bob Smith</h5>
                        <p class="card-text text-muted">CEO, DEF Corp</p>
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
