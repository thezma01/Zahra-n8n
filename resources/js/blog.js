document.addEventListener('DOMContentLoaded', function() {
    console.log('Blog page scripts loaded successfully!');

    document.querySelectorAll('.blog-card .btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Clicked to read more on a blog post.');
        });
    });
});
