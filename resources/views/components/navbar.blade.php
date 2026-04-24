<nav class="navbar" id="mainNavbar">
    <div class="navbar__container">

        {{-- Logo --}}
        <a href="{{ route('portfolio') }}" class="navbar__logo">
            <span class="navbar__logo-icon"><i class="fas fa-gem"></i></span>
            <span class="navbar__logo-text">Luxe<strong>Co</strong></span>
        </a>

        {{-- Desktop Menu --}}
        <ul class="navbar__menu" id="navMenu">
            <li><a href="#home"      class="navbar__link">Home</a></li>
            <li><a href="#about"     class="navbar__link">About</a></li>
            <li><a href="#services"  class="navbar__link">Services</a></li>
            <li><a href="#portfolio" class="navbar__link">Portfolio</a></li>
            <li><a href="#contact"   class="navbar__link navbar__link--cta">Contact</a></li>
        </ul>

        {{-- Hamburger --}}
        <button class="navbar__hamburger" id="hamburgerBtn" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>
