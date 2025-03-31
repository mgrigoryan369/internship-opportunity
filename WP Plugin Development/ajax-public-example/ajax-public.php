<?php
/*
Plugin Name: Ajax Example: Public Pages
Description: Example demonstrating how to use Ajax on public-facing pages.
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
function ajax_public_enqueue_scripts( $hook ) {

	// Define script url
	$script_url = plugins_url( '/ajax-public.js', __FILE__ );

	// Enqueue script
	wp_enqueue_script( 'ajax-public', $script_url, array( 'jquery' ) );

	// Create nonce
	$nonce = wp_create_nonce( 'ajax_public' );

	// Define ajax url
	$ajax_url = admin_url( 'admin-ajax.php' );

	// Define script
	$script = array( 'nonce' => $nonce, 'ajaxurl' => $ajax_url );

	// Localize script
	wp_localize_script( 'ajax-public', 'ajax_public', $script );

}
add_action( 'wp_enqueue_scripts', 'ajax_public_enqueue_scripts' );


// Process ajax request
function ajax_public_handler() {

	// Check nonce
	check_ajax_referer( 'ajax_public', 'nonce' );

	// Define author id
	$author_id = isset( $_POST['author_id'] ) ? absint( $_POST['author_id'] ) : 0;

	// Define user description
	$description = get_user_meta( $author_id, 'description', true );

	// Output results
	if ( $description ) {
        echo esc_html( $description );
    } else {
        echo esc_html( 'No author bio available.' );
    }

	// End processing
	wp_die();

}
// Ajax hook for logged-in users: wp_ajax_{action}
add_action( 'wp_ajax_public_hook', 'ajax_public_handler' );

// Ajax hook for non-logged-in users: wp_ajax_nopriv_{action}
add_action( 'wp_ajax_nopriv_public_hook', 'ajax_public_handler' );


// Joke Handler 
function ajax_public_get_joke_handler() {
	check_ajax_referer( 'ajax_public', 'nonce' );

	$response = wp_remote_get( 'https://icanhazdadjoke.com/', array(
		'headers' => array( 'Accept' => 'application/json' ),
	) );

	if ( is_wp_error( $response ) ) {
		wp_send_json_error( 'Unable to fetch joke.' );
	}

	$body = wp_remote_retrieve_body( $response );
	$data = json_decode( $body );

	if ( isset( $data->joke ) ) {
		wp_send_json_success( $data->joke );
	} else {
		wp_send_json_error( 'No joke found.' );
	}
}
add_action( 'wp_ajax_get_random_joke', 'ajax_public_get_joke_handler' );
add_action( 'wp_ajax_nopriv_get_random_joke', 'ajax_public_get_joke_handler' );


// Display markup
function ajax_public_display_markup( $content ) {

	if ( ! is_single() ) return $content;

	$id = get_the_author_meta( 'ID' );
	$url = get_author_posts_url( $id );

    $markup  = '<p class="ajax-learn-more">';
	$markup .= '<a href="'. $url .'" data-id="'. $id .'">';
	$markup .= 'Learn more about the author</a></p>';
	$markup .= '<div class="ajax-response"></div>';

    // Joke Markup
    $markup .= '<hr><p><button class="ajax-joke-button">Tell me a joke</button></p>';
    $markup .= '<div class="ajax-joke-response"></div>';

	return $content . $markup;

}
add_action( 'the_content', 'ajax_public_display_markup' );


