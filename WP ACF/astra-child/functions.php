<?php 

// Disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Load styles
function astra_child_styles(){
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}

// Set featured image from profile picture upload field using ID
function set_featured_image_from_profile_picture($post_id) {
    // Prevent affecting revisions or autosaves
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (get_post_type($post_id) !== 'post') return;

    // Get the image ID from the profile_picture ACF field
    $image_id = get_field('profile_picture', $post_id);

    if ($image_id) {
        set_post_thumbnail($post_id, $image_id);
    }
}


// Actions
add_action('wp_enqueue_scripts', 'astra_child_styles'); // Load Styles
add_action('acf/save_post', 'set_featured_image_from_profile_picture', 20); // Set featured image