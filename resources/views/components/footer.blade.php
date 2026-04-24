<footer class="footer" role="contentinfo" aria-label="Site Footer">
    <div class="footer__top">
        <div class="footer__container">

            {{-- Brand Column --}}
            <div class="footer__col footer__col--brand">
                <a href="{{ route('portfolio') }}" class="footer__logo" aria-label="Lumière Co. Home">
                    <i class="fas fa-gem footer__logo-icon"></i>
                    <span>Lumière <em>Co.</em></span>
                </a>
                <p class="footer__brand-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud.
                </p>
                <div class="footer__social" aria-label="Social media links">
                    <a href="#" class="footer__social-link" aria-label="Follow us on Instagram" rel="noopener noreferrer">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Follow us on Facebook" rel="noopener noreferrer">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Follow us on Twitter / X" rel="noopener noreferrer">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Connect on LinkedIn" rel="noopener noreferrer">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Watch us on YouTube" rel="noopener noreferrer">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer__col">
                <h3 class="footer__col-title">Quick Links</h3>
                <ul class="footer__links">
                    <li><a href="#home"      class="footer__link"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="#about"     class="footer__link"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="#services"  class="footer__link"><i class="fas fa-chevron-right"></i> Services</a></li>
                    <li><a href="#portfolio" class="footer__link"><i class="fas fa-chevron-right"></i> Portfolio</a></li>
                    <li><a href="#contact"   class="footer__link"><i class="fas fa-chevron-right"></i> Contact</a></li>
                </ul>
            </div>

            {{-- Services Links --}}
            <div class="footer__col">
                <h3 class="footer__col-title">Our Services</h3>
                <ul class="footer__links">
                    <li><a href="#services" class="footer__link"><i class="fas fa-chevron-right"></i> Product Design</a></li>
                    <li><a href="#services" class="footer__link"><i class="fas fa-chevron-right"></i> Ecommerce Solutions</a></li>
                    <li><a href="#services" class="footer__link"><i class="fas fa-chevron-right"></i> Digital Marketing</a></li>
                    <li><a href="#services" class="footer__link"><i class="fas fa-chevron-right"></i> Web Development</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="footer__col">
                <h3 class="footer__col-title">Get In Touch</h3>
                <ul class="footer__contact-list">
                    <li class="footer__contact-item">
                        <i class="fas fa-map-marker-alt footer__contact-icon"></i>
                        <span>123 Lorem Street, Ipsum City,<br>Dolor State, 10101</span>
                    </li>
                    <li class="footer__contact-item">
                        <i class="fas fa-envelope footer__contact-icon"></i>
                        <a href="mailto:hello@lumiere.co" class="footer__link">hello@lumiere.co</a>
                    </li>
                    <li class="footer__contact-item">
                        <i class="fas fa-phone footer__contact-icon"></i>
                        <a href="tel:+11234567890" class="footer__link">+1 (123) 456-7890</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- Footer Bottom Bar --}}
    <div class="footer__bottom">
        <div class="footer__bottom-container">
            <p class="footer__copyright">
                &copy; {{ date('Y') }} <strong>Lumière Co.</strong> All rights reserved.
            </p>
            <ul class="footer__legal">
                <li><a href="#" class="footer__legal-link">Privacy Policy</a></li>
                <li><a href="#" class="footer__legal-link">Terms of Service</a></li>
                <li><a href="#" class="footer__legal-link">Cookie Policy</a></li>
            </ul>
        </div>
    </div>
</footer>
