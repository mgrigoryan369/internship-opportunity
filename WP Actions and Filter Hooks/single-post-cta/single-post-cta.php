<?php

/**
 * Plugin Name:       Single Post CTA
 * Plugin URI:        https://github.com/mgrigoryan369
 * Description:       Adds sidebar (widget area) to single posts
 * Version:           1.0.0
 * Author:            Martin Grigoryan
 * Author URI:        https://github.com/mgrigoryan369
 * License:           GPL v2+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       spc
 */

 // disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// load stylesheet
function spc_load_stylesheet() {
    if(is_single()){
        wp_enqueue_style('spc-stylesheet', plugin_dir_url(__FILE__) . 'spc-styles.css');
    }
}

// hook stylesheet
add_action('wp_enqueue_scripts', 'spc_load_stylesheet');

// register a custom sidebar
function spc_register_sidebar() {
    register_sidebar( array(
	    'name'          => __( 'Single Post CTA', 'spc' ),
	    'id'            => 'spc-sidebar',
	    'description'   => __( 'Displays widget area on single posts', 'spc' ),
	    'before_widget' => '<div class="widget spc">',
	    'after_widget'  => '</div>',
	    'before_title'  => '<h2 class="widgettitle spc-title">',
	    'after_title'   => '</h2>',
	) );
}

// hook sidebar
add_action( 'widgets_init', 'spc_register_sidebar' );

// display sidebar on single posts
function spc_display_sidebar( $content ) {
	if ( is_single() ) {
		dynamic_sidebar( 'spc-sidebar' );
	}
	return $content;
}

// add dynamic sidebar
add_filter( 'the_content', 'spc_display_sidebar' );