<!-- Extend the basic layout -->
@extends('layout')

<!-- Define the content section -->
@section('content')
    <!-- Section Header -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="mb-3">What Our Clients Say</h1>
                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
    </div>

    <!-- Testimonials Cards -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/100" alt="Client Image" class="img-fluid rounded-circle mb-3">
                        <h5>John Doe</h5>
                        <p>CEO, XYZ Corp</p>
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/100" alt="Client Image" class="img-fluid rounded-circle mb-3">
                        <h5>Jane Doe</h5>
                        <p>CTO, ABC Inc</p>
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/100" alt="Client Image" class="img-fluid rounded-circle mb-3">
                        <h5>Bob Smith</h5>
                        <p>CMO, DEF Corp</p>
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
