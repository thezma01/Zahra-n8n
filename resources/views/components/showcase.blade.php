<section class="showcase" id="portfolio" aria-label="Portfolio Showcase">
    <div class="showcase__container">

        {{-- Section Header --}}
        <div class="section-header" data-aos="fade-up">
            <span class="section-header__tag">Our Work</span>
            <h2 class="section-header__title">Portfolio Showcase</h2>
            <div class="section-header__divider"></div>
            <p class="section-header__subtitle">
                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                laboriosam nisi ut aliquid ex ea commodi consequatur.
            </p>
        </div>

        {{-- Filter Tabs --}}
        <div class="showcase__filters" role="tablist" aria-label="Portfolio filter">
            <button class="showcase__filter-btn showcase__filter-btn--active" data-filter="all" role="tab" aria-selected="true">
                All Work
            </button>
            <button class="showcase__filter-btn" data-filter="Ecommerce" role="tab" aria-selected="false">
                Ecommerce
            </button>
            <button class="showcase__filter-btn" data-filter="Branding" role="tab" aria-selected="false">
                Branding
            </button>
            <button class="showcase__filter-btn" data-filter="Web Development" role="tab" aria-selected="false">
                Web Dev
            </button>
        </div>

        {{-- Portfolio Grid --}}
        <div class="showcase__grid">
            @foreach($portfolioItems as $index => $item)
                <div
                    class="showcase__item"
                    data-category="{{ $item['category'] }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ ($index % 3) * 100 }}"
                >
                    <div class="showcase__image-wrapper">
                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['title'] }}"
                            class="showcase__image"
                            loading="lazy"
                        >
                        <div class="showcase__overlay">
                            <div class="showcase__overlay-content">
                                <span class="showcase__category">{{ $item['category'] }}</span>
                                <h3 class="showcase__title">{{ $item['title'] }}</h3>
                                <a href="#contact" class="showcase__view-btn" aria-label="View project: {{ $item['title'] }}">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- View All CTA --}}
        <div class="showcase__footer" data-aos="fade-up">
            <a href="#contact" class="btn btn--outline-dark">
                <span>View All Projects</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

    </div>
</section>
