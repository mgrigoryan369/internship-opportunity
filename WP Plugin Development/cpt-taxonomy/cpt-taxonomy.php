<?php
/* 
Plugin Name: CPT Taxonomy
Description: Basic WP Plugin for CPT & Taxonomy
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0
Text Domain: mg-plugin
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt
*/

// exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}


// Add 'testimonial' custom post type
function mg_plugin_add_custom_post_type_testimonial() {

	$args = array(
		'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Testimonial',
            'edit_item' => 'Edit Testimonial',
            'new_item' => 'New Testimonial',
            'view_item' => 'View Testimonial',
            'search_items' => 'Search Testimonials',
            'not_found' => 'No testimonials found',
            'not_found_in_trash' => 'No testimonials found in Trash',
            'all_items' => 'All Testimonials',
            'menu_name' => 'Testimonials',
        ),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'testimonial'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
        'show_in_rest' => true,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );

	register_post_type('testimonial', $args);

}

// Hook into init & fire the function for the Custom Post Type
add_action( 'init', 'mg_plugin_add_custom_post_type_testimonial');


// Add custom 'Rating' taxonomy to the 'Testimonial' CPT
function mg_plugin_add_custom_taxonomy_rating() {

    $args = array(
		'labels' => array(
			'name' => 'Ratings',
			'singular_name' => 'Rating',
			'search_items' => 'Search Ratings',
			'all_items' => 'All Ratings',
			'edit_item' => 'Edit Rating',
			'update_item' => 'Update Rating',
			'add_new_item' => 'Add New Rating',
			'new_item_name' => 'New Rating Name',
			'menu_name' => 'Rating',
		),
		'hierarchical' => false,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'show_in_rest' => true,
	);

	register_taxonomy('rating', 'testimonial', $args);

}

// Hook into init & fire the function for the Custom Taxonomy
add_action('init', 'mg_plugin_add_custom_taxonomy_rating');