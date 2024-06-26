jQuery(document).ready(function($) {
    $('.slick-archive-carousel').slick({
        infinite: true,
        speed: 600,
        slidesToShow: 1,
       prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="bi bi-arrow-left-circle"></i></button>',
        nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="bi bi-arrow-right-circle"></i></button>'
    });
});

jQuery(document).ready(function($) {
    // Initialize Slick Carousel
    $('.portfolio-carousel').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        // autoplay: true,
        centerMode: true,
        // variableWidth: true,
        //  dots:true,
        draggable: true,
        autoplaySpeed: 3000,
        prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
        nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 1024, // Tablet breakpoint
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false // Optional: disable center mode for tablet
                }
            },
            {
                breakpoint: 768, // Mobile breakpoint
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false // Optional: disable center mode for mobile
                }
            }
        ]
    });

    $('.portfolio-magnificPopup').magnificPopup({
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
    $('.portfolio-magnificPopup-2').magnificPopup({
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

jQuery(document).ready(function($) {
    $('#portfolio-enquiry-form').on('submit', function(event) {
        event.preventDefault();
        var submitButton = $(this).find('button[type="submit"]');
        var originalButtonText = submitButton.html();

        submitButton.prop('disabled', true);
        submitButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...');
        var isValid = true;
        var email = $('#email').val();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var property = $('#property').val();

        // Email validation
        if (!email || !isValidEmail(email)) {
            isValid = false;
            $('#email').addClass('is-invalid').siblings('.invalid-feedback').text('Please enter a valid email address.');
            $('#email').focus();
        } else {
            $('#email').removeClass('is-invalid').siblings('.invalid-feedback').text('');
        }

        // Name validation
        if (!name || name.length < 3) {
            isValid = false;
            $('#name').addClass('is-invalid').siblings('.invalid-feedback').text('Name must be at least 3 characters long.');
            $('#name').focus();
        } else {
            $('#name').removeClass('is-invalid').siblings('.invalid-feedback').text('');
        }

        // Phone validation
        if (!phone || phone.length !== 10 || isNaN(phone)) {
            isValid = false;
            $('#phone').addClass('is-invalid').siblings('.invalid-feedback').text('Phone number must be exactly 10 digits.');
            $('#phone').focus();
        } else {
            $('#phone').removeClass('is-invalid').siblings('.invalid-feedback').text('');
        }

        // Property selection validation
        if (!property) {
            isValid = false;
            $('#property').addClass('is-invalid').siblings('.invalid-feedback').text('Please select a property.');
            $('#property').focus();
        } else {
            $('#property').removeClass('is-invalid').siblings('.invalid-feedback').text('');
        }

        if (!isValid) {
             submitButton.html(originalButtonText);
            submitButton.prop('disabled', false);
            return;
        }

        var form_data = $(this).serialize();
        var nonce = $('#nonce').val();

        $.ajax({
            url: portfolioData.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'process_enquiry_form',
                security: nonce,
                form_data: form_data
            },
            success: function(response) {
                if (response.success) {
                    submitButton.text('Thank you for your enquiry!');
                    $('#portfolio-enquiry-form')[0].reset();
                    setTimeout(function () {
                        submitButton.html(originalButtonText);
                        submitButton.prop('disabled', false);
                    }, 5000);
                } else {
                    var errors = response.data;
                    // Handle server-side errors
                    if (errors.name) {
                        $('#name').addClass('is-invalid').siblings('.invalid-feedback').text(errors.name);
                    }
                    if (errors.email) {
                        $('#email').addClass('is-invalid').siblings('.invalid-feedback').text(errors.email);
                    }
                    if (errors.phone) {
                        $('#phone').addClass('is-invalid').siblings('.invalid-feedback').text(errors.phone);
                    }
                    if (errors.property) {
                        $('#property').addClass('is-invalid').siblings('.invalid-feedback').text(errors.property);
                    }
                }
                submitButton.html(originalButtonText);
                submitButton.prop('disabled', false);
            },
            error: function() {
                alert('An error occurred while submitting the form. Please try again.');
                submitButton.html(originalButtonText);
                submitButton.prop('disabled', false);
            }
        });
    });
});

function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

