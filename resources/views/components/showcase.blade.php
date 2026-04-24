<section class="showcase" id="portfolio" aria-label="Portfolio showcase">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Our Work</span>
            <h2 class="section-title">Featured Projects</h2>
            <p class="section-subtitle">
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat duis aute irure.
            </p>
        </div>

        <div class="showcase__grid">
            @foreach ($portfolioItems as $item)
                <article class="showcase-card" data-animate="fade-up">
                    <div class="showcase-card__image-wrap">
                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['title'] }}"
                            class="showcase-card__image"
                            loading="lazy"
                        />
                        <div class="showcase-card__overlay">
                            <div class="showcase-card__overlay-content">
                                <span class="showcase-card__category">{{ $item['category'] }}</span>
                                <h3 class="showcase-card__title">{{ $item['title'] }}</h3>
                                <a href="#contact" class="showcase-card__btn" aria-label="View project: {{ $item['title'] }}">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="showcase__footer">
            <a href="#contact" class="btn btn--primary">View All Projects</a>
        </div>
    </div>
</section>
