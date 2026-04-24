<section class="showcase" id="portfolio">
    <div class="container">

        <div class="section-header">
            <span class="section-label">Our Work</span>
            <h2 class="section-title">Portfolio Showcase</h2>
            <div class="section-divider"></div>
            <p class="section-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua ut enim ad minim veniam.
            </p>
        </div>

        {{-- Filter Tabs --}}
        <div class="showcase__filters">
            <button class="showcase__filter showcase__filter--active" data-filter="all">All</button>
            <button class="showcase__filter" data-filter="Ecommerce">Ecommerce</button>
            <button class="showcase__filter" data-filter="Product Design">Product Design</button>
            <button class="showcase__filter" data-filter="Branding">Branding</button>
            <button class="showcase__filter" data-filter="Web Development">Web Development</button>
        </div>

        <div class="showcase__grid">
            @foreach ($portfolioItems as $item)
                <div class="showcase__item" data-category="{{ $item['category'] }}">
                    <div class="showcase__image-wrapper">
                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['title'] }}"
                            class="showcase__image"
                            loading="lazy"
                        />
                        <div class="showcase__overlay">
                            <div class="showcase__overlay-content">
                                <span class="showcase__category">{{ $item['category'] }}</span>
                                <h3 class="showcase__title">{{ $item['title'] }}</h3>
                                <a href="#" class="showcase__view-btn">
                                    <i class="fas fa-eye"></i> View Project
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
