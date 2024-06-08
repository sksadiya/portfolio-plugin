<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
require plugin_dir_path(__FILE__) . 'header.php';
 ?>
<div class="container p-4">
    <h1><?php single_term_title(); ?></h1>
    <div class="row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="col-md-4">
            <div class="card mb-4">
                <div class="slick-archive-carousel">
                  <?php
                  $image_ids = get_post_meta(get_the_ID(), 'image_array', true);
                  $image_ids = is_array($image_ids) ? $image_ids : array();
                  if ($image_ids): ?>
                    <?php foreach ($image_ids as $image_id):
                      $image_src = wp_get_attachment_image_src($image_id, 'portfolio-archive');
                      $image_url = $image_src ? $image_src[0] : '';
                      ?>
                      <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url($image_url); ?>" class="card-img-top" alt="...">
                      </a>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
                <div class="card-body">
                  <h3 class="portfolio-title mb-4"><?php the_title(); ?></h3>
                  <?php
                  $property_types = get_field('property_type'); // Fetch options from ACF field
                                        if ($property_types) {
                                      echo '<ul class="list-group d-inline-flex flex-row me-2">';
                                            foreach ($property_types as $property_type) {
                                              echo '<li class="list-group-item border-0"><i class="bi bi-arrows-move me-1"></i>'. $property_type .'</li>';
                                            }
                                            echo '</ul>';
                                            if ( 'portfolio' === get_post_type() ) : 
                                            echo '<a href="'.get_permalink().'"><span class="badge" style="background: #0fca98;">View</span></a>';
                                            endif;
                                        } else {
                                            echo ' ';
                                        }
                                        ?>
                </div>
              </div>
            </div>
        <?php endwhile; else : ?>
            <p><?php _e('Sorry, no portfolio items found.'); ?></p>
        <?php endif; ?>
    </div>
</div>




<?php
        require plugin_dir_path(__FILE__) . 'footer.php';
?>