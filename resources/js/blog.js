// Add event listener to navbar toggler
document.getElementById('navbar-toggler').addEventListener('click', function() {
    document.getElementById('navbar-collapse').classList.toggle('show');
});

// Add event listener to blog cards
document.querySelectorAll('.blog-card').forEach(function(card) {
    card.addEventListener('mouseover', function() {
        card.classList.add('hover');
    });
    card.addEventListener('mouseout', function() {
        card.classList.remove('hover');
    });
});
