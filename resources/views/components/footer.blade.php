<footer class="footer">
    <div class="footer__top">
        <div class="container">
            <div class="footer__grid">

                {{-- Brand Column --}}
                <div class="footer__col footer__col--brand">
                    <a href="{{ route('portfolio') }}" class="footer__logo">
                        <i class="fas fa-gem"></i>
                        <span>Luxe<strong>Co</strong></span>
                    </a>
                    <p class="footer__brand-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua ut enim veniam.
                    </p>
                    <div class="footer__social">
                        <a href="#" class="footer__social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="Pinterest">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="footer__col">
                    <h4 class="footer__col-title">Quick Links</h4>
                    <ul class="footer__links">
                        <li><a href="#home"      class="footer__link"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#about"     class="footer__link"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="#services"  class="footer__link"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="#portfolio" class="footer__link"><i class="fas fa-chevron-right"></i> Portfolio</a></li>
                        <li><a href="#contact"   class="footer__link"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>

                {{-- Services --}}
                <div class="footer__col">
                    <h4 class="footer__col-title">Services</h4>
                    <ul class="footer__links">
                        <li><a href="#" class="footer__link"><i class="fas fa-chevron-right"></i> Product Design</a></li>
                        <li><a href="#" class="footer__link"><i class="fas fa-chevron-right"></i> Ecommerce Solutions</a></li>
                        <li><a href="#" class="footer__link"><i class="fas fa-chevron-right"></i> Digital Marketing</a></li>
                        <li><a href="#" class="footer__link"><i class="fas fa-chevron-right"></i> Web Development</a></li>
                        <li><a href="#" class="footer__link"><i class="fas fa-chevron-right"></i> Brand Strategy</a></li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div class="footer__col">
                    <h4 class="footer__col-title">Contact Info</h4>
                    <ul class="footer__contact-list">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Lorem Street, Ipsum City, 45678</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+1 (555) 123-4567</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>hello@luxeco.com</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>Mon – Fri: 9:00 AM – 6:00 PM</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom-inner">
                <p class="footer__copyright">
                    &copy; {{ date('Y') }} <strong>LuxeCo</strong>. All rights reserved.
                </p>
                <div class="footer__bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>
