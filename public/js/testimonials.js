document.addEventListener('DOMContentLoaded', function () {
    var carousel = document.querySelector('#testimonialsCarousel');
    if (carousel) {
        var bsCarousel = new bootstrap.Carousel(carousel, {
            interval: 4000,
            ride: 'carousel',
            pause: 'hover'
        });
    }
});
