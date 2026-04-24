<nav class="navbar" id="mainNavbar" role="navigation" aria-label="Main navigation">
    <div class="navbar__container">

        <!-- Logo -->
        <a href="{{ route('portfolio') }}" class="navbar__logo" aria-label="Lumière Studio Home">
            <span class="navbar__logo-icon"><i class="fas fa-gem"></i></span>
            <span class="navbar__logo-text">Lumière<span class="navbar__logo-accent">Studio</span></span>
        </a>

        <!-- Desktop Menu -->
        <ul class="navbar__menu" role="list">
            <li><a href="#home"      class="navbar__link">Home</a></li>
            <li><a href="#about"     class="navbar__link">About</a></li>
            <li><a href="#services"  class="navbar__link">Services</a></li>
            <li><a href="#portfolio" class="navbar__link">Portfolio</a></li>
            <li><a href="#contact"   class="navbar__link navbar__link--cta">Contact</a></li>
        </ul>

        <!-- Mobile Hamburger -->
        <button class="navbar__hamburger" id="hamburgerBtn" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="mobileMenu">
            <span class="navbar__hamburger-bar"></span>
            <span class="navbar__hamburger-bar"></span>
            <span class="navbar__hamburger-bar"></span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="navbar__mobile" id="mobileMenu" role="menu" aria-hidden="true">
        <ul class="navbar__mobile-menu" role="list">
            <li><a href="#home"      class="navbar__mobile-link" role="menuitem">Home</a></li>
            <li><a href="#about"     class="navbar__mobile-link" role="menuitem">About</a></li>
            <li><a href="#services"  class="navbar__mobile-link" role="menuitem">Services</a></li>
            <li><a href="#portfolio" class="navbar__mobile-link" role="menuitem">Portfolio</a></li>
            <li><a href="#contact"   class="navbar__mobile-link navbar__mobile-link--cta" role="menuitem">Contact</a></li>
        </ul>
    </div>
</nav>
