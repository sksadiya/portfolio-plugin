<?php
/*
Plugin Name: Portfolio Plugin
Description: A plugin to create and manage portfolios.
Version: 1.0
Author: Your Name
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
// Enqueue scripts and styles for both admin and front end
function portfolio_enqueue_scripts() {
    wp_enqueue_script('jquery');

    // Enqueue styles and scripts common to both admin and front end
    wp_enqueue_style('portfolio-style', plugins_url('/src/css/style.css', __FILE__), array(), '1.0', 'all');
    wp_enqueue_style('magnific-popup-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css');
    wp_enqueue_script('magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array('jquery'), null, true);
    wp_enqueue_style('poppins-font', plugins_url('/src/font/Poppins/Poppins-Regular.ttf', __FILE__), array(), null);
    wp_enqueue_style('poppins-semi-bold', plugins_url('/src/font/Poppins/Poppins-SemiBold.ttf', __FILE__), array(), null);
    wp_enqueue_script('slick-carousel', plugins_url('/src/assets/slick/slick.min.js', __FILE__), array('jquery'), '1.9.0', true);
    wp_enqueue_style('slick-carousel-css', plugins_url('/src/assets/slick/slick.css', __FILE__), array(), '1.9.0', 'all');
    wp_enqueue_style('slick-theme-css', plugins_url('/src/assets/slick/slick-theme.css', __FILE__), array(), '1.9.0', 'all');

    // Enqueue bootstrap styles and scripts
    wp_enqueue_style('bootstrap-css', plugins_url('/src/assets/bootstrap/dist/css/bootstrap.min.css', __FILE__), array(), '5.0.0', 'all');
    // wp_enqueue_script('bootstrap-js', plugins_url('/src/assets/bootstrap/dist/js/bootstrap.bundle.min.js', __FILE__), array('jquery'), '5.0.0', true);
    
    wp_enqueue_style('bootstrap-icons-css', plugins_url('/src/assets/bootstrap-icons/font/bootstrap-icons.css', __FILE__), array(), '1.7.0', 'all');
    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    // Check if the current screen is admin
    if (is_admin()) {
        wp_enqueue_style('dropzone-css', plugins_url('/src/assets/dropzone/min/dropzone.min.css', __FILE__), array(), '1.7.0', 'all');
        wp_enqueue_script('dropzone-js', plugins_url('/src/assets/dropzone/dropzone.js', __FILE__), array('jquery'), '5.0.0', true);

       wp_enqueue_script('portfolio-front-script', plugins_url('/src/js/custom.js', __FILE__), array('jquery'), '1.0', true);
       wp_localize_script('portfolio-front-script', 'MyPluginData', array(
        'uploadUrl' => rest_url('wp/v2/uploads_gallery'),
           'ajax_url' => admin_url('admin-ajax.php'),
           'nonce' => wp_create_nonce('wp_rest')
       ));
    } else {
        wp_enqueue_script('admin-custom-js', plugins_url('/src/js/admin-custom.js', __FILE__), array('jquery'), '1.0', true);
        wp_localize_script('admin-custom-js', 'portfolioData', array(
            'nonce' => wp_create_nonce('wp_rest'),
            'ajax_url' => admin_url('admin-ajax.php')
        ));
        
    }
}
add_action('admin_enqueue_scripts', 'portfolio_enqueue_scripts');
add_action('wp_enqueue_scripts', 'portfolio_enqueue_scripts');


// Register Custom Post Type
function create_portfolio_post_type() {
    $labels = array(
        'name'                  => _x('Portfolios', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Portfolio', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Portfolios', 'text_domain'),
        'name_admin_bar'        => __('Portfolio', 'text_domain'),
        'archives'              => __('Portfolio Archives', 'text_domain'),
        'attributes'            => __('Portfolio Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Portfolio:', 'text_domain'),
        'all_items'             => __('All Portfolios', 'text_domain'),
        'add_new_item'          => __('Add New Portfolio', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Portfolio', 'text_domain'),
        'edit_item'             => __('Edit Portfolio', 'text_domain'),
        'update_item'           => __('Update Portfolio', 'text_domain'),
        'view_item'             => __('View Portfolio', 'text_domain'),
        'view_items'            => __('View Portfolios', 'text_domain'),
        'search_items'          => __('Search Portfolio', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into portfolio', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this portfolio', 'text_domain'),
        'items_list'            => __('Portfolios list', 'text_domain'),
        'items_list_navigation' => __('Portfolios list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter portfolios list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Portfolio', 'text_domain'),
        'description'           => __('Portfolio Description', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title','thumbnail'),
        'taxonomies'            => array('portfolio_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-gallery', // Dashicon for gallery
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => array('slug' => 'portfolio'),
        'capability_type'       => 'post',
				'show_in_rest'          => true, // This enables REST API access
    );
    register_post_type('portfolio', $args);
}
add_action('init', 'create_portfolio_post_type', 0);

// Register Custom Taxonomy
function create_portfolio_category_taxonomy() {
    $labels = array(
        'name'                       => _x('Portfolio Categories', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Portfolio Category', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Portfolio Categories', 'text_domain'),
        'all_items'                  => __('All Categories', 'text_domain'),
        'parent_item'                => __('Parent Category', 'text_domain'),
        'parent_item_colon'          => __('Parent Category:', 'text_domain'),
        'new_item_name'              => __('New Category Name', 'text_domain'),
        'add_new_item'               => __('Add New Category', 'text_domain'),
        'edit_item'                  => __('Edit Category', 'text_domain'),
        'update_item'                => __('Update Category', 'text_domain'),
        'view_item'                  => __('View Category', 'text_domain'),
        'separate_items_with_commas' => __('Separate categories with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove categories', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Categories', 'text_domain'),
        'search_items'               => __('Search Categories', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No categories', 'text_domain'),
        'items_list'                 => __('Categories list', 'text_domain'),
        'items_list_navigation'      => __('Categories list navigation', 'text_domain'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy('portfolio_category', array('portfolio'), $args);
}
add_action('init', 'create_portfolio_category_taxonomy', 0);

function register_enquiry_post_type() {
    $labels = array(
        'name'               => _x('Enquiries', 'post type general name', 'your-textdomain'),
        'singular_name'      => _x('Enquiry', 'post type singular name', 'your-textdomain'),
        'menu_name'          => _x('Enquiries', 'admin menu', 'your-textdomain'),
        'name_admin_bar'     => _x('Enquiry', 'add new on admin bar', 'your-textdomain'),
        'add_new'            => _x('Add New', 'enquiry', 'your-textdomain'),
        'add_new_item'       => __('Add New Enquiry', 'your-textdomain'),
        'new_item'           => __('New Enquiry', 'your-textdomain'),
        'edit_item'          => __('Edit Enquiry', 'your-textdomain'),
        'view_item'          => __('View Enquiry', 'your-textdomain'),
        'all_items'          => __('All Enquiries', 'your-textdomain'),
        'search_items'       => __('Search Enquiries', 'your-textdomain'),
        'parent_item_colon'  => __('Parent Enquiries:', 'your-textdomain'),
        'not_found'          => __('No enquiries found.', 'your-textdomain'),
        'not_found_in_trash' => __('No enquiries found in Trash.', 'your-textdomain')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'enquiry'),
        'capability_type'    => 'post',
        'capabilities'       => array(
            'create_posts' => false, // Removes support for "Add New"
        ),
        'map_meta_cap'       => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'custom-fields')
    );

    register_post_type('enquiry', $args);
}
add_action('init', 'register_enquiry_post_type');





function set_custom_enquiry_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Name'),
        'email' => __('Email'),
        'phone' => __('Phone'),
        'property' => __('Property'),
        'date' => __('Date'),
    );
    return $columns;
}
add_filter('manage_enquiry_posts_columns', 'set_custom_enquiry_columns');

function custom_enquiry_column($column, $post_id) {
    switch ($column) {
        case 'email':
            echo get_post_meta($post_id, 'email', true);
            break;
        case 'phone':
            echo get_post_meta($post_id, 'phone', true);
            break;
        case 'property':
            echo get_post_meta($post_id, 'property', true);
            break;
    }
}
add_action('manage_enquiry_posts_custom_column', 'custom_enquiry_column', 10, 2);

function add_custom_enquiry_metaboxes() {
    add_meta_box(
        'custom_enquiry_details_metabox',
        'Enquiry Details',
        'custom_enquiry_details_metabox_content',
        'enquiry',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_custom_enquiry_metaboxes' );

function custom_enquiry_details_metabox_content( $post ) {
    $email = get_post_meta( $post->ID, 'email', true );
    $phone = get_post_meta( $post->ID, 'phone', true );
    $property = get_post_meta( $post->ID, 'property', true );

    echo '<p><strong>Email:</strong> ' . esc_html( $email ) . '</p>';
    echo '<p><strong>Phone:</strong> ' . esc_html( $phone ) . '</p>';
    echo '<p><strong>Property:</strong> ' . esc_html( $property ) . '</p>';
}

// Flush rewrite rules on activation
function portfolio_plugin_activate() {
    // Register the custom post type and taxonomy
    create_portfolio_post_type();
    create_portfolio_category_taxonomy();
    // Flush the rewrite rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'portfolio_plugin_activate');

// Flush rewrite rules on deactivation
function portfolio_plugin_deactivate() {
    // Flush the rewrite rules
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'portfolio_plugin_deactivate');

// Add a search bar to the Portfolio list table
function add_portfolio_search_bar($post_type) {
    if ($post_type === 'portfolio') {
        ?>
        <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search Portfolios"/>
        <?php
    }
}
add_action('restrict_manage_posts', 'add_portfolio_search_bar');

// Add a search bar to the Portfolio Categories list table
function add_portfolio_category_search_bar($taxonomy) {
    if ($taxonomy === 'portfolio_category') {
        ?>
        <input type="search" name="s" value="<?php echo isset($_GET['s']) ? esc_attr($_GET['s']) : ''; ?>" placeholder="Search Portfolio Categories"/>
        <?php
    }
}
add_action('restrict_manage_terms', 'add_portfolio_category_search_bar');

function portfolio_add_meta_boxes() {
	add_meta_box('portfolio_media_meta_box', __('Media', 'portfolio'), 'portfolio_media_meta_box_html', 'portfolio', 'normal', 'high');
    add_meta_box('portfolio_description_meta_box', __('Description', 'portfolio'), 'portfolio_description_meta_box_html', 'portfolio', 'normal', 'high');
}
add_action('add_meta_boxes', 'portfolio_add_meta_boxes');

function portfolio_media_meta_box_html($post) {
	$image_ids = get_post_meta($post->ID, 'image_array', true); // Retrieve saved image IDs
	$image_ids = is_array($image_ids) ? $image_ids : array();

	?>
	<div style="width: 100%;">
			<div class="col-lg-12">
					<div class="card-body">
							<h2 class="h4 mb-3">Media</h2>
							<div id="portfolio-image-dropzone" class="dropzone dz-clickable">
									<div class="dz-message needsclick">
											<br>Drop files here or click to upload.<br><br>
									</div>
							</div>
					</div>
			</div>
	</div>
	<div class="row" id="product-gallery">
			<?php foreach ($image_ids as $image_id): ?>
					<?php $image_url = wp_get_attachment_url($image_id); ?>
					<div class="col-md-3" id="image-row-<?php echo esc_attr($image_id); ?>">
							<div class="card">
									<input type="hidden" name="image_array[]" value="<?php echo esc_attr($image_id); ?>">
									<img src="<?php echo esc_url($image_url); ?>" class="card-img-top" alt="...">
									<div class="card-body">
											<a href="javascript:void(0)" onclick="deleteImage(<?php echo esc_attr($image_id); ?>)" class="btn btn-danger">Delete</a>
									</div>
							</div>
					</div>
			<?php endforeach; ?>
	</div>
	<?php
}
function portfolio_description_meta_box_html($post) {
    $description = get_post_meta($post->ID, '_portfolio_description', true);

    ?>
        <div class="col-lg-12">
            <div class="card-body">
                <h2 class="h4 mb-3">Description</h2>
                <?php
                wp_editor(
                    $description,
                    'portfolio_description',
                    array(
                        'textarea_name' => 'portfolio_description',
                        'media_buttons' => true,
                        'textarea_rows' => 10,
                    )
                );
                ?>
            </div>
        </div>
    <?php
}
add_action('save_post', 'save_portfolio_meta');
function save_portfolio_meta($post_id) {
	if (array_key_exists('image_array', $_POST)) {
			update_post_meta($post_id, 'image_array', $_POST['image_array']);
	}
    if (array_key_exists('portfolio_description', $_POST)) {
        update_post_meta($post_id, '_portfolio_description', sanitize_text_field($_POST['portfolio_description']));
    }
}

// Handle File Upload for Portfolio
function handle_portfolio_upload( $request ) {
	if (empty($_FILES['file'])) {
			return new WP_Error('no_file', 'No file provided', array('status' => 400));
	}

	$file = $_FILES['file'];

	// Handle file upload
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	require_once(ABSPATH . 'wp-admin/includes/media.php');
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	$attachment_id = media_handle_upload('file', 0); // 0 to not attach to any post

	if (is_wp_error($attachment_id)) {
			return $attachment_id;
	}

	// Get attachment URL
	$attachment_url = wp_get_attachment_url($attachment_id);

	// Prepare response
	$response = array(
			'image_id' => $attachment_id,
			'imagePath' => $attachment_url,
	);

	return rest_ensure_response($response);
}

function register_portfolio_upload_route() {
	register_rest_route(
			'portfolio/v1',
			'/upload/',
			array(
					'methods'  => 'POST',
					'callback' => 'handle_portfolio_upload',
					'permission_callback' => '__return_true', // Simplified permission callback for testing
			)
	);
}
add_action('rest_api_init', 'register_portfolio_upload_route');


add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/uploads_gallery/', array(
		'methods' => 'POST',
		'callback' => 'handle_portfolio_upload',
		'permission_callback' => '__return_true',
	));
});


function register_routes_list_endpoint() {
	register_rest_route(
			'custom-plugin/v1',
			'/routes/',
			array(
					'methods'  => 'GET',
					'callback' => 'get_registered_routes',
			)
	);
}
add_action('rest_api_init', 'register_routes_list_endpoint');

// Callback function to retrieve and return registered routes
function get_registered_routes() {
	$registered_routes = rest_get_server()->get_routes();
	$routes_list = array();

	foreach ($registered_routes as $route => $route_data) {
			$routes_list[] = $route;
	}

	return rest_ensure_response($routes_list);
}


function load_portfolio_template($template) {
    if (is_singular('portfolio')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'single-portfolio.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    return $template;
}
add_filter('template_include', 'load_portfolio_template');



function my_custom_image_sizes() {
    add_image_size('custom-size', 752, 501, true); 
    add_image_size('small-size', 300, 200, true); 
}
add_action('after_setup_theme', 'my_custom_image_sizes');

function process_enquiry_form() {
    // Verify nonce
    $nonce = isset( $_POST['security'] ) ? sanitize_text_field( wp_unslash( $_POST['security'] ) ) : '';
    if ( ! isset( $nonce ) || ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
        wp_send_json_error( 'Invalid nonce' );
    }

    $form_data = array();
    parse_str( $_POST['form_data'], $form_data );

    $name = isset( $form_data['name'] ) ? sanitize_text_field( $form_data['name'] ) : '';
    $email = isset( $form_data['email'] ) ? sanitize_email( $form_data['email'] ) : '';
    $phone = isset( $form_data['phone'] ) ? sanitize_text_field( $form_data['phone'] ) : '';
    $property = isset( $form_data['property'] ) ? sanitize_text_field( $form_data['property'] ) : '';

    // Validation
    $errors = array();
    if ( strlen( $name ) < 3 ) {
        $errors['name'] = 'Name must be at least 3 characters long.';
    }
    if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if ( strlen( $phone ) != 10 || ! is_numeric( $phone ) ) {
        $errors['phone'] = 'Phone number must be exactly 10 digits.';
    }
    if ( empty( $property ) ) {
        $errors['property'] = 'Please select a property.';
    }

    if ( ! empty( $errors ) ) {
        wp_send_json_error( $errors );
    } else {
        // Auto-generate the title
        $title = 'Enquiry from ' . $name . ' - ' . date('Y-m-d H:i:s');

        // Insert the enquiry post
        $enquiry_post = array(
            'post_title'   => $title,
            'post_status'  => 'publish',
            'post_type'    => 'enquiry'
        );

        $post_id = wp_insert_post($enquiry_post);

        // Save the custom fields
        update_post_meta($post_id, 'name', $name);
        update_post_meta($post_id, 'email', $email);
        update_post_meta($post_id, 'phone', $phone);
        update_post_meta($post_id, 'property', $property);

        wp_send_json_success('Enquiry submitted successfully!');
    }

}
add_action( 'wp_ajax_process_enquiry_form', 'process_enquiry_form' );
add_action( 'wp_ajax_nopriv_process_enquiry_form', 'process_enquiry_form' );
