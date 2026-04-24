<footer class="footer" aria-label="Site Footer">
    <div class="footer__top">
        <div class="container">
            <div class="footer__grid">

                <!-- Company Info -->
                <div class="footer__col footer__col--brand">
                    <a href="{{ route('portfolio') }}" class="footer__logo" aria-label="LuxeBrand Home">
                        <span class="footer__logo-icon" aria-hidden="true">
                            <i class="fas fa-gem"></i>
                        </span>
                        <span class="footer__logo-text">LuxeBrand</span>
                    </a>
                    <p class="footer__description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua ut enim ad minim.
                    </p>
                    <!-- Social Icons -->
                    <div class="footer__socials">
                        <a href="#" class="footer__social" aria-label="Follow us on Facebook" rel="noopener">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="footer__social" aria-label="Follow us on Instagram" rel="noopener">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="footer__social" aria-label="Follow us on Twitter" rel="noopener">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="footer__social" aria-label="Connect on LinkedIn" rel="noopener">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="footer__social" aria-label="Watch us on YouTube" rel="noopener">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer__col">
                    <h3 class="footer__heading">Quick Links</h3>
                    <ul class="footer__links">
                        <li><a href="#home" class="footer__link">Home</a></li>
                        <li><a href="#about" class="footer__link">About Us</a></li>
                        <li><a href="#services" class="footer__link">Services</a></li>
                        <li><a href="#portfolio" class="footer__link">Portfolio</a></li>
                        <li><a href="{{ route('contact') }}" class="footer__link">Contact</a></li>
                    </ul>
                </div>

                <!-- Services Links -->
                <div class="footer__col">
                    <h3 class="footer__heading">Services</h3>
                    <ul class="footer__links">
                        <li><a href="#services" class="footer__link">Product Design</a></li>
                        <li><a href="#services" class="footer__link">Ecommerce Solutions</a></li>
                        <li><a href="#services" class="footer__link">Digital Marketing</a></li>
                        <li><a href="#services" class="footer__link">Mobile Development</a></li>
                        <li><a href="#services" class="footer__link">Brand Strategy</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer__col">
                    <h3 class="footer__heading">Contact Info</h3>
                    <ul class="footer__contact-list">
                        <li class="footer__contact-item">
                            <i class="fas fa-map-marker-alt footer__contact-icon" aria-hidden="true"></i>
                            <span>123 Lorem Street, Ipsum City, 45678</span>
                        </li>
                        <li class="footer__contact-item">
                            <i class="fas fa-phone footer__contact-icon" aria-hidden="true"></i>
                            <a href="tel:+11234567890" class="footer__link">+1 (123) 456-7890</a>
                        </li>
                        <li class="footer__contact-item">
                            <i class="fas fa-envelope footer__contact-icon" aria-hidden="true"></i>
                            <a href="mailto:hello@luxebrand.com" class="footer__link">hello@luxebrand.com</a>
                        </li>
                        <li class="footer__contact-item">
                            <i class="fas fa-clock footer__contact-icon" aria-hidden="true"></i>
                            <span>Mon – Fri: 9:00 AM – 6:00 PM</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom-inner">
                <p class="footer__copyright">
                    &copy; {{ date('Y') }} <strong>LuxeBrand</strong>. All rights reserved.
                </p>
                <div class="footer__legal">
                    <a href="#" class="footer__legal-link">Privacy Policy</a>
                    <span aria-hidden="true">·</span>
                    <a href="#" class="footer__legal-link">Terms of Service</a>
                    <span aria-hidden="true">·</span>
                    <a href="#" class="footer__legal-link">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>
