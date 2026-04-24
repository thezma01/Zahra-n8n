<section class="services" id="services">
    <div class="container">

        <div class="section-header section-header--light">
            <span class="section-label section-label--light">What We Offer</span>
            <h2 class="section-title section-title--light">Our Services</h2>
            <div class="section-divider section-divider--light"></div>
            <p class="section-description section-description--light">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua ut enim ad minim veniam.
            </p>
        </div>

        <div class="services__grid">
            @foreach ($services as $index => $service)
                <div class="services__card" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="services__card-icon">
                        <i class="{{ $service['icon'] }}"></i>
                    </div>
                    <h3 class="services__card-title">{{ $service['title'] }}</h3>
                    <p class="services__card-description">{{ $service['description'] }}</p>
                    <a href="#contact" class="services__card-link">
                        Learn More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>
