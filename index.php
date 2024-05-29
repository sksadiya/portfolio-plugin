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
        'supports'              => array('title', 'editor', 'thumbnail'),
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
