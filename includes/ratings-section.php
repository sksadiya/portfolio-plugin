<div class="card bg-white border-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div
                                    class="col-md-3 border-end p-3 justify-content-center align-items-center d-flex flex-column">
                                    <h1 class="text-center rating-overview-box-total">5</h1>
                                    <span class="text-center rating-overview-box-percent text-muted">out of 5.0</span>
                                    <div class="star-rating text-center" data-rating="5">
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                                <div class="col-md-9  px-3 justify-content-center align-items-center rating-bars flex-column">
                                    <div class="row px-3">
                                        <div class="col-md-6">
                                            <div class="rating-bars-item w-100">
                                                <span class="rating-bars-name">Rating</span>
                                                <span class="rating-bars-inner">
                                                    <span class="rating-bars-rating high" data-rating="5">
                                                        <span class="rating-bars-rating-inner"
                                                            style="width: <?php echo esc_attr($rating_percentage); ?>%;"></span>
                                                    </span>
                                                    <strong><?php echo esc_html($rating); ?></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rating-bars-item w-100">
                                                <span class="rating-bars-name">Service</span>
                                                <span class="rating-bars-inner">
                                                    <span class="rating-bars-rating good" data-rating="5">
                                                        <span class="rating-bars-rating-inner"
                                                            style="width: <?php echo esc_attr($service_percentage); ?>%;"></span>
                                                    </span>
                                                    <strong><?php echo esc_html($service); ?></strong>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-3 px-3">
                                        <div class="col-md-6">
                                            <div class="rating-bars-item w-100">
                                                <span class="rating-bars-name">Ameneties</span>
                                                <span class="rating-bars-inner">
                                                    <span class="rating-bars-rating mid" data-rating="5">
                                                        <span class="rating-bars-rating-inner"
                                                            style="width: <?php echo esc_attr($amenities_percentage); ?>%;"></span>
                                                    </span>
                                                    <strong><?php echo esc_html($amenities); ?></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rating-bars-item w-100">
                                                <span class="rating-bars-name">Value of Money</span>
                                                <span class="rating-bars-inner">
                                                    <span class="rating-bars-rating poor" data-rating="5">
                                                        <span class="rating-bars-rating-inner"
                                                            style="width: <?php echo esc_attr($value_of_money_percentage); ?>%;"></span>
                                                    </span>
                                                    <strong><?php echo esc_html($value_of_money); ?></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>