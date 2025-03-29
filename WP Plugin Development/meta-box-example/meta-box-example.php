<?php
/* 
Plugin Name: Meta Box Example
Description: Basic plugin demonstrating how to work with Meta Boxes.
Plugin URI: https://github.com/mgrigoryan369
Author: Martin Grigoryan
Version: 1.0
Text Domain: mg-plugin
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpls-2.0.txt
*/

// Exit if file is called directly
if (!defined('ABSPATH')) {
	exit;
}

// Register meta box
function mg_plugin_add_meta_box() {
	$post_types = array( 'post', 'page', 'business', 'event', 'testimonial' );

	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'mg_plugin_meta_box',
			'MG Plugin Meta Box',
			'mg_plugin_display_meta_box',
			$post_type
		);
	}
}
add_action( 'add_meta_boxes', 'mg_plugin_add_meta_box' );

// Display meta box
function mg_plugin_display_meta_box( $post ) {
	$value = get_post_meta( $post->ID, '_mg_plugin_meta_key', true );
	wp_nonce_field( basename( __FILE__ ), 'mg_plugin_meta_box_nonce' );
	?>

	<label for="mg_plugin_meta_box">Field Description</label>
	<select id="mg_plugin_meta_box" name="mg_plugin_meta_box">
		<option value="">Select option...</option>
		<option value="option-1" <?php selected( $value, 'option-1' ); ?>>Option 1</option>
		<option value="option-2" <?php selected( $value, 'option-2' ); ?>>Option 2</option>
		<option value="option-3" <?php selected( $value, 'option-3' ); ?>>Option 3</option>
	</select>

	<?php
}

// Save meta box
function mg_plugin_save_meta_box( $post_id ) {
	if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
		return;
	}

	if ( ! isset( $_POST['mg_plugin_meta_box_nonce'] ) ||
	     ! wp_verify_nonce( $_POST['mg_plugin_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( isset( $_POST['mg_plugin_meta_box'] ) ) {
		update_post_meta(
			$post_id,
			'_mg_plugin_meta_key',
			sanitize_text_field( $_POST['mg_plugin_meta_box'] )
		);
	}
}
add_action( 'save_post', 'mg_plugin_save_meta_box' );