<section class="services" id="services" aria-label="Our Services">
    <div class="container">

        <!-- Section Header -->
        <div class="section-header">
            <span class="section-label">What We Offer</span>
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="services__grid">
            @foreach ($services as $index => $service)
                <article class="service-card" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="service-card__icon-wrap" aria-hidden="true">
                        <i class="{{ $service['icon'] }} service-card__icon"></i>
                    </div>
                    <h3 class="service-card__title">{{ $service['title'] }}</h3>
                    <p class="service-card__description">{{ $service['description'] }}</p>
                    <a href="#contact" class="service-card__link">
                        Learn More
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </article>
            @endforeach
        </div>

    </div>
</section>
