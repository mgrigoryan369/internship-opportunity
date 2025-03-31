<?php
/*
Plugin Name: Ajax Example: Admin Area
Description: Example demonstrating how to use Ajax in the WordPress Admin Area.
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
function ajax_admin_enqueue_scripts( $hook ) {

	// Check if our page
	if ( 'toplevel_page_ajax-admin-example' !== $hook ) return;

	// Define script url
	$script_url = plugins_url( '/ajax-admin.js', __FILE__ );

	// Enqueue script
	wp_enqueue_script( 'ajax-admin', $script_url, array( 'jquery' ) );

	// Create nonce
	$nonce = wp_create_nonce( 'ajax_admin' );

	// Define script
	$script = array( 'nonce' => $nonce );

	// Localize script
	wp_localize_script( 'ajax-admin', 'ajax_admin', $script );

}
add_action( 'admin_enqueue_scripts', 'ajax_admin_enqueue_scripts' );


// Process ajax request
function ajax_admin_handler() {

	// Check nonce
	check_ajax_referer( 'ajax_admin', 'nonce' );

	// Check user
	if ( ! current_user_can( 'manage_options' ) ) return;

	// Define the url
	$url = isset( $_POST['url'] ) ? esc_url_raw( $_POST['url'] ) : false;

	// Make head request
	$response = wp_safe_remote_get( $url, array( 'method' => 'HEAD' ) );

	// Get response headers
	$headers = wp_remote_retrieve_headers( $response );

	// output the results
	echo '<pre>';

    if ( ! empty( $headers ) ) {
		echo 'Response headers for: '. $url . "\n\n";
		print_r( $headers );
	} else {
		echo 'No results. Please check the URL and try again.';
	}

    echo '</pre>';

	// end processing
	wp_die();

}
// Ajax hook for logged-in users: wp_ajax_{action}
add_action( 'wp_ajax_admin_hook', 'ajax_admin_handler' );


// Display form and results
function ajax_admin_display_form() {

	?>

	<style>
		.ajax-form-wrap { width: 100%; overflow: hidden; margin: 0 0 20px 0; }
		.ajax-form { float: left; width: 400px; }
		.examples  { float: left; width: 200px; }
		pre {
			width: 95%; overflow: auto; margin: 20px 0; padding: 20px;
			color: #fff; background-color: #424242;
		}
	</style>

	<h3>Check Headers</h3>
	<p>This plugin demo uses Ajax to send a HEAD request.</p>

	<div class="ajax-form-wrap">

		<form class="ajax-form" method="post">
			<p><label for="url">Enter any valid URL:</label></p>
			<p><input id="url" name="url" type="text" class="regular-text"></p>
			<input type="submit" value="Check Headers" class="button button-primary">
		</form>

		<div class="examples">
			<p>Examples:</p>
			<ul>
				<li><code>https://example.com/</code></li>
				<li><code>https://duckduckgo.com/</code></li>
				<li><code>https://api.github.com/</code></li>
			</ul>
		</div>

	</div>

	<div class="ajax-response"></div>

<?php

}


// Add top-level administrative menu
function ajax_admin_add_toplevel_menu() {

	add_menu_page(
		'Ajax Example: Admin Area',
		'Ajax Example',
		'manage_options',
		'ajax-admin-example',
		'ajax_admin_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'ajax_admin_add_toplevel_menu' );


// Display the plugin settings page
function ajax_admin_display_settings_page() {

	// Check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<?php echo ajax_admin_display_form(); ?>
	</div>

<?php

}