jQuery(document).ready(function($) {
    // Initialize Slick Carousel
    $('.portfolio-carousel').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        // autoplay: true,
        autoplaySpeed: 3000,
        prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
        nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
    });

    $('.portfolio-carousel').magnificPopup({
        delegate: 'a.mfp-gallery', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            enabled: true, // enable gallery mode
            tPrev: 'Previous (Left arrow key)', // title for left button
            tNext: 'Next (Right arrow key)', // title for right button
            tCounter: ' ' // markup of counter
        },
        callbacks: {
            elementParse: function(item) {
                item.src = item.el.attr('data-large'); // Use the 'data-large' attribute for the image source
            }
        }
    });
});
