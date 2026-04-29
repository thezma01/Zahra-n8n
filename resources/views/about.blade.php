@extends('layouts.app')

@section('title', 'About Us – dSmart Solutions')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')

<!-- ===================== HERO SECTION ===================== -->
<section class="about-hero" id="about-hero">
    <div class="about-hero__overlay"></div>
    <div class="about-hero__content">
        <span class="about-hero__badge">About dSmart Solutions</span>
        <h1 class="about-hero__title">
            dSmart Solutions –<br>
            <span class="about-hero__title--accent">Your Company Best Solution</span>
        </h1>
        <p class="about-hero__subtitle">
            We build scalable, modern &amp; high-performance digital products
        </p>
        <div class="about-hero__actions">
            <a href="#contact-cta" class="btn btn--primary">
                <i class="fas fa-rocket"></i>
                Get Started
            </a>
            <a href="#services" class="btn btn--secondary">
                <i class="fas fa-compass"></i>
                Explore Services
            </a>
        </div>
    </div>
    <div class="about-hero__scroll-indicator">
        <div class="about-hero__scroll-dot"></div>
    </div>
</section>

<!-- ===================== ABOUT COMPANY SECTION ===================== -->
<section class="about-company" id="about-company">
    <div class="about-company__container">
        <div class="about-company__left">
            <span class="section-badge">Who We Are</span>
            <h2 class="section-title">Crafting Digital Excellence <span class="text-accent">Since Day One</span></h2>
            <p class="about-company__text">
                dSmart Solutions is a forward-thinking software house dedicated to delivering cutting-edge digital experiences. We partner with businesses of all sizes to transform their vision into reality through innovative technology and creative problem-solving.
            </p>
            <p class="about-company__text">
                Our team of seasoned engineers, designers, and strategists work in harmony to produce software that is not only visually stunning but architecturally sound. We believe great software is the intersection of elegant design and robust engineering.
            </p>
            <p class="about-company__text">
                From startups looking to launch their MVP to enterprises seeking digital transformation, dSmart Solutions provides tailored solutions that drive measurable results and long-term growth.
            </p>
            <div class="about-company__highlights">
                <div class="about-company__highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Agile Development Methodology</span>
                </div>
                <div class="about-company__highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Client-Centric Approach</span>
                </div>
                <div class="about-company__highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>End-to-End Digital Solutions</span>
                </div>
                <div class="about-company__highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Transparent Communication</span>
                </div>
            </div>
        </div>
        <div class="about-company__right">
            <div class="about-company__cards">
                <div class="about-company__card about-company__card--top">
                    <div class="about-company__card-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4>Our Mission</h4>
                    <p>To empower businesses through intelligent software solutions that solve real-world challenges and unlock new opportunities.</p>
                </div>
                <div class="about-company__card about-company__card--bottom">
                    <div class="about-company__card-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4>Our Vision</h4>
                    <p>To be the most trusted software partner for companies globally, recognized for quality, reliability, and innovation.</p>
                </div>
                <div class="about-company__card about-company__card--accent">
                    <div class="about-company__card-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Our Values</h4>
                    <p>Integrity, excellence, collaboration, and continuous improvement drive everything we do at dSmart Solutions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== STATS SECTION ===================== -->
<section class="about-stats" id="about-stats">
    <div class="about-stats__container">
        <div class="about-stats__header">
            <span class="section-badge section-badge--white">Our Achievements</span>
            <h2 class="section-title section-title--white">Numbers That <span class="text-accent-light">Speak for Themselves</span></h2>
        </div>
        <div class="about-stats__grid">
            <div class="about-stats__card" data-target="250" data-suffix="+">
                <div class="about-stats__icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div class="about-stats__number">
                    <span class="counter" data-target="250">0</span><span class="about-stats__suffix">+</span>
                </div>
                <p class="about-stats__label">Projects Completed</p>
                <div class="about-stats__bar"></div>
            </div>
            <div class="about-stats__card" data-target="180" data-suffix="+">
                <div class="about-stats__icon">
                    <i class="fas fa-smile"></i>
                </div>
                <div class="about-stats__number">
                    <span class="counter" data-target="180">0</span><span class="about-stats__suffix">+</span>
                </div>
                <p class="about-stats__label">Happy Clients</p>
                <div class="about-stats__bar"></div>
            </div>
            <div class="about-stats__card" data-target="45" data-suffix="+">
                <div class="about-stats__icon">
                    <i class="fas fa-code"></i>
                </div>
                <div class="about-stats__number">
                    <span class="counter" data-target="45">0</span><span class="about-stats__suffix">+</span>
                </div>
                <p class="about-stats__label">Active Developers</p>
                <div class="about-stats__bar"></div>
            </div>
            <div class="about-stats__card" data-target="8" data-suffix="+">
                <div class="about-stats__icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="about-stats__number">
                    <span class="counter" data-target="8">0</span><span class="about-stats__suffix">+</span>
                </div>
                <p class="about-stats__label">Years of Experience</p>
                <div class="about-stats__bar"></div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== SERVICES SECTION ===================== -->
<section class="about-services" id="services">
    <div class="about-services__container">
        <div class="about-services__header">
            <span class="section-badge">What We Offer</span>
            <h2 class="section-title">Our <span class="text-accent">Core Services</span></h2>
            <p class="about-services__subtitle">
                From concept to deployment, we provide comprehensive digital solutions tailored to your business needs.
            </p>
        </div>
        <div class="about-services__grid">
            <div class="service-card">
                <div class="service-card__icon-wrap">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 class="service-card__title">Web Development</h3>
                <p class="service-card__desc">
                    We craft high-performance, responsive web applications using modern frameworks. From landing pages to complex enterprise portals, we deliver pixel-perfect results.
                </p>
                <div class="service-card__tags">
                    <span>React</span>
                    <span>Laravel</span>
                    <span>Vue</span>
                </div>
                <a href="#contact-cta" class="service-card__link">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="service-card">
                <div class="service-card__icon-wrap">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="service-card__title">Mobile App Development</h3>
                <p class="service-card__desc">
                    Native and cross-platform mobile applications for iOS and Android. We create intuitive, feature-rich apps that delight users and drive engagement.
                </p>
                <div class="service-card__tags">
                    <span>Flutter</span>
                    <span>React Native</span>
                    <span>Swift</span>
                </div>
                <a href="#contact-cta" class="service-card__link">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="service-card">
                <div class="service-card__icon-wrap">
                    <i class="fas fa-pencil-ruler"></i>
                </div>
                <h3 class="service-card__title">UI/UX Design</h3>
                <p class="service-card__desc">
                    User-centered design that balances aesthetics and functionality. We create wireframes, prototypes, and production-ready designs that convert visitors into customers.
                </p>
                <div class="service-card__tags">
                    <span>Figma</span>
                    <span>Prototyping</span>
                    <span>Research</span>
                </div>
                <a href="#contact-cta" class="service-card__link">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="service-card">
                <div class="service-card__icon-wrap">
                    <i class="fas fa-plug"></i>
                </div>
                <h3 class="service-card__title">API Development</h3>
                <p class="service-card__desc">
                    Robust, scalable RESTful and GraphQL APIs that power your applications. We ensure secure, well-documented endpoints that integrate seamlessly with any platform.
                </p>
                <div class="service-card__tags">
                    <span>REST</span>
                    <span>GraphQL</span>
                    <span>Microservices</span>
                </div>
                <a href="#contact-cta" class="service-card__link">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="service-card">
                <div class="service-card__icon-wrap">
                    <i class="fas fa-cogs"></i>
                </div>
                <h3 class="service-card__title">Custom Software Solutions</h3>
                <p class="service-card__desc">
                    Bespoke software engineered specifically for your business processes. We analyze your workflow and build solutions that eliminate bottlenecks and maximize efficiency.
                </p>
                <div class="service-card__tags">
                    <span>Enterprise</span>
                    <span>Automation</span>
                    <span>SaaS</span>
                </div>
                <a href="#contact-cta" class="service-card__link">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="service-card service-card--cta">
                <div class="service-card__cta-inner">
                    <i class="fas fa-headset"></i>
                    <h3>Have a Project in Mind?</h3>
                    <p>Let's discuss your requirements and turn your vision into reality.</p>
                    <a href="#contact-cta" class="btn btn--primary btn--small">
                        Talk to Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== TEAM SECTION ===================== -->
<section class="about-team" id="team">
    <div class="about-team__container">
        <div class="about-team__image-wrap">
            <div class="about-team__image-inner">
                <img
                    src="https://i.pinimg.com/originals/40/a2/6b/40a26b462ef63e503e99c1c8e8dbb32d.jpg"
                    alt="dSmart Solutions Team"
                    class="about-team__image"
                    loading="lazy"
                >
                <div class="about-team__image-badge">
                    <i class="fas fa-users"></i>
                    <span>50+ Team Members</span>
                </div>
            </div>
        </div>
        <div class="about-team__content">
            <span class="section-badge">The People Behind</span>
            <h2 class="section-title">Meet Our <span class="text-accent">Expert Team</span></h2>
            <p class="about-team__text">
                Behind every successful project is our dedicated team of passionate professionals. Our diverse group of engineers, designers, and product strategists bring together years of expertise across industries and technologies.
            </p>
            <p class="about-team__text">
                We foster a culture of continuous learning, collaboration, and innovation. Every team member at dSmart Solutions is committed to delivering excellence and pushing the boundaries of what's possible in software development.
            </p>
            <div class="about-team__perks">
                <div class="about-team__perk">
                    <div class="about-team__perk-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <h5>Continuous Learning</h5>
                        <p>Regular training, workshops, and conference participation</p>
                    </div>
                </div>
                <div class="about-team__perk">
                    <div class="about-team__perk-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <div>
                        <h5>Work-Life Balance</h5>
                        <p>Flexible working environment that promotes wellbeing</p>
                    </div>
                </div>
                <div class="about-team__perk">
                    <div class="about-team__perk-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div>
                        <h5>Career Growth</h5>
                        <p>Clear career paths with mentorship from industry leaders</p>
                    </div>
                </div>
            </div>
            <a href="#contact-cta" class="btn btn--primary">
                <i class="fas fa-user-plus"></i>
                Join Our Team
            </a>
        </div>
    </div>
</section>

<!-- ===================== WHY CHOOSE US SECTION ===================== -->
<section class="about-why" id="why-us">
    <div class="about-why__container">
        <div class="about-why__header">
            <span class="section-badge">Why dSmart</span>
            <h2 class="section-title">Why <span class="text-accent">Choose Us</span></h2>
            <p class="about-why__subtitle">
                We go beyond just writing code. We are your strategic technology partner, committed to your success at every stage.
            </p>
        </div>
        <div class="about-why__grid">
            <div class="why-card">
                <div class="why-card__icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="why-card__content">
                    <h3>Fast Delivery</h3>
                    <p>We prioritize speed without compromising quality. Our agile sprints ensure your project reaches milestones on time, every time, reducing time-to-market significantly.</p>
                </div>
                <div class="why-card__number">01</div>
            </div>
            <div class="why-card">
                <div class="why-card__icon">
                    <i class="fas fa-sitemap"></i>
                </div>
                <div class="why-card__content">
                    <h3>Clean Architecture</h3>
                    <p>Our engineers follow industry best practices and design patterns to build maintainable, testable, and extensible codebases that stand the test of time.</p>
                </div>
                <div class="why-card__number">02</div>
            </div>
            <div class="why-card">
                <div class="why-card__icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="why-card__content">
                    <h3>24/7 Support</h3>
                    <p>Our dedicated support team is always available to handle critical issues, provide updates, and ensure your systems run smoothly around the clock.</p>
                </div>
                <div class="why-card__number">03</div>
            </div>
            <div class="why-card">
                <div class="why-card__icon">
                    <i class="fas fa-expand-arrows-alt"></i>
                </div>
                <div class="why-card__content">
                    <h3>Scalable Systems</h3>
                    <p>We architect solutions designed to grow with your business. From 100 to 1 million users, our systems handle scale effortlessly with zero disruption.</p>
                </div>
                <div class="why-card__number">04</div>
            </div>
            <div class="why-card">
                <div class="why-card__icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="why-card__content">
                    <h3>Security First</h3>
                    <p>Security is baked into every layer of our development process. We follow OWASP standards and conduct regular security audits to keep your data protected.</p>
                </div>
                <div class="why-card__number">05</div>
            </div>
            <div class="why-card">
                <div class="why-card__icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="why-card__content">
                    <h3>Trusted Partnership</h3>
                    <p>We build long-term relationships with our clients. Your success is our success, and we are invested in your growth beyond just project delivery.</p>
                </div>
                <div class="why-card__number">06</div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== CTA SECTION ===================== -->
<section class="about-cta" id="contact-cta">
    <div class="about-cta__particles">
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="about-cta__container">
        <div class="about-cta__icon">
            <i class="fas fa-rocket"></i>
        </div>
        <h2 class="about-cta__title">
            Let's Build Something <span>Powerful Together</span><br>with dSmart Solutions
        </h2>
        <p class="about-cta__subtitle">
            Have a project in mind? We'd love to hear about it. Let's schedule a free consultation and explore how we can help you achieve your goals.
        </p>
        <div class="about-cta__actions">
            <a href="{{ route('contact') }}" class="btn btn--white">
                <i class="fas fa-envelope"></i>
                Contact Us
            </a>
            <a href="tel:+1234567890" class="btn btn--outline-white">
                <i class="fas fa-phone"></i>
                Call Us Now
            </a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <script src="{{ asset('js/about.js') }}"></script>
@endsection
