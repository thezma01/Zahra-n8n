{{-- Testimonials Section Component --}}
<section class="testimonials-section" id="testimonials" aria-label="Client Testimonials">

    {{-- Section Header --}}
    <div class="container">
        <div class="testimonials-header text-center">
            <span class="testimonials-badge">
                <i class="bi bi-chat-quote-fill"></i> Client Feedback
            </span>
            <h2 class="testimonials-title">What Our Clients Say</h2>
            <p class="testimonials-subtitle">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua, ut enim ad minim veniam.
            </p>
            <div class="testimonials-divider">
                <span class="divider-line"></span>
                <span class="divider-icon"><i class="bi bi-stars"></i></span>
                <span class="divider-line"></span>
            </div>
        </div>

        {{-- Desktop Grid (3 cards per row, visible on lg+) --}}
        <div class="row g-4 testimonials-grid d-none d-lg-flex">

            {{-- Card 1 --}}
            <div class="col-lg-4 col-md-6">
                <article class="testimonial-card" role="article" aria-label="Testimonial from Sarah Mitchell">
                    <div class="card-glow"></div>
                    <div class="card-inner">
                        <div class="quote-icon" aria-hidden="true">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="star-rating" aria-label="5 out of 5 stars">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                        </div>
                        <blockquote class="testimonial-text">
                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat. Truly exceptional service!"
                        </blockquote>
                        <div class="client-info">
                            <div class="client-avatar-wrapper">
                                <img
                                    src="https://i.pravatar.cc/80?img=47"
                                    alt="Sarah Mitchell avatar"
                                    class="client-avatar"
                                    loading="lazy"
                                    width="60"
                                    height="60"
                                />
                                <span class="avatar-badge" aria-hidden="true">
                                    <i class="bi bi-patch-check-fill"></i>
                                </span>
                            </div>
                            <div class="client-details">
                                <h4 class="client-name">Sarah Mitchell</h4>
                                <p class="client-position">CEO, BrightEdge Corp</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Card 2 --}}
            <div class="col-lg-4 col-md-6">
                <article class="testimonial-card testimonial-card--featured" role="article" aria-label="Testimonial from James Hartwell">
                    <div class="card-glow"></div>
                    <div class="card-inner">
                        <div class="quote-icon" aria-hidden="true">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="star-rating" aria-label="5 out of 5 stars">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                        </div>
                        <blockquote class="testimonial-text">
                            "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident. Outstanding results delivered!"
                        </blockquote>
                        <div class="client-info">
                            <div class="client-avatar-wrapper">
                                <img
                                    src="https://i.pravatar.cc/80?img=12"
                                    alt="James Hartwell avatar"
                                    class="client-avatar"
                                    loading="lazy"
                                    width="60"
                                    height="60"
                                />
                                <span class="avatar-badge" aria-hidden="true">
                                    <i class="bi bi-patch-check-fill"></i>
                                </span>
                            </div>
                            <div class="client-details">
                                <h4 class="client-name">James Hartwell</h4>
                                <p class="client-position">Founder, Luxe Retail Co.</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Card 3 --}}
            <div class="col-lg-4 col-md-6">
                <article class="testimonial-card" role="article" aria-label="Testimonial from Amara Osei">
                    <div class="card-glow"></div>
                    <div class="card-inner">
                        <div class="quote-icon" aria-hidden="true">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="star-rating" aria-label="5 out of 5 stars">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-half" aria-hidden="true"></i>
                        </div>
                        <blockquote class="testimonial-text">
                            "Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                            accusantium doloremque laudantium totam rem aperiam eaque ipsa quae
                            ab illo inventore veritatis. Remarkable work!"
                        </blockquote>
                        <div class="client-info">
                            <div class="client-avatar-wrapper">
                                <img
                                    src="https://i.pravatar.cc/80?img=32"
                                    alt="Amara Osei avatar"
                                    class="client-avatar"
                                    loading="lazy"
                                    width="60"
                                    height="60"
                                />
                                <span class="avatar-badge" aria-hidden="true">
                                    <i class="bi bi-patch-check-fill"></i>
                                </span>
                            </div>
                            <div class="client-details">
                                <h4 class="client-name">Amara Osei</h4>
                                <p class="client-position">Head of Design, Nova Studio</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Card 4 --}}
            <div class="col-lg-4 col-md-6">
                <article class="testimonial-card" role="article" aria-label="Testimonial from David Chen">
                    <div class="card-glow"></div>
                    <div class="card-inner">
                        <div class="quote-icon" aria-hidden="true">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="star-rating" aria-label="5 out of 5 stars">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                        </div>
                        <blockquote class="testimonial-text">
                            "Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                            fugit, sed quia consequuntur magni dolores eos qui ratione sequi nesciunt.
                            Absolutely top-tier team!"
                        </blockquote>
                        <div class="client-info">
                            <div class="client-avatar-wrapper">
                                <img
                                    src="https://i.pravatar.cc/80?img=68"
                                    alt="David Chen avatar"
                                    class="client-avatar"
                                    loading="lazy"
                                    width="60"
                                    height="60"
                                />
                                <span class="avatar-badge" aria-hidden="true">
                                    <i class="bi bi-patch-check-fill"></i>
                                </span>
                            </div>
                            <div class="client-details">
                                <h4 class="client-name">David Chen</h4>
                                <p class="client-position">CTO, TechVault Inc.</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Card 5 --}}
            <div class="col-lg-4 col-md-6">
                <article class="testimonial-card" role="article" aria-label="Testimonial from Layla Romero">
                    <div class="card-glow"></div>
                    <div class="card-inner">
                        <div class="quote-icon" aria-hidden="true">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="star-rating" aria-label="5 out of 5 stars">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                        </div>
                        <blockquote class="testimonial-text">
                            "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                            molestias. Highly recommended!"
                        </blockquote>
                        <div class="client-info">
                            <div class="client-avatar-wrapper">
                                <img
                                    src="https://i.pravatar.cc/80?img=25"
                                    alt="Layla Romero avatar"
                                    class="client-avatar"
                                    loading="lazy"
                                    width="60"
                                    height="60"
                                />
                                <span class="avatar-badge" aria-hidden="true">
                                    <i class="bi bi-patch-check-fill"></i>
                                </span>
                            </div>
                            <div class="client-details">
                                <h4 class="client-name">Layla Romero</h4>
                                <p class="client-position">Marketing Director, Ember Co.</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Card 6 --}}
            <div class="col-lg-4 col-md-6">
                <article class="testimonial-card" role="article" aria-label="Testimonial from Marcus Webb">
                    <div class="card-glow"></div>
                    <div class="card-inner">
                        <div class="quote-icon" aria-hidden="true">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="star-rating" aria-label="5 out of 5 stars">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <i class="bi bi-star-half" aria-hidden="true"></i>
                        </div>
                        <blockquote class="testimonial-text">
                            "Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus
                            saepe eveniet ut et voluptates repudiandae sint molestiae non recusandae.
                            Truly a premium experience!"
                        </blockquote>
                        <div class="client-info">
                            <div class="client-avatar-wrapper">
                                <img
                                    src="https://i.pravatar.cc/80?img=53"
                                    alt="Marcus Webb avatar"
                                    class="client-avatar"
                                    loading="lazy"
                                    width="60"
                                    height="60"
                                />
                                <span class="avatar-badge" aria-hidden="true">
                                    <i class="bi bi-patch-check-fill"></i>
                                </span>
                            </div>
                            <div class="client-details">
                                <h4 class="client-name">Marcus Webb</h4>
                                <p class="client-position">COO, Prestige Brands</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

        </div>
        {{-- End Desktop Grid --}}

        {{-- Bootstrap Carousel (visible on < lg) --}}
        <div
            id="testimonialsCarousel"
            class="carousel slide d-lg-none testimonials-carousel"
            data-bs-ride="carousel"
            data-bs-interval="4500"
            aria-label="Testimonials Carousel"
        >
            <div class="carousel-inner">

                {{-- Slide 1 --}}
                <div class="carousel-item active">
                    <div class="row g-4 justify-content-center">
                        <div class="col-sm-10 col-md-6">
                            <article class="testimonial-card" role="article" aria-label="Testimonial from Sarah Mitchell">
                                <div class="card-glow"></div>
                                <div class="card-inner">
                                    <div class="quote-icon" aria-hidden="true"><i class="bi bi-quote"></i></div>
                                    <div class="star-rating" aria-label="5 out of 5 stars">
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    </div>
                                    <blockquote class="testimonial-text">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim
                                        veniam, quis nostrud exercitation ullamco laboris. Truly exceptional service!"
                                    </blockquote>
                                    <div class="client-info">
                                        <div class="client-avatar-wrapper">
                                            <img src="https://i.pravatar.cc/80?img=47" alt="Sarah Mitchell" class="client-avatar" loading="lazy" width="60" height="60"/>
                                            <span class="avatar-badge" aria-hidden="true"><i class="bi bi-patch-check-fill"></i></span>
                                        </div>
                                        <div class="client-details">
                                            <h4 class="client-name">Sarah Mitchell</h4>
                                            <p class="client-position">CEO, BrightEdge Corp</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 d-none d-md-block">
                            <article class="testimonial-card testimonial-card--featured" role="article" aria-label="Testimonial from James Hartwell">
                                <div class="card-glow"></div>
                                <div class="card-inner">
                                    <div class="quote-icon" aria-hidden="true"><i class="bi bi-quote"></i></div>
                                    <div class="star-rating" aria-label="5 out of 5 stars">
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    </div>
                                    <blockquote class="testimonial-text">
                                        "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                        dolore eu fugiat nulla pariatur. Outstanding results delivered!"
                                    </blockquote>
                                    <div class="client-info">
                                        <div class="client-avatar-wrapper">
                                            <img src="https://i.pravatar.cc/80?img=12" alt="James Hartwell" class="client-avatar" loading="lazy" width="60" height="60"/>
                                            <span class="avatar-badge" aria-hidden="true"><i class="bi bi-patch-check-fill"></i></span>
                                        </div>
                                        <div class="client-details">
                                            <h4 class="client-name">James Hartwell</h4>
                                            <p class="client-position">Founder, Luxe Retail Co.</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div class="carousel-item">
                    <div class="row g-4 justify-content-center">
                        <div class="col-sm-10 col-md-6">
                            <article class="testimonial-card" role="article" aria-label="Testimonial from Amara Osei">
                                <div class="card-glow"></div>
                                <div class="card-inner">
                                    <div class="quote-icon" aria-hidden="true"><i class="bi bi-quote"></i></div>
                                    <div class="star-rating" aria-label="4.5 out of 5 stars">
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-half" aria-hidden="true"></i>
                                    </div>
                                    <blockquote class="testimonial-text">
                                        "Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                        accusantium doloremque laudantium. Remarkable work!"
                                    </blockquote>
                                    <div class="client-info">
                                        <div class="client-avatar-wrapper">
                                            <img src="https://i.pravatar.cc/80?img=32" alt="Amara Osei" class="client-avatar" loading="lazy" width="60" height="60"/>
                                            <span class="avatar-badge" aria-hidden="true"><i class="bi bi-patch-check-fill"></i></span>
                                        </div>
                                        <div class="client-details">
                                            <h4 class="client-name">Amara Osei</h4>
                                            <p class="client-position">Head of Design, Nova Studio</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 d-none d-md-block">
                            <article class="testimonial-card" role="article" aria-label="Testimonial from David Chen">
                                <div class="card-glow"></div>
                                <div class="card-inner">
                                    <div class="quote-icon" aria-hidden="true"><i class="bi bi-quote"></i></div>
                                    <div class="star-rating" aria-label="5 out of 5 stars">
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    </div>
                                    <blockquote class="testimonial-text">
                                        "Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                                        fugit. Absolutely top-tier team!"
                                    </blockquote>
                                    <div class="client-info">
                                        <div class="client-avatar-wrapper">
                                            <img src="https://i.pravatar.cc/80?img=68" alt="David Chen" class="client-avatar" loading="lazy" width="60" height="60"/>
                                            <span class="avatar-badge" aria-hidden="true"><i class="bi bi-patch-check-fill"></i></span>
                                        </div>
                                        <div class="client-details">
                                            <h4 class="client-name">David Chen</h4>
                                            <p class="client-position">CTO, TechVault Inc.</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>

                {{-- Slide 3 --}}
                <div class="carousel-item">
                    <div class="row g-4 justify-content-center">
                        <div class="col-sm-10 col-md-6">
                            <article class="testimonial-card" role="article" aria-label="Testimonial from Layla Romero">
                                <div class="card-glow"></div>
                                <div class="card-inner">
                                    <div class="quote-icon" aria-hidden="true"><i class="bi bi-quote"></i></div>
                                    <div class="star-rating" aria-label="5 out of 5 stars">
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    </div>
                                    <blockquote class="testimonial-text">
                                        "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                        praesentium. Highly recommended!"
                                    </blockquote>
                                    <div class="client-info">
                                        <div class="client-avatar-wrapper">
                                            <img src="https://i.pravatar.cc/80?img=25" alt="Layla Romero" class="client-avatar" loading="lazy" width="60" height="60"/>
                                            <span class="avatar-badge" aria-hidden="true"><i class="bi bi-patch-check-fill"></i></span>
                                        </div>
                                        <div class="client-details">
                                            <h4 class="client-name">Layla Romero</h4>
                                            <p class="client-position">Marketing Director, Ember Co.</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 d-none d-md-block">
                            <article class="testimonial-card" role="article" aria-label="Testimonial from Marcus Webb">
                                <div class="card-glow"></div>
                                <div class="card-inner">
                                    <div class="quote-icon" aria-hidden="true"><i class="bi bi-quote"></i></div>
                                    <div class="star-rating" aria-label="4.5 out of 5 stars">
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <i class="bi bi-star-half" aria-hidden="true"></i>
                                    </div>
                                    <blockquote class="testimonial-text">
                                        "Temporibus autem quibusdam et aut officiis debitis aut rerum
                                        necessitatibus saepe eveniet. Truly a premium experience!"
                                    </blockquote>
                                    <div class="client-info">
                                        <div class="client-avatar-wrapper">
                                            <img src="https://i.pravatar.cc/80?img=53" alt="Marcus Webb" class="client-avatar" loading="lazy" width="60" height="60"/>
                                            <span class="avatar-badge" aria-hidden="true"><i class="bi bi-patch-check-fill"></i></span>
                                        </div>
                                        <div class="client-details">
                                            <h4 class="client-name">Marcus Webb</h4>
                                            <p class="client-position">COO, Prestige Brands</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Carousel Controls --}}
            <button
                class="carousel-control-prev testimonials-carousel__prev"
                type="button"
                data-bs-target="#testimonialsCarousel"
                data-bs-slide="prev"
                aria-label="Previous testimonial"
            >
                <span class="testimonials-carousel__arrow" aria-hidden="true">
                    <i class="bi bi-chevron-left"></i>
                </span>
            </button>
            <button
                class="carousel-control-next testimonials-carousel__next"
                type="button"
                data-bs-target="#testimonialsCarousel"
                data-bs-slide="next"
                aria-label="Next testimonial"
            >
                <span class="testimonials-carousel__arrow" aria-hidden="true">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </button>

            {{-- Carousel Indicators --}}
            <div class="carousel-indicators testimonials-carousel__indicators">
                <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

        </div>
        {{-- End Carousel --}}

        {{-- Stats Bar --}}
        <div class="testimonials-stats" role="region" aria-label="Client satisfaction statistics">
            <div class="testimonials-stats__item">
                <span class="stats-number" data-target="98">0</span><span class="stats-symbol">%</span>
                <span class="stats-label">Client Satisfaction</span>
            </div>
            <div class="testimonials-stats__divider" aria-hidden="true"></div>
            <div class="testimonials-stats__item">
                <span class="stats-number" data-target="500">0</span><span class="stats-symbol">+</span>
                <span class="stats-label">Happy Clients</span>
            </div>
            <div class="testimonials-stats__divider" aria-hidden="true"></div>
            <div class="testimonials-stats__item">
                <span class="stats-number" data-target="12">0</span><span class="stats-symbol">+</span>
                <span class="stats-label">Years Experience</span>
            </div>
            <div class="testimonials-stats__divider" aria-hidden="true"></div>
            <div class="testimonials-stats__item">
                <span class="stats-number" data-target="45">0</span><span class="stats-symbol">+</span>
                <span class="stats-label">Awards Won</span>
            </div>
        </div>

    </div>
</section>
