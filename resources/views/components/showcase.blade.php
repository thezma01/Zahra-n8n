<section class="showcase" id="portfolio" aria-label="Portfolio Showcase">
    <div class="container">

        <!-- Section Header -->
        <div class="section-header">
            <span class="section-label">Our Work</span>
            <h2 class="section-title">Portfolio Showcase</h2>
            <p class="section-subtitle">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.
            </p>
        </div>

        <!-- Filter Tabs -->
        <div class="showcase__filters" role="tablist" aria-label="Portfolio filter">
            <button class="showcase__filter showcase__filter--active" role="tab" aria-selected="true" data-filter="all">
                All
            </button>
            <button class="showcase__filter" role="tab" aria-selected="false" data-filter="Ecommerce">
                Ecommerce
            </button>
            <button class="showcase__filter" role="tab" aria-selected="false" data-filter="Branding">
                Branding
            </button>
            <button class="showcase__filter" role="tab" aria-selected="false" data-filter="Design">
                Design
            </button>
            <button class="showcase__filter" role="tab" aria-selected="false" data-filter="Retail">
                Retail
            </button>
        </div>

        <!-- Portfolio Grid -->
        <div class="showcase__grid">
            @foreach ($portfolioItems as $item)
                <article class="showcase__item" data-category="{{ $item['category'] }}">
                    <div class="showcase__image-wrap">
                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['title'] }} — {{ $item['category'] }} project"
                            class="showcase__image"
                            loading="lazy"
                        >
                        <div class="showcase__overlay" aria-hidden="true">
                            <div class="showcase__overlay-content">
                                <span class="showcase__category">{{ $item['category'] }}</span>
                                <h3 class="showcase__title">{{ $item['title'] }}</h3>
                                <a href="#contact" class="showcase__view-btn">
                                    <i class="fas fa-eye"></i>
                                    View Project
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="showcase__meta">
                        <h3 class="showcase__item-title">{{ $item['title'] }}</h3>
                        <span class="showcase__item-category">{{ $item['category'] }}</span>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>
