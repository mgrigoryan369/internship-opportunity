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

// Fun facts Gutenberg Block
function lil_define_block(){
    if (function_exists('acf_register_block')){
        acf_register_block(array(
            'name' => 'fun-facts',
            'title' => __('Fun Facts'),
            'description' => __('A custom fun facts block'),
            'render_callback' => 'lil_render_fun_facts_block',
            'category' => 'layout',
            'icon' => 'nametag',
            'keywords' => array('fun', 'facts', 'profiles', 'acf'),
        ));
    }
}

// Define for simplification
define('LIL_PATH', trailingslashit(get_stylesheet_directory()));

// Fun facts render callback
function lil_render_fun_facts_block($block){
    $slug = str_replace('acf/', '', $block['name']);
    
    if (file_exists(LIL_PATH . "template-parts/block/content-{$slug}.php")){
        include_once(LIL_PATH . "template-parts/block/content-{$slug}.php");
    }
}

// Actions
add_action('wp_enqueue_scripts', 'astra_child_styles'); // Load Styles
add_action('acf/save_post', 'set_featured_image_from_profile_picture', 20); // Set featured image
add_action('acf/init', 'lil_define_block'); //add Fun Facts block