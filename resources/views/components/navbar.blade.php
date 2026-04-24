<nav class="navbar" id="mainNavbar" role="navigation" aria-label="Main navigation">
    <div class="navbar__container">

        <!-- Logo -->
        <a href="{{ route('portfolio') }}" class="navbar__logo" aria-label="Company Home">
            <span class="navbar__logo-icon">
                <i class="fas fa-gem"></i>
            </span>
            <span class="navbar__logo-text">LuxeBrand</span>
        </a>

        <!-- Desktop Menu -->
        <ul class="navbar__menu" role="menubar">
            <li role="none">
                <a href="#home" class="navbar__link" role="menuitem">Home</a>
            </li>
            <li role="none">
                <a href="#about" class="navbar__link" role="menuitem">About</a>
            </li>
            <li role="none">
                <a href="#services" class="navbar__link" role="menuitem">Services</a>
            </li>
            <li role="none">
                <a href="#portfolio" class="navbar__link" role="menuitem">Portfolio</a>
            </li>
            <li role="none">
                <a href="#contact" class="navbar__link navbar__link--cta" role="menuitem">Contact</a>
            </li>
        </ul>

        <!-- Hamburger Toggle -->
        <button class="navbar__toggle" id="navToggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileMenu">
            <span class="navbar__toggle-bar"></span>
            <span class="navbar__toggle-bar"></span>
            <span class="navbar__toggle-bar"></span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="navbar__mobile" id="mobileMenu" aria-hidden="true">
        <ul class="navbar__mobile-menu" role="menubar">
            <li role="none">
                <a href="#home" class="navbar__mobile-link" role="menuitem">Home</a>
            </li>
            <li role="none">
                <a href="#about" class="navbar__mobile-link" role="menuitem">About</a>
            </li>
            <li role="none">
                <a href="#services" class="navbar__mobile-link" role="menuitem">Services</a>
            </li>
            <li role="none">
                <a href="#portfolio" class="navbar__mobile-link" role="menuitem">Portfolio</a>
            </li>
            <li role="none">
                <a href="#contact" class="navbar__mobile-link" role="menuitem">Contact</a>
            </li>
        </ul>
    </div>
</nav>
