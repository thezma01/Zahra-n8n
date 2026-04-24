<footer class="footer" role="contentinfo">
    <div class="footer__top">
        <div class="container">
            <div class="footer__grid">

                <!-- Brand Column -->
                <div class="footer__col footer__col--brand">
                    <a href="{{ route('portfolio') }}" class="footer__logo" aria-label="Lumière Studio Home">
                        <span class="footer__logo-icon"><i class="fas fa-gem"></i></span>
                        <span class="footer__logo-text">Lumière<span class="footer__logo-accent">Studio</span></span>
                    </a>
                    <p class="footer__brand-desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="footer__social" aria-label="Social media links">
                        <a href="#" class="footer__social-link" aria-label="Follow us on Instagram">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="Follow us on Facebook">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="Follow us on Twitter / X">
                            <i class="fab fa-x-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="Connect on LinkedIn">
                            <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="Watch us on YouTube">
                            <i class="fab fa-youtube" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer__col">
                    <h3 class="footer__heading">Quick Links</h3>
                    <ul class="footer__links" role="list">
                        <li><a href="#home"      class="footer__link">Home</a></li>
                        <li><a href="#about"     class="footer__link">About Us</a></li>
                        <li><a href="#services"  class="footer__link">Services</a></li>
                        <li><a href="#portfolio" class="footer__link">Portfolio</a></li>
                        <li><a href="#contact"   class="footer__link">Contact</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer__col">
                    <h3 class="footer__heading">Services</h3>
                    <ul class="footer__links" role="list">
                        <li><a href="#services" class="footer__link">Product Design</a></li>
                        <li><a href="#services" class="footer__link">Ecommerce Solutions</a></li>
                        <li><a href="#services" class="footer__link">Digital Marketing</a></li>
                        <li><a href="#services" class="footer__link">Web Development</a></li>
                        <li><a href="#services" class="footer__link">Brand Identity</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer__col">
                    <h3 class="footer__heading">Get In Touch</h3>
                    <ul class="footer__contact-list" role="list">
                        <li class="footer__contact-item">
                            <i class="fas fa-map-marker-alt footer__contact-icon" aria-hidden="true"></i>
                            <span>123 Lorem Street, Ipsum City, 00000</span>
                        </li>
                        <li class="footer__contact-item">
                            <i class="fas fa-phone footer__contact-icon" aria-hidden="true"></i>
                            <a href="tel:+10000000000" class="footer__link">+1 (000) 000-0000</a>
                        </li>
                        <li class="footer__contact-item">
                            <i class="fas fa-envelope footer__contact-icon" aria-hidden="true"></i>
                            <a href="mailto:hello@lumierestudio.com" class="footer__link">hello@lumierestudio.com</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="container">
            <p class="footer__copyright">
                &copy; {{ date('Y') }} Lumière Studio. All rights reserved.
            </p>
            <ul class="footer__legal" role="list">
                <li><a href="#" class="footer__link">Privacy Policy</a></li>
                <li><a href="#" class="footer__link">Terms of Service</a></li>
            </ul>
        </div>
    </div>
</footer>
