@extends('layouts.app')

@section('title', 'Portfolio - Elevating Your Ecommerce Experience')

@section('content')

<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="hero-image" style="background-image: url('{{ $portfolioData['hero']['image'] }}');"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <h1 class="hero-title animate-fade-in">{{ $portfolioData['hero']['title'] }}</h1>
            <p class="hero-tagline animate-fade-in-delay">{{ $portfolioData['hero']['tagline'] }}</p>
            <a href="#about" class="btn btn-primary animate-fade-in-delay-2">Explore More</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <h2 class="section-title">{{ $portfolioData['about']['title'] }}</h2>
                <div class="title-underline"></div>
                <p class="about-description">{{ $portfolioData['about']['description'] }}</p>
                <div class="about-details">
                    <div class="detail-item">
                        <h4><i class="fas fa-bullseye"></i> Our Mission</h4>
                        <p>{{ $portfolioData['about']['mission'] }}</p>
                    </div>
                    <div class="detail-item">
                        <h4><i class="fas fa-eye"></i> Our Vision</h4>
                        <p>{{ $portfolioData['about']['vision'] }}</p>
                    </div>
                </div>
            </div>
            <div class="about-image">
                <img src="{{ $portfolioData['about']['image'] }}" alt="About Company">
                <div class="image-overlay"></div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our Services</h2>
            <div class="title-underline"></div>
            <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        </div>
        <div class="services-grid">
            @foreach($portfolioData['services'] as $service)
            <div class="service-card">
                <div class="service-icon">{{ $service['icon'] }}</div>
                <h3 class="service-title">{{ $service['title'] }}</h3>
                <p class="service-description">{{ $service['description'] }}</p>
                <div class="service-hover-effect"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="portfolio-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our Portfolio</h2>
            <div class="title-underline"></div>
            <p class="section-subtitle">Explore our latest projects and achievements</p>
        </div>
        <div class="portfolio-grid">
            @foreach($portfolioData['portfolio_items'] as $item)
            <div class="portfolio-item">
                <div class="portfolio-image">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                    <div class="portfolio-overlay">
                        <div class="portfolio-content">
                            <h3>{{ $item['title'] }}</h3>
                            <a href="#" class="portfolio-link">View Project <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="contact" class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Let's Build Something Amazing Together</h2>
            <p class="cta-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="{{ route('contact') }}" class="btn btn-light">Contact Us</a>
        </div>
    </div>
</section>

@endsection
