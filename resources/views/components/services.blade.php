<section class="services" id="services" aria-label="Our services">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">What We Offer</span>
            <h2 class="section-title">Our Core Services</h2>
            <p class="section-subtitle">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>

        <div class="services__grid">
            @foreach ($services as $index => $service)
                <div class="service-card" data-animate="fade-up" data-delay="{{ $index * 100 }}">
                    <div class="service-card__icon-wrap">
                        <i class="{{ $service['icon'] }} service-card__icon" aria-hidden="true"></i>
                    </div>
                    <h3 class="service-card__title">{{ $service['title'] }}</h3>
                    <p class="service-card__desc">{{ $service['description'] }}</p>
                    <a href="#contact" class="service-card__link">
                        Learn More <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
