// Add event listener to the document
document.addEventListener('DOMContentLoaded', function() {
    // Select all elements with the class 'card'
    const cards = document.querySelectorAll('.card');

    // Add event listener to each card
    cards.forEach(function(card) {
        card.addEventListener('mouseover', function() {
            // Add the 'shadow-lg' class to the card on hover
            card.classList.add('shadow-lg');
        });

        card.addEventListener('mouseout', function() {
            // Remove the 'shadow-lg' class from the card on mouseout
            card.classList.remove('shadow-lg');
        });
    });
});
