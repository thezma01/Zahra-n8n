@extends('layouts.app')

@section('title', 'Contact Us - Helpora')

@section('styles')
<style>
    :root {
        --primary: #27374D;
        --secondary: #526D82;
        --accent: #9DB2BF;
        --background: #DDE6ED;
    }

    body {
        background: linear-gradient(135deg, var(--background) 0%, #f8f9fa 100%);
        min-height: 100vh;
    }

    .contact-hero {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 8s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.3; }
        50% { transform: scale(1.1) rotate(180deg); opacity: 0.1; }
    }

    .contact-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        z-index: 2;
        position: relative;
    }

    .contact-hero p {
        font-size: 1.2rem;
        opacity: 0.9;
        z-index: 2;
        position: relative;
    }

    .contact-section {
        padding: 100px 0;
    }

    .contact-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(39, 55, 77, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        height: 100%;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 80px rgba(39, 55, 77, 0.2);
    }

    .contact-info-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(39, 55, 77, 0.25);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .contact-info-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        position: relative;
        z-index: 2;
    }

    .contact-info-item:last-child {
        margin-bottom: 0;
    }

    .contact-info-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 1.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .contact-info-content h5 {
        margin: 0 0 5px 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .contact-info-content p {
        margin: 0;
        opacity: 0.9;
        font-size: 0.95rem;
    }

    .form-label {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-control, .form-select {
        border: 2px solid rgba(39, 55, 77, 0.1);
        border-radius: 12px;
        padding: 15px 18px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 0.2rem rgba(157, 178, 191, 0.25);
        background: rgba(255, 255, 255, 0.95);
    }

    .form-control::placeholder {
        color: rgba(39, 55, 77, 0.5);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(39, 55, 77, 0.3);
    }

    .map-container {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(39, 55, 77, 0.15);
        height: 500px;
        position: relative;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
        filter: grayscale(0.2) contrast(1.1);
        transition: filter 0.3s ease;
    }

    .map-container:hover iframe {
        filter: grayscale(0) contrast(1.2);
    }

    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title h2 {
        color: var(--primary);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .section-title p {
        color: var(--secondary);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .floating-shapes::before,
    .floating-shapes::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: linear-gradient(45deg, var(--accent), var(--secondary));
        border-radius: 50%;
        opacity: 0.05;
        animation: float-shapes 15s ease-in-out infinite;
    }

    .floating-shapes::before {
        top: 10%;
        left: -100px;
        animation-delay: 0s;
    }

    .floating-shapes::after {
        bottom: 10%;
        right: -100px;
        animation-delay: 7s;
    }

    @keyframes float-shapes {
        0%, 100% { transform: translateY(0px) translateX(0px) rotate(0deg); }
        33% { transform: translateY(-30px) translateX(30px) rotate(120deg); }
        66% { transform: translateY(30px) translateX(-30px) rotate(240deg); }
    }

    @media (max-width: 768px) {
        .contact-hero {
            padding: 60px 0;
        }

        .contact-hero h1 {
            font-size: 2.5rem;
        }

        .contact-section {
            padding: 60px 0;
        }

        .contact-card, .contact-info-card {
            padding: 30px;
            margin-bottom: 30px;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .map-container {
            height: 300px;
            margin-top: 30px;
        }
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s ease forwards;
    }

    .fade-in:nth-child(1) { animation-delay: 0.1s; }
    .fade-in:nth-child(2) { animation-delay: 0.2s; }
    .fade-in:nth-child(3) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="contact-hero">
    <div class="floating-shapes"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="fade-in">Get In Touch</h1>
                <p class="fade-in">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Contact Information</h2>
            <p>Reach out to us through any of these channels. We're here to help you with all your needs.</p>
        </div>

        <div class="row g-4">
            <!-- Contact Info Card -->
            <div class="col-lg-4">
                <div class="contact-info-card fade-in">
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Email Address</h5>
                            <p>dsmart@gmail.com</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Phone Number</h5>
                            <p>+92 123 456 789</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Location</h5>
                            <p>Karachi, Pakistan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-card fade-in">
                    <h3 class="mb-4" style="color: var(--primary); font-weight: 600;">Send us a Message</h3>
                    <form id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="contact" name="contact" placeholder="Enter your phone number" required>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tell us how we can help you..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="section-title fade-in">
                    <h2>Find Us Here</h2>
                    <p>Visit our office or locate us on the map for in-person consultations.</p>
                </div>
                <div class="map-container fade-in">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.294991169343!2d67.0011364!3d24.8607343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e06651d4bbf%3A0x9cf92f44555a0c23!2sKarachi%2C%20Pakistan!5e0!3m2!1sen!2s!4v1699999999999!5m2!1sen!2s"
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission handling
    const contactForm = document.getElementById('contactForm');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        
        // Simulate form submission
        const submitBtn = this.querySelector('.btn-submit');
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        submitBtn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // Show success message
            submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Message Sent!';
            submitBtn.style.background = 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)';
            
            // Reset form
            this.reset();
            
            // Reset button after 3 seconds
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                submitBtn.style.background = 'linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%)';
            }, 3000);
        }, 2000);
    });
    
    // Smooth scroll animation for form inputs
    const formInputs = document.querySelectorAll('.form-control, .form-select');
    
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
            this.parentElement.style.transition = 'transform 0.2s ease';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection
