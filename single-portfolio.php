<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

require plugin_dir_path(__FILE__) . 'header.php';

if (have_posts()) :
    while (have_posts()) : the_post(); 
        $image_ids = get_post_meta(get_the_ID(), 'image_array', true);
        $image_ids = is_array($image_ids) ? $image_ids : array();
        ?>
        <div class="container mt-5">
            <h1 class="text-center"><?php the_title(); ?></h1>

            <?php if ($image_ids): ?>
                <div class="portfolio-carousel">
                    <?php foreach ($image_ids as $image_id): ?>
                        <?php 
                        $image_src = wp_get_attachment_image_src($image_id, 'large'); 
                        $image_url = $image_src ? $image_src[0] : '';
                        ?>
                        <div>
                            <a href="<?php echo esc_url($image_url); ?>" class="mfp-gallery" data-large="<?php echo esc_url($image_url); ?>">
                                <img src="<?php echo esc_url($image_url); ?>" height="400px" width="660px" alt="...">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="portfolio-content mt-5">
                <?php the_content(); ?>
            </div>
        </div>
        
        <div class="container mb-4">
            <div class="row">
                <div class="col-md-8">
                    hi
                </div>
                <div class="col-md-4">
                    hi
                </div>
            </div>
        </div>
        <?php
        require plugin_dir_path(__FILE__) . 'footer.php';
    endwhile;
endif;
?>
