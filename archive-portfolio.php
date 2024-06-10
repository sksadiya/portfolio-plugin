<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}
require plugin_dir_path(__FILE__) . 'header.php';
?>

<div class="container p-5">
  <div class="row mb-3">
    <div class="col-lg-4 col-md-12">
      <aside class="portfolio-sidebar mb-3">
        <h3 class="portfolio-category">Portfolio Categories</h3>
        <ul class="portfolio-categories list-group">
          <?php
          $categories = get_terms(
            array(
              'taxonomy' => 'portfolio_category',
              'orderby' => 'name',
              'order' => 'ASC',
              'hide_empty' => true,
            )
          );
          if (is_wp_error($categories)) {
            echo '<p>Error retrieving categories: ' . $categories->get_error_message() . '</p>';
        } elseif (!empty($categories)) {
            echo '<ul class="list-group">';
            foreach ($categories as $category) {
                echo '<li class="list-group-item">';
                echo '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No categories found.</p>';
        }
          ?>
        </ul>
      </aside>
    </div>
    <div class="col-lg-8 col-md-12">
      <?php if (have_posts()): ?>
        <div class="portfolio-items row">
          <?php while (have_posts()):
            the_post(); ?>
            <div class="col-md-6">
              <div class="card overflow-hidden mb-4">
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
                                      echo '<ul class="list-group d-inline-flex flex-row ">';
                                            foreach ($property_types as $property_type) {
                                              echo '<li class="list-group-item border-0 p-0 me-3"><i class="bi bi-arrows-move me-1"></i>'. $property_type .'</li>';
                                            }
                                           
                                            if ( 'portfolio' === get_post_type() ) : 
                                            echo '<a href="'.get_permalink().'"><span class="badge ms-3" style="background: #0fca98;">View</span></a>';
                                            echo '</ul>';
                                            endif;
                                        } else {
                                            echo ' ';
                                        }
                                        ?>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
        <div class="pagination">
          <?php
          the_posts_pagination(
            array(
              'mid_size' => 2,
              'prev_text' => __('« Previous', 'textdomain'),
              'next_text' => __('Next »', 'textdomain'),
            )
          );
          ?>
        </div>
      <?php else: ?>
        <p><?php _e('No portfolio items found.', 'textdomain'); ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
require plugin_dir_path(__FILE__) . 'footer.php';
?>