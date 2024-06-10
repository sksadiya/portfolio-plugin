<div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-header text-white py-4" style="background: #0fca98;">
                            <h5 class="card-title mb-0" style="font-family: 'Poppins', sans-serif;">Enquiry Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="" id="portfolio-enquiry-form" name="portfolio-enquiry-form" method="post">
                                <input type="hidden" id="nonce" name="nonce" value="<?php echo wp_create_nonce('wp_rest'); ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" name="name"
                                        required>
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email"
                                        required>
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone"
                                        required>
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="property" class="form-label">Select Property</label>
                                    <select class="form-select form-control" id="property" name="property"
                                        placeholder="Select property type" required>
                                        <?php
                                        $property_types = get_field('property_type'); // Fetch options from ACF field
                                        if ($property_types) {
                                            foreach ($property_types as $property_type) {
                                                echo '<option value="' . $property_type . '">' . $property_type . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No options found</option>';
                                        }
                                        ?>
                                    </select>
                                    <p class="invalid-feedback"></p>
                                </div>
                                <button type="submit" class="btn btn-dark btn-hover-primary py-3 w-100">Send Enquiry</button>
                            </form>
                        </div>
                    </div>
                </div>