<div class="container-fluid mt-5 pt-5 p-0 mb-5">
  <?php if ($image_ids): ?>
    <div class="portfolio-carousel portfolio-magnificPopup mt-2">
      <?php foreach ($image_ids as $image_id): ?>
        <?php
        $image_src = wp_get_attachment_image_src($image_id, 'single-dekstop-slider');
        $image_url = $image_src ? $image_src[0] : '';
        ?>
        <div>
          <a href="<?php echo esc_url($image_url); ?>" class="mfp-gallery" data-large="<?php echo esc_url($image_url); ?>">
            <img src="<?php echo esc_url($image_url); ?>" alt="...">
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>