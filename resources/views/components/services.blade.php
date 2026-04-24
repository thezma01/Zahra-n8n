<section class="services" id="services" aria-label="Our Services">
    <div class="services__container">

        {{-- Section Header --}}
        <div class="section-header section-header--light" data-aos="fade-up">
            <span class="section-header__tag">What We Offer</span>
            <h2 class="section-header__title">Our Services</h2>
            <div class="section-header__divider"></div>
            <p class="section-header__subtitle">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua ut enim ad minim veniam.
            </p>
        </div>

        {{-- Services Grid --}}
        <div class="services__grid">
            @foreach($services as $index => $service)
                <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="service-card__icon-wrapper">
                        <i class="{{ $service['icon'] }} service-card__icon"></i>
                    </div>
                    <h3 class="service-card__title">{{ $service['title'] }}</h3>
                    <p class="service-card__description">{{ $service['description'] }}</p>
                    <a href="#contact" class="service-card__link">
                        <span>Learn More</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>
