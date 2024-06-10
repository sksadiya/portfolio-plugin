<div class="accordion" id="accordionExample">
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingOne">
                                <div class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h3>Description</h3>
                                </div>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php
                                    $description = get_post_meta(get_the_ID(), '_portfolio_description', true);
                                    echo esc_html($description);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($image_ids): ?>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="headingTwo">
                                    <div class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <h3>Gallery</h3>
                                    </div>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <?php foreach ($image_ids as $image_id): ?>
                                                <?php
                                                $image_src = wp_get_attachment_image_src($image_id, 'large');
                                                $image_full_src = wp_get_attachment_image_src($image_id, 'custom-size');
                                                $image_url = $image_src ? $image_src[0] : '';
                                                $image_full_url = $image_full_src ? $image_full_src[0] : '';
                                                ?>
                                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-2 portfolio-magnificPopup-2">
                                                    <div class="card">
                                                    <a href="<?php echo esc_url($image_full_url); ?>" class="mfp-gallery"
                                                        data-large="<?php echo esc_url($image_full_url); ?>">
                                                        <img src="<?php echo esc_url($image_url); ?>" class="card-img-top" 
                                                            alt="...">
                                                    </a>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>