<?php
/*
Plugin Name: REST API: Create Posts
Description: Example demonstrating how to use the REST API to create new post
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt
*/


// Exit if file is called directly
if (!defined('ABSPATH')){
    exit;
}


// Enqueue scripts
function restapi_enqueue_scripts( $hook ) {

	// Define script url
	$script_url = plugins_url( '/rest-create-posts.js', __FILE__ );

	// Check if user can publish posts
	if ( current_user_can( 'publish_posts') ) {

		// Enqueue script
		wp_enqueue_script( 'rest-create-posts', $script_url, array(), null, true );

		// Add inline script
		wp_localize_script(
			'rest-create-posts',
			'rest_create_posts',
			array(
				'root'    => esc_url_raw( rest_url() ),
				'nonce'   => wp_create_nonce( 'wp_rest' ),
				'success' => __( 'Success! Post created.' ),
				'failure' => __( 'Failure! Post not created.' )
			)
		);

	}

}
add_action( 'wp_enqueue_scripts', 'restapi_enqueue_scripts' );


// Shortcode: [restapi_markup]
function restapi_markup() {

	$html = '';

	if ( current_user_can( 'publish_posts') ) {
		$html .= '<style>.rest-create-post p { margin: 5px 0; }</style>';
		$html .= '<form class="rest-create-post">';
		$html .= '<div class="rest-post-result"></div>';
		$html .= '<p>Create a new post using the REST API.</p>';
		$html .= '<p><input type="text" name="title" placeholder="Title"></p>';
		$html .= '<p><textarea name="content" placeholder="Content"></textarea></p>';
		$html .= '<input type="submit" id="rest-create-post" value="Create Post">';
		$html .= '</form>';

	}

	return $html;

}
add_shortcode( 'restapi_markup', 'restapi_markup' );

// Execute shortcode in widgets
add_filter('widget_text', 'do_shortcode', 10);
