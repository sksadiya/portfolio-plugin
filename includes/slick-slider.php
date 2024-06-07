<div class="container mt-5 mb-5">
  <?php if ($image_ids): ?>
    <div class="portfolio-carousel portfolio-magnificPopup">
      <?php foreach ($image_ids as $image_id): ?>
        <?php
        $image_src = wp_get_attachment_image_src($image_id, 'custom-size');
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
</div>