<!-- Navbar -->
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">Logo</a>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Blogs</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Login/Signup</a></li>
        </ul>
    </div>
</nav>

<!-- Blog Container -->
<div class="blog-container">
    @foreach($blogs as $blog)
        <div class="blog-card">
            <img src="{{ $blog->image }}" alt="{{ $blog->title }}">
            <h2>{{ $blog->title }}</h2>
            <p>{{ $blog->description }}</p>
        </div>
    @endforeach
</div>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2024 All rights reserved.</p>
    <ul>
        <li><a href="#">Terms of Service</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
    <ul>
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
    </ul>
</footer>
