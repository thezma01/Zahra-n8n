<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/testimonials.css') }}">
</head>
<body>

<section class="py-5 mt-4">
    <div class="container">

        {{-- Section Header --}}
        <div class="section-header text-center mb-5">
            <span class="badge-pill text-uppercase fw-semibold mb-3 d-inline-block">Client Reviews</span>
            <h2 class="mb-2">What Our Clients Say</h2>
            <div class="divider-line"></div>
            <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna vel scelerisque nisl consectetur.</p>
        </div>

        {{-- Desktop Grid (md+) --}}
        <div class="row g-4 d-none d-md-flex">
            @foreach($testimonials as $t)
            <div class="col-md-4">
                <div class="testimonial-card card p-4">
                    <div class="quote-icon mb-2"><i class="bi bi-quote"></i></div>
                    <p class="card-text mb-4">{{ $t['text'] }}</p>
                    <div class="stars mb-3">
                        @for($s = 1; $s <= 5; $s++)
                            <i class="bi {{ $s <= $t['rating'] ? 'bi-star-fill' : 'bi-star' }}"></i>
                        @endfor
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $t['image'] }}" alt="{{ $t['name'] }}" class="avatar rounded-circle">
                        <div>
                            <div class="client-name">{{ $t['name'] }}</div>
                            <div class="client-position">{{ $t['position'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Mobile Carousel (below md) --}}
        <div id="testimonialsCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($testimonials as $index => $t)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }} px-2 pb-4">
                    <div class="testimonial-card card p-4 mx-auto" style="max-width:420px;">
                        <div class="quote-icon mb-2"><i class="bi bi-quote"></i></div>
                        <p class="card-text mb-4">{{ $t['text'] }}</p>
                        <div class="stars mb-3">
                            @for($s = 1; $s <= 5; $s++)
                                <i class="bi {{ $s <= $t['rating'] ? 'bi-star-fill' : 'bi-star' }}"></i>
                            @endfor
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $t['image'] }}" alt="{{ $t['name'] }}" class="avatar rounded-circle">
                            <div>
                                <div class="client-name">{{ $t['name'] }}</div>
                                <div class="client-position">{{ $t['position'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center gap-2 mt-3">
                <button class="btn btn-sm rounded-circle" style="background:#C69B7B;width:10px;height:10px;padding:0;" data-bs-target="#testimonialsCarousel" data-bs-slide="prev"></button>
                <button class="btn btn-sm rounded-circle" style="background:#C69B7B;width:10px;height:10px;padding:0;" data-bs-target="#testimonialsCarousel" data-bs-slide="next"></button>
            </div>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/testimonials.js') }}"></script>
</body>
</html>
