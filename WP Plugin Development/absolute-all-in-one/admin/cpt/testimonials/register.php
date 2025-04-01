<?php // CPT: TESTIMONIALS

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === HOOKS ===
//add_action( 'init', 'aaio_register_testimonials_cpt' );

// Register Testimonials CPT only if enabled
function aaio_register_testimonials_cpt() {

	$labels = array(
		'name' => __( 'Testimonials', 'absolute-all-in-one' ),
		'singular_name' => __( 'Testimonial', 'absolute-all-in-one' ),
		'add_new' => __( 'Add New', 'absolute-all-in-one' ),
		'add_new_item' => __( 'Add New Testimonial', 'absolute-all-in-one' ),
		'edit_item' => __( 'Edit Testimonial', 'absolute-all-in-one' ),
		'new_item' => __( 'New Testimonial', 'absolute-all-in-one' ),
		'view_item' => __( 'View Testimonial', 'absolute-all-in-one' ),
		'view_items' => __( 'View Testimonials', 'absolute-all-in-one' ),
		'not_found' => __( 'No testimonials found.', 'absolute-all-in-one' )
	);

	$args = array(
		'label' => __( 'Testimonials', 'absolute-all-in-one' ),
		'labels' => $labels,
		'public' => true,
		'show_in_menu' => true,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'testimonials' ),
        'show_in_rest' => true,
		'menu_icon' => 'dashicons-format-quote',
	);

	register_post_type( 'testimonial', $args );
}

// Immediate Call 
aaio_register_testimonials_cpt();