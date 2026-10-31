<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DesignCo - Creative Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-muted-brown: #826F66;
            --secondary-warm-beige: #C69B7B;
            --accent-soft-peach: #F7CCAC;
            --dark-background-text: #3A3845;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: var(--dark-background-text); background-color: #f8f9fa; }
        .text-primary { color: var(--primary-muted-brown) !important; }
        .bg-primary { background-color: var(--primary-muted-brown) !important; }
        .text-secondary { color: var(--secondary-warm-beige) !important; }
        .bg-secondary { background-color: var(--secondary-warm-beige) !important; }
        .text-accent { color: var(--accent-soft-peach) !important; }
        .bg-accent { background-color: var(--accent-soft-peach) !important; }
        .text-dark-custom { color: var(--dark-background-text) !important; }
        .bg-dark-custom { background-color: var(--dark-background-text) !important; }

        .btn-primary-custom { background-color: var(--primary-muted-brown); border-color: var(--primary-muted-brown); color: white; transition: all 0.3s ease; }
        .btn-primary-custom:hover { background-color: #6a5e57; border-color: #6a5e57; }
        .btn-secondary-custom { background-color: var(--secondary-warm-beige); border-color: var(--secondary-warm-beige); color: var(--dark-background-text); transition: all 0.3s ease; }
        .btn-secondary-custom:hover { background-color: #b08a6a; border-color: #b08a6a; }

        .navbar-nav .nav-link { transition: color 0.3s ease; }
        .navbar-nav .nav-link:hover { color: var(--accent-soft-peach) !important; }

        .section-padding { padding-top: 5rem; padding-bottom: 5rem; }

        .hero-section {
            position: relative; display: flex; align-items: center; justify-content: center; color: white; text-align: center;
            background: linear-gradient(rgba(58, 56, 69, 0.6), rgba(58, 56, 69, 0.6)), url('https://st-gdx.dancf.com/gaodingx/0/uxms/design/20210122-101837-cf22.png') no-repeat center center/cover;
            height: 100vh;
        }
        .hero-content h1 { font-size: 3.5rem; }
        @media (max-width: 768px) { .hero-content h1 { font-size: 2.5rem; } }

        .about-img { max-width: 100%; height: auto; border-radius: 0.5rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); }

        .service-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .service-card:hover { transform: translateY(-5px); box-shadow: 0 1rem 2rem rgba(0,0,0,0.1); }
        .service-card .icon-wrapper { font-size: 3rem; color: var(--primary-muted-brown); margin-bottom: 1rem; }

        .portfolio-item { position: relative; overflow: hidden; border-radius: 0.5rem; box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.05); }
        .portfolio-item img { transition: transform 0.4s ease; }
        .portfolio-item:hover img { transform: scale(1.05); }
        .portfolio-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(69, 68, 80, 0.7); color: var(--accent-soft-peach);
            display: flex; align-items: center; justify-content: center; opacity: 0;
            transition: opacity 0.4s ease;
        }
        .portfolio-item:hover .portfolio-overlay { opacity: 1; }
        .sticky-top { position: -webkit-sticky; position: sticky; top: 0; z-index: 1020; }
    </style>
</head>
<body>
    @include('components.navbar')

    <header id="home" class="hero-section">
        <div class="container hero-content">
            <h1 class="display-3 fw-bold mb-4 text-accent">Elevating Your Ecommerce Experience</h1>
            <p class="lead mb-5 text-light">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <a href="#portfolio" class="btn btn-primary-custom btn-lg rounded-pill shadow-sm">
                Explore More <i class="bi bi-chevron-right ms-2"></i>
            </a>
        </div>
    </header>

    <section id="about" class="section-padding bg-light">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="display-4 fw-bold text-dark-custom mb-4">About DesignCo</h2>
                    <p class="lead text-secondary mb-4">
                        We are a passionate team dedicated to crafting beautiful and functional digital solutions.
                    </p>
                    <p class="text-dark-custom">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                    <p class="text-dark-custom">
                        Our mission is to empower businesses with innovative design and technology, while our vision is to be a leader in creating impactful and user-centric experiences across the globe. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="https://img.freepik.com/premium-photo/clothing-boutique-banner-mockup-with-blank-white-empty-space-placing-your-design_839035-1577676.jpg" class="about-img" alt="About Us Image">
                </div>
            </div>
        </div>
    </section>

    @include('components.services')
    @include('components.portfolio')
    @include('components.call-to-action')
    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
