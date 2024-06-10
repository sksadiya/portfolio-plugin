<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
require plugin_dir_path(__FILE__) . 'header.php';

if (have_posts()):
    while (have_posts()):
        the_post();

        $image_ids = get_post_meta(get_the_ID(), 'image_array', true);
        $image_ids = is_array($image_ids) ? $image_ids : array();
        $rating = get_field('rating'); // ACF field for rating
        $service = get_field('service'); // ACF field for service
        $amenities = get_field('ameneties'); // ACF field for amenities
        $value_of_money = get_field('value_of_money'); // ACF field for value of money

        // Calculate percentage based on rating out of 5
        $rating_percentage = ($rating / 5) * 100;
        $service_percentage = ($service / 5) * 100;
        $amenities_percentage = ($amenities / 5) * 100;
        $value_of_money_percentage = ($value_of_money / 5) * 100;
        ?>
        <?php
        // Include the content section
        require_once plugin_dir_path(__FILE__) . 'includes/slick-slider.php';
        ?>
        <div class="container mb-4">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <?php require_once plugin_dir_path(__FILE__) . 'includes/ratings-section.php'; ?>
                    <?php require_once plugin_dir_path(__FILE__) . 'includes/accordians.php'; ?>
                </div>
                <?php require_once plugin_dir_path(__FILE__) . 'includes/enquiry-form.php'; ?>
            </div>
        </div>
        <?php
        require plugin_dir_path(__FILE__) . 'footer.php';
    endwhile;
endif;
?>